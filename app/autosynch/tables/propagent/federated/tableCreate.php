<?php
$password=urlencode('D4vidB0wi3!@()');

$results=DB::select( DB::raw("
  CREATE TABLE remailsynch.$tableFed (
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
  CONNECTION='mysql://oldsiteuser:$password@www.realtyemails.com:3306/maindata/$tableOld';
"));
// **  connection string reference
// **  scheme://user_name[:password]@host_name[:port_num]/db_name/tbl_name