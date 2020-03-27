<?php

//model
Use App\models\synch\synchLog;

//table variables
include('tableVars.php');

//delete if exists
Schema::connection('remailsynch')
->dropIfExists($tableSynch);

//notify synch of tableDrop
synchLog::where('synchID','=',$synchID)
->update([
  'tableDrop'     => 1,
  'tableDropName' => $tableSynch,
]);

//re-create
$results=DB::select( DB::raw("
  create table remailsynch.$tableSynch
  like $tableMains
"));

//insert
$results = DB::select( DB::raw("
    INSERT INTO remailsynch.$tableSynch
    SELECT *
    FROM $tableMains
"));