<?php

//create federated table
//first need to get by original field names
$results=DB::select( DB::raw("
  CREATE TABLE remailsynch.$tableFed (
    ufid                INT,
    emailSubject        varchar(255),
    emailarea           varchar(255),
    emailstarted        datetime,
    emailfinished       datetime,
    emailrequested      datetime,
    campaignid          INT,
    umid                INT,
    emailarea_display   varchar(255),
    camplabel           varchar(255),
    totalemails         INT,
    lastei              datetime,
    sentsofar           INT,
    campcreated         datetime,
    template            varchar(255),
    priority            BOOLEAN,
    rush                BOOLEAN,
    rushdate            datetime,
    amtemails           INT,
    delay               INT,
    resumeurl           varchar(255),
    emailsleft          INT,
    closingline         varchar(255),
    removelink          varchar(255),
    warp15              INT,
    warp6               INT,
    emAlt               INT,
    suspend             BOOLEAN,
    authorized          boolean,
    camp_order          INT,
    aol_done            datetime,
    cox_done            datetime,
    gmail_done          datetime,
    misc_done           datetime,
    msn_done            datetime,
    yahoo_done          datetime,
    emalt_msn           INT,
    emalt_yahoo         INT,
    emalt_cox           INT,
    emalt_aol           INT,
    admin_add           BOOLEAN,
    authNum             varchar(255),
    remcreds            INT,
    server              varchar(255),
    free                boolean,
    PRIMARY KEY  (campaignid)
  )
  ENGINE=FEDERATED
  DEFAULT CHARSET=latin1
  CONNECTION='mysql://oldsiteuser:D4vidB0wi3!@()@www.realtyemails.com:3306/maindata/$tableOld';
"));
// **  connection string reference
// **  scheme://user_name[:password]@host_name[:port_num]/db_name/tbl_name