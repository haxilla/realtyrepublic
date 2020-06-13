<?php

Use App\models\synch\synchLog;

// table vars
include(app_path().'/autosynch/variables/tableVars.php');

// drop tableFed
include(app_path().'/autosynch/drop/tableFed.php');

// create federated table
include('federated/tableCreate.php');

// update progress
synchLog::where('synchID','=',$synchID)
->update([
  'progressMessage'=>"Recreated $tableFed",
]);

//drop tableMains
include(app_path().'/autosynch/drop/tableMains.php');

// table insert
include('federated/tableInsert.php');

//update tableDrop
synchLog::where('synchID','=',$synchID)
->update([
  'tableDrop'       => 0,
  'tableDropName'   => null,
  'progressMessage' => "$tableMains Insert Complete",
]);
