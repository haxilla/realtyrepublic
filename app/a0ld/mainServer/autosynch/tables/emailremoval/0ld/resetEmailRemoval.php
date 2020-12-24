<?php

//drop table if exists
if(!Schema::hasTable('emailRemovals')){
    dd('NO emailRemovals TABLE!');};

if(!Schema::connection('remailsynch')
->hasTable('emailRemovalSynch')){
  $results=DB::select( DB::raw("
    create table remailsynch.emailRemovalSynch
    like emailRemovals
  "));
};
if(!Schema::connection('remailsynch')
->hasTable('emailRemovalBackup')){
  $results=DB::select( DB::raw("
    create table remailsynch.emailRemovalBackup
    like emailRemovals
  "));
};

Schema::dropIfExists('emailRemovals_federated');
Schema::connection('remailsynch')
->dropIfExists('emailRemovals_federated');
//create federated table
//first need to get by original field names
$results=DB::select( DB::raw("
  CREATE TABLE remailsynch.emailRemovals_federated (
    date  datetime,
    email varchar(255),
    ufid  int(11),
    eid   varchar(255),
    ip    varchar(255),
    ci    int(11),
    agentid varchar(255),
    index  (agentid)
  )
  ENGINE=FEDERATED
  DEFAULT CHARSET=latin1
  CONNECTION='mysql://oldsiteuser:ZUb40d4vid@www.realtyemails.com:3306/maindata/emailRemovals';
"));

// **  connection string reference
// **  scheme://user_name[:password]@host_name[:port_num]/db_name/tbl_name

//  ** BACKUP CODE
//backup existing propagent before dropping

Schema::dropIfExists('emailRemovalBackup');
Schema::connection('remailsynch')
->dropIfExists('emailRemovalBackup');
//create propagentSynch Table
$results=DB::select( DB::raw("
  create table remailsynch.emailRemovalBackup
  like emailRemovals
"));
//insert
$results = DB::select( DB::raw("
    INSERT INTO remailsynch.emailRemovalBackup
    SELECT *
    FROM emailRemovals
"));
//drop
Schema::dropIfExists('emailRemovals');

//re-create
$results=DB::select( DB::raw("
  create table emailRemovals
  like remailsynch.emailRemovalBackup
"));

// ** BEGIN INSERT
// Insert
DB::select( DB::raw("
  INSERT INTO emailRemovals
    (
      entry_date,
      email,
      propflyer_id,
      eid,
      ip,
      ci,
      agentid
    )
  SELECT
    date,
    email,
    ufid,
    eid,
    ip,
    ci,
    agentid
  FROM remailsynch.emailRemovals_federated
"));
//2nd backup
//delete if exists
Schema::dropIfExists('emailRemovalSynch');
Schema::connection('remailsynch')
->dropIfExists('emailRemovalSynch');
//re-create
$results=DB::select( DB::raw("
  create table remailsynch.emailRemovalSynch
  like emailRemovals
"));
//insert
$results = DB::select( DB::raw("
    INSERT INTO remailsynch.emailRemovalSynch
    SELECT *
    FROM emailRemovals
"));

//output json & exit
$idArray = array(
  'status'          => 'success',
  'next'            => 'etrack2018',
  'message1'        => 'emailRemovals Reset!',
  'message2'        => 'updating etrack2018'
);
echo json_encode($idArray);
exit();
