<?php

//model
Use App\models\synch\synchLog;

//delete if exists
Schema::connection('remailsynch')
->dropIfExists($tableSynch);

//deletes
$results=DB::select( DB::raw("
  create table remailsynch.$tableSynch
  like $tableSchema.$tableMains
"));

//notify synch of tableDrop
synchLog::where('synchID','=',$synchID)
->update([
  'tableDrop'       => 1,
  'tableDropName'   => $tableSynch,
  'progressMessage' => "Final Backup"
]);

//for reading progress on records
DB::statement("
  SET GLOBAL TRANSACTION ISOLATION LEVEL READ UNCOMMITTED;
");

//insert
$results = DB::select( DB::raw("
    INSERT INTO remailsynch.$tableSynch
    SELECT *
    FROM $tableSchema.$tableMains
"));

//revert back to default
DB::statement("
  SET GLOBAL TRANSACTION ISOLATION LEVEL REPEATABLE READ;
");

//notify synch of tableDrop
synchLog::where('synchID','=',$synchID)
->update([
  'tableDrop'       => 0,
  'tableDropName'   => null,
]);