<?php

// GLOBAL transaction isolation level changed 
// to track number of records during insert
// reverted back to repeatable-read when completed
DB::statement("
  SET GLOBAL TRANSACTION ISOLATION LEVEL READ UNCOMMITTED;
");
//insert into propagents
$results = DB::select(DB::raw("
  INSERT IGNORE INTO $tableSchema.$tableMains
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

include(app_path().'/autosynch/tables/agtoffice/fixNullOfficeID.php');

