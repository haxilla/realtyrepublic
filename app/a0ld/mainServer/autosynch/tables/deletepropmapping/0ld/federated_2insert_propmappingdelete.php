<?php

//model
Use App\models\synch\synchLog;

//drop
Schema::connection('deletes')
->dropIfExists('propmappingdelete');

//notify synch of tableDrop
synchLog::where('synchID','=',$synchID)
->update([
  'tableDrop'     => 1,
  'tableDropName' => 'propmappingdelete',
]);

//re-create
$results=DB::select( DB::raw("
  create table deletes.propmappingdelete
  like propmappings
"));

// GLOBAL transaction isolation level changed 
// to track number of records during insert
// reverted back to repeatable-read when completed
DB::statement("
  SET GLOBAL TRANSACTION ISOLATION LEVEL READ UNCOMMITTED;
");

// ** BEGIN INSERT
// Insert FEDERATED
DB::select( DB::raw("
INSERT INTO deletes.propmappingdelete
  (
    propflyer_id,
    propagent_id,
    xHouseNum,
    xStreetDir,
    xStreetName,
    xStreetSuffix,
    xRegion,
    xMlsGrid,
    xCountyName,
    xSubdivision,
    xIntersection,
    xDirections
  )
SELECT
    ufid,
    umid,
    e_housenum,
    e_streetdir,
    e_streetName,
    e_stsuffix,
    region,
    e_mapgrid,
    e_county,
    e_subdivision,
    e_xst,
    e_directions
FROM  remailsynch.propmappingdelete_federated
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