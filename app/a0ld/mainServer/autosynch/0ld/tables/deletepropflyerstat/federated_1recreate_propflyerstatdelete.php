<?php

//drop table if exists
Schema::connection('remailsynch')
->dropIfExists('propflyerstatdelete_federated');

//create federated table
//get by original field names
$results=DB::select( DB::raw("
  CREATE TABLE remailsynch.propflyerstatdelete_federated (
    ufid              INT,
    umid              INT,
    delivered         INT,
    mls_check         datetime,
    sellersendok      boolean,
    agent_sent        int,
    last_delivered    datetime,
    sold              boolean,
    hits              int,
    bonusamount       int,
    reducedamount     int,
    reduceDate        datetime,
    openDateOne       datetime,
    openDateTwo       datetime,
    PRIMARY KEY  (ufid)
  )
  ENGINE=FEDERATED
  DEFAULT CHARSET=latin1
  CONNECTION='mysql://oldsiteuser:ZUb40d4vid@www.realtyemails.com:3306/maindata/remailflyerdeletes';
"));
// **  connection string reference
// **  scheme://user_name[:password]@host_name[:port_num]/db_name/tbl_name