<?php
//model
Use App\models\synch\synchLog;

//propdelivs - drop if exists
Schema::dropIfExists('propdelivs');

//notify synch of tableDrop
synchLog::where('synchID','=',$synchID)
->update([
  'tableDrop'=>1
  'progressMessage'=>'Resetting propdelivs table'
]);

$results = select( DB::raw("
    INSERT IGNORE INTO propdelivs
    SELECT *
    FROM remarchives.remaildeliveriesmaster
"));

//notify synch of tableDrop
synchLog::where('synchID','=',$synchID)
->update([
  'tableDrop'=>0
  'progressMessage'=>null,
]);