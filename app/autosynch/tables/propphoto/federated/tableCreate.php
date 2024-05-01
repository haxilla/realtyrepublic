<?php

include(app_path().'/autosynch/tables/mysqlconn.php');

//create federated table
//first need to get by original field names
$results=DB::select( DB::raw("
  CREATE TABLE remailsynch.$tableFed (
    exist_check datetime,
    photodate   datetime,
    photoID     int,
    ufid        int,
    umid        int,
    locname     varchar(255),
    resized     int,
    def         boolean,
    width       int,
    height      int,
    orient      varchar(255),
    origname    varchar(255),
    filesize    int,
    filesize2   int,
    ord         int,
    chosen      boolean,
    notFound    boolean,
    localFound  boolean,
    remoteFound boolean,
    PRIMARY KEY  (photoID)
  )
  ENGINE=FEDERATED
  DEFAULT CHARSET=latin1
  CONNECTION='mysql://oldsiteuser:D4vidB0wi3!@()@www.realtyemails.com:3306/maindata/$tableOld';
"));
// **  connection string reference
// **  scheme://user_name[:password]@host_name[:port_num]/db_name/tbl_name
