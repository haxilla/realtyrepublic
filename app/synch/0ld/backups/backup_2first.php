<?php

//model
Use App\models\synch\synchLog;

//table variables
include('tableVars.php');

//backup existing propagent before dropping
Schema::connection('remailsynch')
->dropIfExists($tableBackup);

//notify synch of tableDrop
synchLog::where('synchID','=',$synchID)
->update([
  'tableDrop'     => 1,
  'tableDropName' => $tableBackup,
]);

//create propagentBackup Table
$results=DB::select( DB::raw("
  create table remailsynch.$tableBackup
  like $tableMains
"));

//for reading progress on records
DB::statement("
  SET GLOBAL TRANSACTION ISOLATION LEVEL READ UNCOMMITTED;
");

//insert
$results = DB::select( DB::raw("
    INSERT INTO remailsynch.$tableBackup
    SELECT *
    FROM $tableMains
"));

//revert back to default
DB::statement("
  SET GLOBAL TRANSACTION ISOLATION LEVEL REPEATABLE READ;
");

//update tableDrop
synchLog::where('synchID','=',$synchID)
->update([
  'tableDrop'     => 0,
  'tableDropName' => null
]);