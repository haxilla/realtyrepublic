<?php

include(app_path().'/autosynch/tables/mysqlconn.php');

//create federated table
//first need to get by original field names
$results=DB::select( DB::raw("
  CREATE TABLE remailsynch.$tableFed (
    date  datetime,
    email varchar(255),
    ufid  int(11),
    eid   varchar(255),
    ip    varchar(255),
    ci    int(11),
    agentid varchar(255),
    index  (agentid)
  )
  ENGINE=FEDERATED
  DEFAULT CHARSET=latin1
  CONNECTION='$connectString';
"));

// **  connection string reference
// **  scheme://user_name[:password]@host_name[:port_num]/db_name/tbl_name