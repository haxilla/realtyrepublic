<?php

//drop table if exists
if(!Schema::hasTable('propremarks')){
  dd('NO propremarks TABLE!!');};

//startup synch table
if(!Schema::hasTable('propremarkSynch')){
  $results=DB::select( DB::raw("
    create table propremarkSynch
    like propremarks
  "));
  //insert
  $results = DB::select( DB::raw("
      INSERT INTO propremarkSynch
      SELECT *
      FROM propremarks
  "));
};
//drop and start fresh
Schema::dropIfExists('propremarks_federated');
//create federated table
//create table with identical field names
$results=DB::select( DB::raw("
  CREATE TABLE propremarks_federated (
    ufid          int,
    umid          int,
    remarkLink    boolean,
    e_remarks     text,
    b1            varchar(255),
    b2            varchar(255),
    b3            varchar(255),
    b4            varchar(255),
    b5            varchar(255),
    b6            varchar(255),
    b7            varchar(255),
    b8            varchar(255),
    PRIMARY KEY   (ufid),
    index         (umid)
  )
  ENGINE=FEDERATED
  DEFAULT CHARSET=latin1
  CONNECTION='mysql://oldsiteuser:ZUb40d4vid@www.realtyemails.com:3306/maindata/remailflyers';
"));
// **  connection string reference
// **  scheme://user_name[:password]@host_name[:port_num]/db_name/tbl_name

//  ** BACKUP CODE
//  ** drop and recreate table
Schema::dropIfExists('propremarkBackup');
//create propagentSynch Table
$results=DB::select( DB::raw("
  create table propremarkBackup
  like propremarks
"));
//  ** insert backup copy
$results = DB::select( DB::raw("
    INSERT INTO propremarkBackup
    SELECT *
    FROM propremarks
"));
// ** drop original
Schema::dropIfExists('propremarks');
//re-create
$results=DB::select( DB::raw("
  create table propremarks
  like propremarkSynch
"));

// ** Recreate - BEGIN INSERT
DB::select( DB::raw("
INSERT INTO propremarks
  (
    propflyer_id,
    propagent_id,
    hideRemarks,
    xPubRemarks,
    xb1,
    xb2,
    xb3,
    xb4,
    xb5,
    xb6,
    xb7,
    xb8
  )
SELECT
  ufid,
  umid,
  remarkLink,
  e_remarks,
  b1,
  b2,
  b3,
  b4,
  b5,
  b6,
  b7,
  b8
FROM propremarks_federated
"));

// ** Insert from archives
DB::select( DB::raw("
INSERT IGNORE INTO propremarks
  (
    propflyer_id,
    propagent_id,
    hideRemarks,
    xPubRemarks,
    xb1,
    xb2,
    xb3,
    xb4,
    xb5,
    xb6,
    xb7,
    xb8
  )
SELECT
  ufid,
  umid,
  remarkLink,
  e_remarks,
  b1,
  b2,
  b3,
  b4,
  b5,
  b6,
  b7,
  b8
FROM    maindata.remailflyers
"));

//2nd backup
//delete if exists
Schema::dropIfExists('propremarkSynch');
//re-create
$results=DB::select( DB::raw("
  create table propremarkSynch
  like propremarks
"));
//insert
$results = DB::select( DB::raw("
    INSERT INTO propremarkSynch
    SELECT *
    FROM propremarks
"));

//output json & exit
$idArray = array(
  'status'  => 'success',
);
echo json_encode($idArray);
