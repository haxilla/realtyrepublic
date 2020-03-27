<?php
//table check
if(!Schema::hasTable('propdelivs')){
  $results=DB::select( DB::raw("
    create table propdelivs
    like propdelivSynch
  "));
};
if(!Schema::hasTable('propdelivSynch')){
  $results=DB::select( DB::raw("
    create table propdelivSynch
    like propdelivs
  "));
};

//drop table if exists
Schema::dropIfExists('remaildeliveries_federated');
//create federated table
//first need to get by original field names
$results=DB::select( DB::raw("
  CREATE TABLE remaildeliveries_federated (
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
  CONNECTION='mysql://oldsiteuser:ZUb40d4vid@www.realtyemails.com:3306/maindata/remaildeliveries';
"));
// **  connection string reference
// **  scheme://user_name[:password]@host_name[:port_num]/db_name/tbl_name

//  ** BACKUP CODE
//backup existing propagent before dropping

//drop current backup
Schema::dropIfExists('propdelivBackup');
//create propdelivBackup Table
$results=DB::select( DB::raw("
  create table propdelivBackup
  like propdelivs
"));
//insert
$results = DB::select( DB::raw("
    INSERT INTO propdelivBackup
    SELECT *
    FROM propdelivs
"));
//drop
Schema::dropIfExists('propdelivs');
//re-create
$results=DB::select( DB::raw("
  create table propdelivs
  like propdelivSynch
"));

// ** BEGIN INSERT
// Insert
DB::select( DB::raw("
  INSERT INTO propdelivs
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
  FROM  remaildeliveries_federated
"));
//2nd backup
//delete if exists
Schema::dropIfExists('propdelivSynch');
//re-create
$results=DB::select( DB::raw("
  create table propdelivSynch
  like propdelivs
"));
//insert
$results = DB::select( DB::raw("
    INSERT INTO propdelivSynch
    SELECT *
    FROM propdelivs
"));
//insert all combined history
include('synchResetDelivCombined.php');
//output json & exit
$idArray = array(
  'status'  => 'success',
);
echo json_encode($idArray);
exit();
