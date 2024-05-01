<?php

//create federated table
//first need to get by original field names
$results=DB::select( DB::raw("
  CREATE TABLE remailsynch.$tableFed (
    umid                    int(11),
    receiver_email          varchar(255),
    payment_status          varchar(255),
    payment_date            datetime,
    payment_gross           float(6,2),
    payment_fee             float(6,2),
    txn_id                  varchar(255),
    payment_type            varchar(255),
    payer_id                varchar(255),
    txn_type                varchar(255),
    item_number             int(11),
    item_name               varchar(255),
    fixed                   int(11),
    PRIMARY KEY  (umid)
  )
  ENGINE=FEDERATED
  DEFAULT CHARSET=latin1
  CONNECTION='mysql://oldsiteuser:D4vidB0wi3!@()@www.realtyemails.com:3306/maindata/$tableOld';
"));
// **  connection string reference
// **  scheme://user_name[:password]@host_name[:port_num]/db_name/tbl_name