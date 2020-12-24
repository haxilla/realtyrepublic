<?php
//drop table if exists
if(!Schema::hasTable('propdelivnow')){
  dd('no propdelivnow table!!');}

if(!Schema::connection('remailsynch')
->hasTable('propdelivnowSynch')){
  $results=DB::select( DB::raw("
    create table remailsynch.propdelivnowSynch
    like propdelivnow
  "));
};

if(!Schema::connection('remailsynch')
->hasTable('propdelivnowBackup')){
  $results=DB::select( DB::raw("
    create table remailsynch.propdelivnowBackup
    like propagents
  "));
};
//drop table if exists
Schema::dropIfExists('remaildeliveriesnow_federated');
Schema::connection('remailsynch')
->dropIfExists('remaildeliveriesnow_federated');
//create federated table
//first need to get by original field names
$results=DB::select( DB::raw("
  CREATE TABLE remailsynch.remaildeliveriesnow_federated (
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
    gmail_done          datetime,
    cox_done            datetime,
    msn_done            datetime,
    yahoo_done          datetime,
    aol_done            datetime,
    misc_done           datetime,
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
  CONNECTION='mysql://oldsiteuser:ZUb40d4vid@www.realtyemails.com:3306/maindata/remaildeliveriesnow';
"));
// **  connection string reference
// **  scheme://user_name[:password]@host_name[:port_num]/db_name/tbl_name

//  ** BACKUP CODE
//backup existing propagent before dropping
//drop current backup
Schema::dropIfExists('propdelivnowBackup');
Schema::connection('remailsynch')
->dropIfExists('propdelivnowBackup');
//create propdelivBackup Table
$results=DB::select( DB::raw("
  create table remailsynch.propdelivnowBackup
  like propdelivnow
"));
//insert
$results = DB::select( DB::raw("
    INSERT INTO remailsynch.propdelivnowBackup
    SELECT *
    FROM propdelivnow
"));
//drop
Schema::dropIfExists('propdelivnow');
//re-create
$results=DB::select( DB::raw("
  create table propdelivnow
  like remailsynch.propdelivnowBackup
"));

// ** BEGIN INSERT
// Insert
DB::select( DB::raw("
  INSERT INTO propdelivnow
    (
    propflyer_id,
    emSubject,
    emArea,
    emStart,
    emComplete,
    emRequest,
    cid,
    propagent_id,
    emArea_display,
    campLabel,
    totalEmails,
    lastEI,
    startRow,
    campCreated,
    template,
    priority,
    rush,
    rushDate,
    amtEmails,
    delay,
    resumeURL,
    emailsLeft,
    closingLine,
    removeLink,
    warp15,
    warp6,
    emAlt,
    suspend,
    authorized,
    camp_order,
    gmail_done,
    cox_done,
    msn_done,
    yahoo_done,
    aol_done,
    misc_done,
    emalt_msn,
    emalt_yahoo,
    emalt_cox,
    emalt_aol,
    admin_add,
    authNum,
    remCreds,
    server,
    free
    )
  SELECT
    ufid,
    emailSubject,
    emailarea,
    emailstarted,
    emailfinished,
    emailrequested,
    campaignid,
    umid,
    emailarea_display,
    camplabel,
    totalemails,
    lastei,
    sentsofar,
    campcreated,
    template,
    priority,
    rush,
    rushdate,
    amtemails,
    delay,
    resumeurl,
    emailsleft,
    closingline,
    removelink,
    warp15,
    warp6,
    emAlt,
    suspend,
    authorized,
    camp_order,
    gmail_done,
    cox_done,
    msn_done,
    yahoo_done,
    aol_done,
    misc_done,
    emalt_msn,
    emalt_yahoo,
    emalt_cox,
    emalt_aol,
    admin_add,
    authNum,
    remcreds,
    server,
    free
  FROM  remailsynch.remaildeliveriesnow_federated
"));
//2nd backup
//delete if exists
Schema::dropIfExists('propdelivnowSynch');
Schema::connection('remailsynch')
->dropIfExists('propdelivnowSynch');
//re-create
$results=DB::select( DB::raw("
  create table remailsynch.propdelivnowSynch
  like propdelivnow
"));
//insert
$results = DB::select( DB::raw("
    INSERT INTO remailsynch.propdelivnowSynch
    SELECT *
    FROM propdelivnow
"));

$results=DB::select( DB::raw("
   insert IGNORE into propdelivs
   select * from propdelivnow
   where emComplete is not null;
"));

$results=DB::select( DB::raw("
   delete from propdelivnow
   where emComplete is not null;
"));

//output json & exit
$idArray = array(
    'status'       => 'success',
    'next'         => 'reset_orders',
    'message1'     => 'propdelivnow reset',
    'message2'     => 'Now resetting orders...'
);

echo json_encode($idArray);
exit();
