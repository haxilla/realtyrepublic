<?php

Schema::connection('remailsynch')
->dropIfExists('propremarkdelete_federated');
//create federated table
//create table with identical field names
$results=DB::select( DB::raw("
  CREATE TABLE remailsynch.propremarkdelete_federated (
    ufid          int,
    umid          int,
    remarkLink    boolean,
    e_remarks     text,
    b1            varchar(255),
    b2            varchar(255),
    b3            varchar(255),
    b4            varchar(255),
    b5            varchar(255),
    b6            varchar(255),
    b7            varchar(255),
    b8            varchar(255),
    PRIMARY KEY   (ufid),
    index         (umid)
  )
  ENGINE=FEDERATED
  DEFAULT CHARSET=latin1
  CONNECTION='mysql://oldsiteuser:ZUb40d4vid@www.realtyemails.com:3306/maindata/remailflyers';
"));
// **  connection string reference
// **  scheme://user_name[:password]@host_name[:port_num]/db_name/tbl_name