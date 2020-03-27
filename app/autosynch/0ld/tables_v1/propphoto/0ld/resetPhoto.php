<?php

//drop table if exists
if(!Schema::hasTable('propphotos')){
  dd('NO PROPPHOTOS TABLE!!');};

//startup synch table
if(!Schema::connection('remailsynch')
->hasTable('propphotoSynch')){
  $results=DB::select( DB::raw("
    create table remailsynch.propphotoSynch
    like propphotos
  "));};
//drop and recreate
Schema::connection('remailsynch')
->dropIfExists('remailphotos_federated');
Schema::dropIfExists('remailphotos_federated');
//create federated table
//first need to get by original field names
$results=DB::select( DB::raw("
  CREATE TABLE remailsynch.remailphotos_federated (
    exist_check datetime,
    photodate   datetime,
    photoID     int,
    ufid        int,
    umid        int,
    locname     varchar(255),
    resized     int,
    def         boolean,
    width       int,
    height      int,
    orient      varchar(255),
    origname    varchar(255),
    filesize    int,
    filesize2   int,
    ord         int,
    chosen      boolean,
    notFound    boolean,
    localFound  boolean,
    remoteFound boolean,
    PRIMARY KEY  (photoID)
  )
  ENGINE=FEDERATED
  DEFAULT CHARSET=latin1
  CONNECTION='mysql://oldsiteuser:ZUb40d4vid@www.realtyemails.com:3306/maindata/remailphotos';
"));
// **  connection string reference
// **  scheme://user_name[:password]@host_name[:port_num]/db_name/tbl_name

//  ** BACKUP CODE

Schema::connection('remailsynch')
->dropIfExists('propphotoBackup');
Schema::dropIfExists('propphotoBackup');
//create propagentSynch Table
$results=DB::select( DB::raw("
  create table remailsynch.propphotoBackup
  like propphotos
"));
//insert
$results = DB::select( DB::raw("
    INSERT INTO remailsynch.propphotoBackup
    SELECT *
    FROM propphotos
"));
//drop
Schema::dropIfExists('propphotos');
//re-create
$results=DB::select( DB::raw("
  create table propphotos
  like remailsynch.propphotoBackup
"));

// ** BEGIN INSERT
// Insert
DB::select( DB::raw("
INSERT INTO propphotos
  (
    existCheck,
    photoDate,
    photoID,
    propflyer_id,
    propagent_id,
    photoName,
    resized,
    def,
    width,
    height,
    orient,
    oldFileName,
    oldFileSize,
    newFileSize,
    ord,
    xxChosen,
    notFound,
    localFound,
    remoteFound
  )
SELECT
  exist_check,
  photodate,
  photoID,
  ufid,
  umid,
  locname,
  resized,
  def,
  width,
  height,
  orient,
  origname,
  filesize,
  filesize2,
  ord,
  chosen,
  notFound,
  localFound,
  remoteFound
FROM remailsynch.remailphotos_federated
"));

include('addArchive_remailphotos.php');

//2nd backup
//delete if exists
Schema::connection('remailsynch')
->dropIfExists('propphotoSynch');
Schema::dropIfExists('propphotoSynch');
//re-create
$results=DB::select( DB::raw("
  create table remailsynch.propphotoSynch
  like propphotos
"));
//insert
$results = DB::select( DB::raw("
    INSERT INTO remailsynch.propphotoSynch
    SELECT *
    FROM propphotos
"));

//the difference between synch & backup
//will show difference between old & new records
//for future project

//output json & exit
$idArray = array(
  'status'     => 'success',
  'next'       => 'resetDeliv',
  'message1'   => 'propphotos Reset!',
  'message2'   => 'Now resetting propdelivs'
);
echo json_encode($idArray);
exit();
