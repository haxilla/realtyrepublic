<?php

//create federated table
//first need to get by original field names
$results=DB::select( DB::raw("
  CREATE TABLE remailsynch.$tableFed (
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
  CONNECTION='mysql://oldsiteuser:ZUb40d4vid@www.realtyemails.com:3306/maindata/$tableOld';
"));
// **  connection string reference
// **  scheme://user_name[:password]@host_name[:port_num]/db_name/tbl_name
