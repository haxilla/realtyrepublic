<?php

include(app_path().'/autosynch/tables/mysqlconn.php');

//create federated table
//first need to get by original field names
$results=DB::select( DB::raw("
  CREATE TABLE remailsynch.$tableFed (
    creation          datetime,
    ufid              int,
    umid              int,
    e_MlsNum          varchar(255),
    e_MlsNum_Orig     varchar(255),
    e_ListPrice       varchar(255),
    e_Beds            varchar(255),
    e_Baths           varchar(255),
    e_Sqft            varchar(255),
    e_address         varchar(255),
    e_City            varchar(255),
    e_State           varchar(255),
    e_Zip             varchar(255),
    e_county          varchar(255),
    headline          text,
    e_YrBuilt         varchar(255),
    e_PoolPvt         varchar(255),
    e_Parking         varchar(255),
    e_RV              varchar(255),
    e_Fireplace       varchar(255),
    MlsLink           varchar(255),
    e_Virt_Tour       varchar(255),
    officeID2         varchar(255),
    PRIMARY KEY  (ufid),
    INDEX UMID (UMID)
  )
  ENGINE=FEDERATED
  DEFAULT CHARSET=latin1
  CONNECTION='$connectString';
"));

// **  connection string reference
// **  scheme://user_name[:password]@host_name[:port_num]/db_name/tbl_name