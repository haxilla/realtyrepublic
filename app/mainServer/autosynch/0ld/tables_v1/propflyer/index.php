<?php

Use App\models\synch\synchLog;

// drop tableFed
include(app_path().'/autosynch/drop/tableFed.php');

// create federated table
include('federated/tableCreate.php');

//drop tableMains
include(app_path().'/autosynch/drop/tableMains.php');

// table insert
include('federated/tableInsert.php');

//update tableDrop
synchLog::where('synchID','=',$synchID)
->update([
  'tableDrop'       => 0,
  'tableDropName'   => null,
  'progressMessage' => null,
]);


