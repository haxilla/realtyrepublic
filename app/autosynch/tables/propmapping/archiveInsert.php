<?php

// GLOBAL transaction isolation level changed 
// to track number of records during insert
// reverted back to repeatable-read when completed
DB::statement("
  SET GLOBAL TRANSACTION ISOLATION LEVEL READ UNCOMMITTED;
");
// ** BEGIN INSERT
// Insert FEDERATED
DB::select( DB::raw("
INSERT INTO $tableMains
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
FROM  remarchives.$tableArchive
"));

//revert back to default
DB::statement("
  SET GLOBAL TRANSACTION ISOLATION LEVEL REPEATABLE READ;
");