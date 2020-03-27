<?php


Use App\models\synch\synchLog;

//update tableDrop
synchLog::where('synchID','=',$synchID)
->update([
  'tableDrop'       => 0,
  'tableDropName'   => null,
  'progressMessage' => null,
]);