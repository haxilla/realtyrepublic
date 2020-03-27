<?php

//drop table if exists
if(!Schema::connection('deletes')
->hasTable('remailflyerdelete')){
    dd('NO remailflyerdelete TABLE!');};

if(!Schema::connection('remailsynch')
->hasTable('remailflyerdeleteSynch')){
  $results=DB::select( DB::raw("
    create table remailsynch.remailflyerdeleteSynch
    like deletes.remailflyerdelete
  "));
};
if(!Schema::connection('remailsynch')
->hasTable('remailflyerdeleteBackup')){
  $results=DB::select( DB::raw("
    create table remailsynch.remailflyerdeleteBackup
    like deletes.remailflyerdelete
  "));
};

Schema::dropIfExists('remailflyerdelete_federated');
Schema::connection('remailsynch')
->dropIfExists('remailflyerdelete_federated');
//create federated table
//first need to get by original field names
$results=DB::select( DB::raw("
  CREATE TABLE remailsynch.remailflyerdelete_federated (
    creation          datetime,
    ufid              int,
    umid              int,
    e_MlsNum          varchar(255),
    e_MlsNum_Orig     varchar(255),
    e_ListPrice       varchar(255),
    e_beds            varchar(255),
    e_baths           varchar(255),
    e_sqft            varchar(255),
    e_address         varchar(255),
    e_city            varchar(255),
    e_state           varchar(255),
    e_zip             varchar(255),
    e_county          varchar(255),
    headline          text,
    e_YrBuilt         varchar(255),
    e_PoolPvt         varchar(255),
    e_Parking         varchar(255),
    e_RV              varchar(255),
    e_Fireplace       varchar(255),
    MlsLink           varchar(255),
    e_Virt_Tour       varchar(255),
    officeID2         varchar(255),
    PRIMARY KEY  (ufid),
    INDEX UMID (UMID)
  )
  ENGINE=FEDERATED
  DEFAULT CHARSET=latin1
  CONNECTION='mysql://oldsiteuser:ZUb40d4vid@www.realtyemails.com:3306/maindata/remailflyers';
"));

// **  connection string reference
// **  scheme://user_name[:password]@host_name[:port_num]/db_name/tbl_name

//  ** BACKUP CODE
//backup existing propagent before dropping

Schema::dropIfExists('propflyerBackup');
Schema::connection('remailsynch')
->dropIfExists('propflyerBackup');
//create propagentSynch Table
$results=DB::select( DB::raw("
  create table remailsynch.propflyerBackup
  like propflyers
"));
//insert
$results = DB::select( DB::raw("
    INSERT INTO remailsynch.propflyerBackup
    SELECT *
    FROM propflyers
"));
//drop
Schema::dropIfExists('propflyers');

//re-create
$results=DB::select( DB::raw("
  create table propflyers
  like remailsynch.propflyerBackup
"));

// ** BEGIN INSERT
// Insert
DB::select( DB::raw("
  INSERT INTO propflyers
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
  FROM remailsynch.remailflyers_federated
"));
//add all into archive

//add history from old server
include('addArchive_remailflyers.php');
//2nd backup
//delete if exists
Schema::dropIfExists('propflyerSynch');
Schema::connection('remailsynch')
->dropIfExists('propflyerSynch');
//re-create
$results=DB::select( DB::raw("
  create table remailsynch.propflyerSynch
  like propflyers
"));
//insert
$results = DB::select( DB::raw("
    INSERT INTO remailsynch.propflyerSynch
    SELECT *
    FROM propflyers
"));

//output json & exit
$idArray = array(
  'status'          => 'success',
  'next'            => 'resetMeta',
  'message1'        => 'propflyers Reset!',
  'message2'        => 'Now resetting propmetas...'
);
echo json_encode($idArray);
exit();
