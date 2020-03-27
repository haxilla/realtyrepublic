<?php

if(!Schema::hasTable('propflyerstats')){
  dd('no propmetas table!!');};

if(!Schema::hasTable('propflyerstatSynch')){
  $results=DB::select( DB::raw("
    create table propflyerstatSynch
    like propflyerstats
  "));}

//drop table if exists
Schema::dropIfExists('propflyerstats_federated');
//create federated table
//first need to get by original field names
$results=DB::select( DB::raw("
  CREATE TABLE propflyerstats_federated (
    ufid              INT,
    umid              INT,
    delivered         INT,
    mls_check         datetime,
    sellersendok      boolean,
    agent_sent        int,
    last_delivered    datetime,
    sold              boolean,
    hits              int,
    bonusamount       int,
    reducedamount     int,
    reduceDate        datetime,
    openDateOne       datetime,
    openDateTwo       datetime,
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

Schema::dropIfExists('propflyerstatBackup');
//create propagentSynch Table
$results=DB::select( DB::raw("
  create table propflyerstatBackup
  like propflyerstats
"));
//insert
$results = DB::select( DB::raw("
    INSERT INTO propflyerstatBackup
    SELECT *
    FROM propflyerstats
"));
//drop
Schema::dropIfExists('propflyerstats');
//re-create
$results=DB::select( DB::raw("
  create table propflyerstats
  like propflyerstatBackup
"));

// ** BEGIN INSERT
// Insert
DB::select( DB::raw("
INSERT INTO propflyerstats
  (
    propflyer_id,
    propagent_id,
    xDeliveryCount,
    xMlsCheck,
    xSellerSendOK,
    xAgtSent,
    xLastDeliveryDate,
    xSold,
    xWebViews,
    xBonusAmt,
    xReducedAmt,
    xReducedDate,
    xOpenDateStart,
    xOpenDateEnd
  )
SELECT
  ufid,
  umid,
  delivered,
  mls_check,
  sellersendok,
  agent_sent,
  last_delivered,
  sold,
  hits,
  bonusamount,
  reducedamount,
  reduceDate,
  openDateOne,
  openDateTwo
FROM    propflyerstats_federated
"));

// Insert
DB::select( DB::raw("
INSERT IGNORE INTO propflyerstats
  (
    propflyer_id,
    propagent_id,
    xDeliveryCount,
    xMlsCheck,
    xSellerSendOK,
    xAgtSent,
    xLastDeliveryDate,
    xSold,
    xWebViews,
    xBonusAmt,
    xReducedAmt,
    xReducedDate,
    xOpenDateStart,
    xOpenDateEnd
  )
SELECT
  ufid,
  umid,
  delivered,
  mls_check,
  sellersendok,
  agent_sent,
  last_delivered,
  sold,
  hits,
  bonusamount,
  reducedamount,
  reduceDate,
  openDateOne,
  openDateTwo
FROM    maindata.remailflyers
"));

//2nd backup
//delete if exists
Schema::dropIfExists('propflyerstatSynch');
//re-create
$results=DB::select( DB::raw("
  create table propflyerstatSynch
  like propflyerstats
"));
//insert
$results = DB::select( DB::raw("
    INSERT INTO propflyerstatSynch
    SELECT *
    FROM propflyerstats
"));
