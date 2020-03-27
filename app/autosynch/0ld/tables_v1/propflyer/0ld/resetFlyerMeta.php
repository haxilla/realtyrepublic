<?php
Use App\models\core\propmeta;

if(!Schema::hasTable('propmetas')){
  dd('no propmetas table!!');};

if(!Schema::connection('remailsynch')
->hasTable('propmetaSynch')){
  $results=DB::select( DB::raw("
    create table remailsynch.propmetaSynch
    like propmetas
  "));}

//drop table if exists
Schema::dropIfExists('propmetas_federated');
Schema::connection('remailsynch')
->dropIfExists('propmetas_federated');
//create federated table
//first need to get by original field names
$results=DB::select( DB::raw("
  CREATE TABLE remailsynch.propmetas_federated (
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
Schema::connection('remailsynch')
->dropIfExists('propmetaBackup');
//create propagentSynch Table
$results=DB::select( DB::raw("
  create table remailsynch.propmetaBackup
  like propmetas
"));
//insert
$results = DB::select( DB::raw("
    INSERT INTO remailsynch.propmetaBackup
    SELECT *
    FROM propmetas
"));
//drop
Schema::dropIfExists('propmetas');
//re-create
$results=DB::select( DB::raw("
  create table propmetas
  like remailsynch.propmetaBackup
"));

// ** BEGIN INSERT
// Insert federated
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
FROM  remailsynch.propmetas_federated
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

//find spaces in zipDir
$trimMeta=propmeta::where('zipDir','like',' '.'%')
->select('propflyer_id','zipDir')
->get();
//loop & fix
foreach($trimMeta as $the){
  $fixedZip=trim($the->zipDir);
  propmeta::where('propflyer_id','=',"$the->propflyer_id")
  ->update([
    'zipDir'=>$fixedZip,
  ]);}

//2nd backup
//delete if exists
Schema::dropIfExists('propmetaSynch');
Schema::connection('remailsynch')
->dropIfExists('propmetaSynch');
//re-create
$results=DB::select( DB::raw("
  create table remailsynch.propmetaSynch
  like propmetas
"));
//insert
$results = DB::select( DB::raw("
    INSERT INTO remailsynch.propmetaSynch
    SELECT *
    FROM propmetas
"));

//output json & exit
$idArray = array(
  'status'          => 'success',
  'next'            => 'resetMapping',
  'message1'        => 'propmetas Reset!',
  'message2'        => 'Now resetting propmapping...'
);
echo json_encode($idArray);
exit();
