<?php

// GLOBAL transaction isolation level changed 
// to track number of records during insert
// reverted back to repeatable-read when completed
DB::statement("
  SET GLOBAL TRANSACTION ISOLATION LEVEL READ UNCOMMITTED;
");

// ** BEGIN INSERT
// Insert federated
DB::select( DB::raw("
INSERT INTO $tableMains
  (
    xPropType,
    propflyer_id,
    propagent_id,
    sk1,
    sysID,
    zipDir,
    mlsDir,
    `manual`
  )
SELECT
  e_proptype,
  ufid,
  umid,
  sk1,
  sysid,
  zipDir,
  mlsDir,
  `manual`
FROM  remarchives.$tableArchive
"));

//revert back to default
DB::statement("
  SET GLOBAL TRANSACTION ISOLATION LEVEL REPEATABLE READ;
");

include('fixmetas.php');