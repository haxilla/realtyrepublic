<?php

//model
Use App\models\synch\synchLog;

//table variables
include('tableVars.php');

//drop
Schema::dropIfExists($tableMains);

//notify synch of tableDrop
synchLog::where('synchID','=',$synchID)
->update([
  'tableDrop'     => 1,
  'tableDropName' => $tableMains,
]);

//re-create
$results=DB::select( DB::raw("
  create table $tableMains
  like remailsynch.$tableBackup
"));

// GLOBAL transaction isolation level changed 
// to track number of records during insert
// reverted back to repeatable-read when completed
DB::statement("
  SET GLOBAL TRANSACTION ISOLATION LEVEL READ UNCOMMITTED;
");
// ** BEGIN INSERT
// Insert
DB::select( DB::raw("
  INSERT INTO $tableMains
    (
    creationDate,
    id,
    propagent_id,
    xMlsNum,
    xMlsNumOrig,
    xListPrice,
    xxBeds,
    xxBaths,
    xxSqft,
    xFullStreet,
    xCity,
    xState,
    xxZip,
    xCountyName,
    xxHeadline,
    xxYrBuilt,
    xxPoolPvt,
    xParking,
    xxRV,
    xFireplace,
    xMlsLink,
    xxVirtualTour,
    officeID
    )
  SELECT
    creation,
    ufid,
    umid,
    e_MlsNum,
    e_MlsNum_Orig,
    e_ListPrice,
    e_Beds,
    e_Baths,
    e_Sqft,
    e_address,
    e_City,
    e_State,
    e_Zip,
    e_county,
    headline,
    e_YrBuilt,
    e_PoolPvt,
    e_Parking,
    e_RV,
    e_Fireplace,
    MlsLink,
    e_Virt_Tour,
    officeID2
  FROM remailsynch.$tableFed
"));
//add all into archive
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
