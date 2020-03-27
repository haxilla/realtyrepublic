<?php

//drop table if exists
if(!Schema::hasTable('propflyers')){
    dd('NO PROPFLYERS TABLE!');};

if(!Schema::hasTable('propflyerSynch')){
  $results=DB::select( DB::raw("
    create table propflyerSynch
    like propflyers
  "));
};

Schema::dropIfExists('remailflyers_federated');
//create federated table
//first need to get by original field names
$results=DB::select( DB::raw("
  CREATE TABLE remailflyers_federated (
    creation          datetime,
    ufid              int,
    umid              int,
    e_MlsNum          varchar(255),
    e_MlsNum_Orig     varchar(255),
    e_ListPrice       varchar(255),
    e_Beds            varchar(255),
    e_Baths           varchar(255),
    e_Sqft            varchar(255),
    e_address         varchar(255),
    e_City            varchar(255),
    e_State           varchar(255),
    e_Zip             varchar(255),
    e_county          varchar(255),
    headline          text,
    e_YrBuilt         varchar(255),
    e_PoolPvt         varchar(255),
    e_Parking         varchar(255),
    e_RV              varchar(255),
    e_Fireplace       varchar(255),
    MlsLink           varchar(255),
    e_Virt_Tour       varchar(255),
    officeID2          varchar(255),
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
//create propagentSynch Table
$results=DB::select( DB::raw("
  create table propflyerBackup
  like propflyers
"));
//insert
$results = DB::select( DB::raw("
    INSERT INTO propflyerBackup
    SELECT *
    FROM propflyers
"));
//drop
Schema::dropIfExists('propflyers');
//re-create
$results=DB::select( DB::raw("
  create table propflyers
  like propflyerSynch
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
  FROM remailflyers_federated
"));
//add history from old server
include('synchResetFlyerCombined.php');
//2nd backup
//delete if exists
Schema::dropIfExists('propflyerSynch');
//re-create
$results=DB::select( DB::raw("
  create table propflyerSynch
  like propflyers
"));
//insert
$results = DB::select( DB::raw("
    INSERT INTO propflyerSynch
    SELECT *
    FROM propflyers
"));

include(app_path().'/synch/resets/synchResetMeta.php');
include(app_path().'/synch/resets/synchResetRemarks.php');
include(app_path().'/synch/resets/synchResetMapping.php');
include(app_path().'/synch/resets/synchResetStat.php');
include(app_path().'/synch/flyer_officeID.php');
include(app_path().'/synch/assignSK1.php');

//output json & exit
$idArray = array(
  'status'  => 'success',
);
echo json_encode($idArray);
exit();
