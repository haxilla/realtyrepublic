<?php

//model
Use App\models\synch\synchLog;

//drop
Schema::connection('deletes')
->dropIfExists('propmetadelete');

//notify synch of tableDrop
synchLog::where('synchID','=',$synchID)
->update([
  'tableDrop'     => 1,
  'tableDropName' => 'propmetadelete',
]);

//re-create
$results=DB::select( DB::raw("
  create table deletes.propmetadelete
  like propmetas
"));

// GLOBAL transaction isolation level changed 
// to track number of records during insert
// reverted back to repeatable-read when completed
DB::statement("
  SET GLOBAL TRANSACTION ISOLATION LEVEL READ UNCOMMITTED;
");

// ** BEGIN INSERT
// Insert federated
DB::select( DB::raw("
INSERT INTO deletes.propmetadelete
  (
    xPropType,
    propflyer_id,
    propagent_id,
    sk1,
    sysID,
    zipDir,
    mlsDir,
    manual
  )
SELECT
  e_proptype,
  ufid,
  umid,
  sk1,
  sysID,
  zipDir,
  mlsDir,
  manual
FROM  remailsynch.propmetadelete_federated
"));

//revert back to default
DB::statement("
  SET GLOBAL TRANSACTION ISOLATION LEVEL REPEATABLE READ;
");

//update tableDrop
synchLog::where('synchID','=',$synchID)
->update([
  'tableDrop'     => 0,
  'tableDropName' => null,
]);