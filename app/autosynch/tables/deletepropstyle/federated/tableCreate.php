<?php

include("mysqlconn.php");

//create federated table
//first need to get by original field names
$results=DB::select( DB::raw("
  CREATE TABLE remailsynch.$tableFed (
    ufid                  int,
    umid                  int,
    template              varchar(255),
    flyer_background      varchar(255),
    graphic_textcolor     varchar(255),
    graphic_words         varchar(255),
    graphic_style         varchar(255),
    accentbars            varchar(255),
    headline_bar_text     varchar(255),
    headline_text         varchar(255),
    headline_bar_bg       varchar(255),
    template_chosen       boolean,
    photos_chosen         boolean,
    headline_chosen       boolean,
    colors_chosen         boolean,
    text_chosen           boolean,
    PRIMARY KEY  (ufid)
  )

  ENGINE=FEDERATED
  DEFAULT CHARSET=latin1
  CONNECTION='$connectString';

"));
// **  connection string reference
// **  scheme://user_name[:password]@host_name[:port_num]/db_name/tbl_name
