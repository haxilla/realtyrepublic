<?php

if(!Schema::hasTable('propmappings')){
  dd('no propmetas table!!');};

if(!Schema::hasTable('propmappingSynch')){
  $results=DB::select( DB::raw("
    create table propmappingSynch
    like propmappings
  "));}

//drop table if exists
Schema::dropIfExists('propmappings_federated');
//create federated table
//first need to get by original field names
$results=DB::select( DB::raw("
  CREATE TABLE propmappings_federated (
    ufid          int,
    umid          int,
    e_housenum    varchar(255),
    e_streetdir   varchar(255),
    e_streetName  varchar(255),
    e_stsuffix    varchar(255),
    region        varchar(255),
    e_mapgrid     varchar(255),
    e_county      varchar(255),
    e_subdivision varchar(255),
    e_xst         varchar(255),
    e_directions  varchar(255),
    PRIMARY KEY  (ufid)
  )
  ENGINE=FEDERATED
  DEFAULT CHARSET=latin1
  CONNECTION='mysql://oldsiteuser:ZUb40d4vid@www.realtyemails.com:3306/maindata/remailflyers';
"));
// **  connection string reference
// **  scheme://user_name[:password]@host_name[:port_num]/db_name/tbl_name

//  ** BACKUP CODE
//backup existing propagent before dropping

Schema::dropIfExists('propmappingBackup');
//create propagentSynch Table
$results=DB::select( DB::raw("
  create table propmappingBackup
  like propmappings
"));
//insert
$results = DB::select( DB::raw("
    INSERT INTO propmappingBackup
    SELECT *
    FROM propmappings
"));
//drop
Schema::dropIfExists('propmappings');
//re-create
$results=DB::select( DB::raw("
  create table propmappings
  like propmappingSynch
"));

// ** BEGIN INSERT
// Insert
DB::select( DB::raw("
INSERT INTO propmappings
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
FROM  propmappings_federated
"));

// Insert from archives
DB::select( DB::raw("
INSERT IGNORE INTO propmappings
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
FROM  maindata.remailflyers
"));

//2nd backup
//delete if exists
Schema::dropIfExists('propmappingSynch');
//re-create
$results=DB::select( DB::raw("
  create table propmappingSynch
  like propmappings
"));
//insert
$results = DB::select( DB::raw("
    INSERT INTO propmappingSynch
    SELECT *
    FROM propmappings
"));
