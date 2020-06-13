<?php

//REMOVED FROM SYNCH
//BECAUSE TABLE DOESNT CHANGE
//LAST RECORD WAS INSERTED 
//2016-12-23

//table check
if(!Schema::hasTable('propdelivs')){
    dd('no propdelivs table!');
};

if(!Schema::connection('remailsynch')
->hasTable('propdelivSynch')){
  $results=DB::select( DB::raw("
    create table remailsynch.propdelivSynch
    like propdelivs
  "));
};

if(!Schema::connection('remailsynch')
->hasTable('propdelivBackup')){
  $results=DB::select( DB::raw("
    create table remailsynch.propdelivBackup
    like propdelivs
  "));
};

//drop table if exists
Schema::dropIfExists('remaildeliveries_federated');
Schema::connection('remailsynch')
->dropIfExists('remaildeliveries_federated');
//create federated table
//first need to get by original field names
$results=DB::select( DB::raw("
  CREATE TABLE remailsynch.remaildeliveries_federated (
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
  CONNECTION='mysql://oldsiteuser:ZUb40d4vid@www.realtyemails.com:3306/maindata/remaildeliveries';
"));
// **  connection string reference
// **  scheme://user_name[:password]@host_name[:port_num]/db_name/tbl_name

//  ** BACKUP CODE
//backup existing propagent before dropping

//drop old
Schema::dropIfExists('propdelivBackup');
Schema::connection('remailsynch')
->dropIfExists('propdelivBackup');
//create propdelivBackup Table
$results=DB::select( DB::raw("
  create table remailsynch.propdelivBackup
  like propdelivs
"));
//insert
$results = DB::select( DB::raw("
    INSERT INTO remailsynch.propdelivBackup
    SELECT *
    FROM propdelivs
"));
//drop
Schema::dropIfExists('propdelivs');
//re-create
$results=DB::select( DB::raw("
  create table propdelivs
  like remailsynch.propdelivBackup
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
    aol_done,    
    cox_done,
    gmail_done,
    misc_done,
    msn_done,
    yahoo_done,
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
    aol_done,
    cox_done,    
    gmail_done,      
    misc_done,
    msn_done,
    yahoo_done,
    emalt_msn,
    emalt_yahoo,
    emalt_cox,
    emalt_aol,
    admin_add,
    authNum,
    remcreds,
    server,
    free
  FROM  remailsynch.remaildeliveries_federated
"));

//add history from old server
include('addArchive_remaildeliveries.php');

//2nd backup
//delete if exists
Schema::dropIfExists('propdelivSynch');
Schema::connection('remailsynch')
->dropIfExists('propdelivSynch');
//re-create
$results=DB::select( DB::raw("
  create table remailsynch.propdelivSynch
  like propdelivs
"));
//insert
$results = DB::select( DB::raw("
    INSERT INTO remailsynch.propdelivSynch
    SELECT *
    FROM propdelivs
"));

//output json & exit
$idArray = array(
  'status'      => 'success',
  'next'        => 'resetDelivNow',
  'message1'    => 'propdelivs Reset!',
  'message2'    => 'Now resetting propdelivnow...'
);
echo json_encode($idArray);
exit();
