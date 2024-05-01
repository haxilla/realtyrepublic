<?php

$source="oldremails";
$password="juT5mMg7YmGzwDCLUiob";
$connectString="mysql://$source:$password@www.realtyemails.com:3306/maindata/$tableOld";

//create new federated table
//first need to get by original field names
$results=DB::select( DB::raw("
  CREATE TABLE remailsynch.$tableFed (
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
  CONNECTION='$connectString';
"));
// **  connection string reference
// **  scheme://user_name[:password]@host_name[:port_num]/db_name/tbl_name