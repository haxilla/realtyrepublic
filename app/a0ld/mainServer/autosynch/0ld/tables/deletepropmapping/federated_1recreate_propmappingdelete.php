<?php
//drop table if exists
Schema::connection('remailsynch')
->dropIfExists('propmappingdelete_federated');
//create federated table
//first need to get by original field names
$results=DB::select( DB::raw("
  CREATE TABLE remailsynch.propmappingdelete_federated (
    ufid          int,
    umid          int,
    e_housenum    varchar(255),
    e_streetdir   varchar(255),
    e_streetName  varchar(255),
    e_stsuffix    varchar(255),
    region        varchar(255),
    e_mapgrid     varchar(255),
    e_county      varchar(255),
    e_subdivision varchar(255),
    e_xst         varchar(255),
    e_directions  varchar(255),
    PRIMARY KEY  (ufid)
  )
  ENGINE=FEDERATED
  DEFAULT CHARSET=latin1
  CONNECTION='mysql://oldsiteuser:ZUb40d4vid@www.realtyemails.com:3306/maindata/remailflyers';
"));
// **  connection string reference
// **  scheme://user_name[:password]@host_name[:port_num]/db_name/tbl_name