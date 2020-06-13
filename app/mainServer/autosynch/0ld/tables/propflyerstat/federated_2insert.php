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
//insert into propagents
$results = DB::select(DB::raw("
  INSERT IGNORE INTO $tableMains
  (
    officeID,
    xOfficeID,
    tempOfficeID,
    officeName,
    officeAddress1,
    officeCity,
    officeState,
    officeZip,
    propagent_id,
    newRemID
  )
  SELECT
    xOfficeID,
    officeID,
    tempOfficeID,
    agentCompany,
    agentAddress,
    agentCity,
    agentState,
    agentZip,
    umid,
    newRemID
  FROM remailsynch.$tableFed
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
