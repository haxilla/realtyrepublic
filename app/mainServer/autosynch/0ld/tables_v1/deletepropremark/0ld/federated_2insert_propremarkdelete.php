<?php

//model
Use App\models\synch\synchLog;

//drop
Schema::connection('deletes')
->dropIfExists('propremarkdelete');

//notify synch of tableDrop
synchLog::where('synchID','=',$synchID)
->update([
  'tableDrop'     => 1,
  'tableDropName' => 'propremarkdelete' 
]);

//re-create
$results=DB::select( DB::raw("
  create table deletes.propremarkdelete
  like propremarks
"));

// GLOBAL transaction isolation level changed 
// to track number of records during insert
// reverted back to repeatable-read when completed
DB::statement("
  SET GLOBAL TRANSACTION ISOLATION LEVEL READ UNCOMMITTED;
");

// ** BEGIN INSERT
DB::select( DB::raw("
INSERT INTO deletes.propremarkdeletes
  (
    propflyer_id,
    propagent_id,
    hideRemarks,
    xPubRemarks,
    xb1,
    xb2,
    xb3,
    xb4,
    xb5,
    xb6,
    xb7,
    xb8
  )
SELECT
  ufid,
  umid,
  remarkLink,
  e_remarks,
  b1,
  b2,
  b3,
  b4,
  b5,
  b6,
  b7,
  b8
FROM remailsynch.propremarkdelete_federated
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