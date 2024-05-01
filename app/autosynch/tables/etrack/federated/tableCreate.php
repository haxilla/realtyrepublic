<?php

include("mysqlconn.php");

//create federated table
//first need to get by original field names
$results=DB::select( DB::raw("
  CREATE TABLE remailsynch.$tableFed (
    etrackdate  timestamp,
    ufid       int(11),
    ei         int(11),
    ci         int(11),
    ip         varchar(255),
    eid        int(11),
    area       varchar(255),
    umid       int(11),
    email      varchar(255),
    etrackid   int(11),
    vt         int(11),
    mls        int(11),
    rm         int(11),
    server     varchar(255),
    notice     int(11),
    noticetime datetime,
    agtcontact tinyint(4),
    index  (etrackid)
  )
  ENGINE=FEDERATED
  DEFAULT CHARSET=latin1
  CONNECTION='$connectString';
"));

// **  connection string reference
// **  scheme://user_name[:password]@host_name[:port_num]/db_name/tbl_name