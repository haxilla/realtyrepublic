<?php

if(!Schema::hasTable('propstyles')){
  dd('no propstyle table!!');};

if(!Schema::hasTable('propstyleSynch')){
  $results=DB::select( DB::raw("
    create table propstyleSynch
    like propstyles
  "));}

//drop table if exists
Schema::dropIfExists('remailstyles_federated');
//create federated table
//first need to get by original field names
$results=DB::select( DB::raw("
  CREATE TABLE remailstyles_federated (
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
  CONNECTION='mysql://oldsiteuser:ZUb40d4vid@www.realtyemails.com:3306/maindata/remailstyles';
"));
// **  connection string reference
// **  scheme://user_name[:password]@host_name[:port_num]/db_name/tbl_name

//  ** BACKUP CODE
//backup existing propagent before dropping

Schema::dropIfExists('propstyleBackup');
//create propagentSynch Table
$results=DB::select( DB::raw("
  create table propstyleBackup
  like propstyles
"));
//insert
$results = DB::select( DB::raw("
    INSERT INTO propstyleBackup
    SELECT *
    FROM propstyles
"));
//drop
Schema::dropIfExists('propstyles');
//re-create
$results=DB::select( DB::raw("
  create table propstyles
  like propstyleBackup
"));

// ** BEGIN INSERT
// Insert
DB::select( DB::raw("
INSERT INTO propstyles
  (
    propflyer_id,
    propagent_id,
    template,
    flyer_background,
    graphic_textcolor,
    graphic_words,
    graphic_style,
    accentbars,
    headline_bar_text,
    headline_text,
    headline_bar_bg,
    template_chosen,
    photos_chosen,
    headline_chosen,
    colors_chosen,
    text_chosen
  )
SELECT
  ufid,
  umid,
  template,
  flyer_background,
  graphic_textcolor,
  graphic_words,
  graphic_style,
  accentbars,
  headline_bar_text,
  headline_text,
  headline_bar_bg,
  template_chosen,
  photos_chosen,
  headline_chosen,
  colors_chosen,
  text_chosen
FROM remailstyles_federated
"));

//add archives
include('synchResetStyleCombined.php');

//2nd backup
//delete if exists
Schema::dropIfExists('propstyleSynch');
//re-create
$results=DB::select( DB::raw("
  create table propstyleSynch
  like propstyles
"));
//insert
$results = DB::select( DB::raw("
    INSERT INTO propstyleSynch
    SELECT *
    FROM propstyles
"));

//output json & exit
$idArray = array(
  'status'  => 'success',
);
echo json_encode($idArray);
exit();
