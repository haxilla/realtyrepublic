<?php

Use App\models\synch\synchLog;

//default
Schema::connection($tableSchema)
->dropIfExists($tableMains);

//recreate
$results=DB::select( DB::raw("
  create table $tableSchema.$tableMains
  like remailsynch.$tableBackup
"));

//notify synch of tableDrop
synchLog::where('synchID','=',$synchID)
->update([
  'tableDrop'     	=> 1,
  'tableDropName' 	=> $tableMains,
  'progressMessage'	=> "Importing New Info"
]);