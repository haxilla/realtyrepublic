<?php

//model
Use App\models\synch\synchLog;

//backup existing propagent before dropping
Schema::connection('remailsynch')
->dropIfExists($tableBackup);

//create propagentBackup Table
$results=DB::select( DB::raw("
  create table remailsynch.$tableBackup
  like $tableSchema.$tableMains
"));

//notify synch of tableDrop
synchLog::where('synchID','=',$synchID)
->update([
  'tableDrop'       => 1,
  'tableDropName'   => $tableBackup,
  'progressMessage' => "First Backup"
]);

//for reading progress on records
DB::statement("
  SET GLOBAL TRANSACTION ISOLATION LEVEL READ UNCOMMITTED;
");

//insert
$results = DB::select( DB::raw("
    INSERT INTO remailsynch.$tableBackup
    SELECT *
    FROM $tableSchema.$tableMains
"));

//revert back to default
DB::statement("
  SET GLOBAL TRANSACTION ISOLATION LEVEL REPEATABLE READ;
");

//update tableDrop
synchLog::where('synchID','=',$synchID)
->update([
  'tableDrop'       => 0,
  'tableDropName'   => null,
]);