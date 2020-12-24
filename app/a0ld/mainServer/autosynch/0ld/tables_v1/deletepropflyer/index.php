<?php

Use App\models\synch\synchLog;

// drop tableFed
include(app_path().'/autosynch/drop/tableFed.php');

// create federated table
include('$tableMain/federated/tableCreate.php');

//drop tableMains
include(app_path().'/autosynch/drop/tableMains.php');

// table insert
include('$tableMain/federated/tableInsert.php');

//update tableDrop
synchLog::where('synchID','=',$synchID)
->update([
  'tableDrop'       => 0,
  'tableDropName'   => null,
  'progressMessage' => null,
]);
