<?php

if(!Schema::hasTable('propmetas')){
  dd('no propmetas table!!');};

if(!Schema::hasTable('propmetaSynch')){
  $results=DB::select( DB::raw("
    create table propmetaSynch
    like propmetas
  "));}

//drop table if exists
Schema::dropIfExists('propmetas_federated');
//create federated table
//first need to get by original field names
$results=DB::select( DB::raw("
  CREATE TABLE propmetas_federated (
    e_proptype  varchar(255),
    ufid        int,
    umid        int,
    sk1         varchar(255),
    sysID       varchar(255),
    zipDir      varchar(255),
    mlsDir      varchar(255),
    manual      boolean,
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

Schema::dropIfExists('propmetaBackup');
//create propagentSynch Table
$results=DB::select( DB::raw("
  create table propmetaBackup
  like propmetas
"));
//insert
$results = DB::select( DB::raw("
    INSERT INTO propmetaBackup
    SELECT *
    FROM propmetas
"));
//drop
Schema::dropIfExists('propmetas');
//re-create
$results=DB::select( DB::raw("
  create table propmetas
  like propmetaBackup
"));

// ** BEGIN INSERT
// Insert
DB::select( DB::raw("
INSERT INTO propmetas
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
FROM  propmetas_federated
"));

// Insert from archived Flyers
DB::select( DB::raw("
INSERT IGNORE INTO propmetas
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
FROM  maindata.remailflyers
"));

//2nd backup
//delete if exists
Schema::dropIfExists('propmetaSynch');
//re-create
$results=DB::select( DB::raw("
  create table propmetaSynch
  like propmetas
"));
//insert
$results = DB::select( DB::raw("
    INSERT INTO propmetaSynch
    SELECT *
    FROM propmetas
"));
