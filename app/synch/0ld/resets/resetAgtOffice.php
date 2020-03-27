<?php
use Illuminate\Support\Facades\URL;
//set vars
$url=url::current();
$live=0;
if(strpos($url, 'realtyrepublic.com')!== false){
$live=1;}

//drop table if exists
if(!Schema::hasTable('agtoffices')){
  dd('no agtoffices table!!');}
//create table remailsynch.agtofficeSynch
//if not existing
if(!Schema::connection('remailsynch')
->hasTable('agtofficeSynch')){
  $results=DB::select( DB::raw("
    create table remailsynch.agtofficeSynch
    like agtoffices
  "));
};
//create table remailsynch.agtofficeBackup
//if not existing
if(!Schema::connection('remailsynch')
->hasTable('agtofficeBackup')){
  $results=DB::select( DB::raw("
    create table remailsynch.agtofficeBackup
    like agtoffices
  "));
};
//drop agtoffices_federate if exists
Schema::dropIfExists('agtoffices_federated');
Schema::connection('remailsynch')->
dropIfExists('agtoffices_federated');
//create new federated table
//first need to get by original field names
$results=DB::select( DB::raw("
  CREATE TABLE remailsynch.agtoffices_federated (
    officeID        varchar(255),
    xOfficeID       varchar(255),
    tempOfficeID    varchar(255),
    agentCompany    varchar(255),
    agentAddress    varchar(255),
    agentCity       varchar(255),
    agentState      varchar(255),
    agentZip        varchar(255),
    newRemID        varchar(255),
    umid            INT(20) NOT NULL AUTO_INCREMENT,
    PRIMARY KEY  (umid)
  )
  ENGINE=FEDERATED
  DEFAULT CHARSET=latin1
  CONNECTION='mysql://oldsiteuser:ZUb40d4vid@www.realtyemails.com:3306/maindata/emailagents';
"));

//drop backup if it exists
Schema::dropIfExists('agtofficeBackup');
Schema::connection('remailsynch')
->dropIfExists('agtofficeBackup');
//create agtofficeBackup Table
$results=DB::select( DB::raw("
  create table remailsynch.agtofficeBackup
  like agtoffices
"));
//insert
$results = DB::select( DB::raw("
    INSERT INTO remailsynch.agtofficeBackup
    SELECT *
    FROM agtoffices
"));

//drop
Schema::dropIfExists('agtoffices');
//re-create
$results=DB::select( DB::raw("
  create table agtoffices
  like remailsynch.agtofficeBackup
"));

$results = DB::select(DB::raw("
  INSERT IGNORE INTO agtoffices
  (
    officeID,
    xOfficeID,
    tempOfficeID,
    officeName,
    officeAddress1,
    officeCity,
    officeState,
    officeZip,
    propagent_id,
    newRemID
  )
  SELECT
    xOfficeID,
    officeID,
    tempOfficeID,
    agentCompany,
    agentAddress,
    agentCity,
    agentState,
    agentZip,
    umid,
    newRemID
  FROM remailsynch.agtoffices_federated
  "));

//  ** BACKUP CODE
//backup existing propagent before dropping
Schema::connection('remailsynch')
->dropIfExists('agtofficeSynch');
//create propagentSynch Table
$results=DB::select( DB::raw("
  create table remailsynch.agtofficeSynch
  like agtoffices
"));
//insert
$results = DB::select( DB::raw("
    INSERT INTO remailsynch.agtofficeSynch
    SELECT *
    FROM agtoffices
"));
//output json & exit
$idArray = array(
  'status'       => 'success',
  'next'         => 'resetFlyer',
  'message1'     => 'agtOffices Reset!',
  'message2'     => 'Now resetting Flyers...'
);
echo json_encode($idArray);
exit();
