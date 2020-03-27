<?php
//drop table if exists
if(!Schema::hasTable('propagents')){
  dd('no propagents table!!');}

if(!Schema::connection('remailsynch')
->hasTable('propagentSynch')){
  $results=DB::select( DB::raw("
    create table remailsynch.propagentSynch
    like propagents
  "));
};

if(!Schema::connection('remailsynch')
->hasTable('propagentBackup')){
  $results=DB::select( DB::raw("
    create table remailsynch.propagentBackup
    like propagents
  "));
};

Schema::dropIfExists('emailagents_federated');
Schema::connection('remailsynch')
->dropIfExists('emailagents_federated');
//create federated table
//first need to get by original field names
$results=DB::select( DB::raw("
  CREATE TABLE remailsynch.emailagents_federated (
    startDate     DATETIME,
    expireDate    DATETIME,
    last_login    DATETIME,
    removalDate   DATETIME,
    umid          INT(20) NOT NULL AUTO_INCREMENT,
    username      VARCHAR(255),
    password      VARCHAR(255),
    agentPhoto    VARCHAR(255),
    logo          VARCHAR(255),
    agentName     VARCHAR(255),
    agentFirst    VARCHAR(255),
    agentLast     VARCHAR(255),
    agentDesigs   VARCHAR(255),
    agentPhone    VARCHAR(255),
    agentPhone2   VARCHAR(255),
    agentEmail    VARCHAR(255),
    agentWebsite  VARCHAR(255),
    agentCity     VARCHAR(255),
    agentState    VARCHAR(255),
    agentZip      VARCHAR(255),
    board         VARCHAR(255),
    officeID      VARCHAR(255),
    xOfficeID     VARCHAR(255),
    tempOfficeID  VARCHAR(255),
    agentID       VARCHAR(255),
    agtURL        VARCHAR(25),
    accountType   INT(11),
    IP            VARCHAR(255),
    pCred         INT(11),
    remCreds      INT(11),
    PRIMARY KEY  (umid)
  )
  ENGINE=FEDERATED
  DEFAULT CHARSET=latin1
  CONNECTION='mysql://oldsiteuser:ZUb40d4vid@www.realtyemails.com:3306/maindata/emailagents';
"));
// **  connection string reference
// **  scheme://user_name[:password]@host_name[:port_num]/db_name/tbl_name

//  ** BACKUP CODE
//backup existing propagent before dropping
Schema::dropIfExists('propagentBackup');
Schema::connection('remailsynch')
->dropIfExists('propagentBackup');
//create propagentBackup Table
$results=DB::select( DB::raw("
  create table remailsynch.propagentBackup
  like propagents
"));
//insert
$results = DB::select( DB::raw("
    INSERT INTO remailsynch.propagentBackup
    SELECT *
    FROM propagents
"));
//drop
Schema::dropIfExists('propagents');
//re-create
$results=DB::select( DB::raw("
  create table propagents
  like remailsynch.propagentBackup
"));

// ** BEGIN INSERT
// Insert
DB::select( DB::raw("
INSERT INTO propagents
  (
    startDate,
    expireDate,
    lastLogin,
    removalDate,
    id,
    xxagtUname,
    agtPswd,
    agtPhoto,
    agtLogo,
    agtFullName,
    agtFirst,
    agtLast,
    agtURL,
    agtDesigs,
    agtMainPhone,
    agtPhone2,
    agtEmail,
    agtWebsite,
    agtCity,
    agtState,
    agtZip,
    agtBoard,
    officeID,
    agtMLSID,
    accountType,
    IP,
    pCreds,
    remCreds
  )
SELECT
  startDate,
  expireDate,
  last_login,
  removalDate,
  umid,
  username,
  password,
  agentPhoto,
  logo,
  agentName,
  agentFirst,
  agentLast,
  agtURL,
  agentDesigs,
  agentPhone,
  agentPhone2,
  agentEmail,
  agentWebsite,
  agentCity,
  agentState,
  agentZip,
  board,
  officeID,
  agentID,
  accountType,
  IP,
  pCred,
  remCreds
FROM remailsynch.emailagents_federated
"));

//2nd backup
//delete if exists
Schema::dropIfExists('propagentSynch');
Schema::connection('remailsynch')
->dropIfExists('remailsynch.propagentSynch');
//re-create
$results=DB::select( DB::raw("
  create table remailsynch.propagentSynch
  like propagents
"));
//insert
$results = DB::select( DB::raw("
    INSERT INTO remailsynch.propagentSynch
    SELECT *
    FROM propagents
"));
//output json & exit
$idArray = array(
  'status'       => 'success',
  'next'         => 'resetOffice',
  'message1'     => 'propagents Reset!',
  'message2'     => 'Now resetting AgtOffices...'
);
echo json_encode($idArray);
exit();
