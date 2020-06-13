<?php

//drop table if exists
if(!Schema::hasTable('allOrders')){
    dd('NO allOrders TABLE!');};

if(!Schema::connection('remailsynch')
->hasTable('allOrderSynch')){
  $results=DB::select( DB::raw("
    create table remailsynch.allOrderSynch
    like allOrders
  "));
};
if(!Schema::connection('remailsynch')
->hasTable('allOrderBackup')){
  $results=DB::select( DB::raw("
    create table remailsynch.allOrderBackup
    like allOrders
  "));
};

Schema::dropIfExists('orders_federated');
Schema::connection('remailsynch')
->dropIfExists('orders_federated');
//create federated table
//first need to get by original field names
$results=DB::select( DB::raw("
  CREATE TABLE remailsynch.orders_federated (
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
  CONNECTION='mysql://oldsiteuser:ZUb40d4vid@www.realtyemails.com:3306/maindata/orders';
"));
// **  connection string reference
// **  scheme://user_name[:password]@host_name[:port_num]/db_name/tbl_name

//  ** BACKUP CODE
//backup existing propagent before dropping

Schema::dropIfExists('allOrderBackup');
Schema::connection('remailsynch')
->dropIfExists('allOrderBackup');
//create propagentSynch Table
$results=DB::select( DB::raw("
  create table remailsynch.allOrderBackup
  like allOrders
"));
//insert
$results = DB::select( DB::raw("
    INSERT INTO remailsynch.allOrderBackup
    SELECT *
    FROM allOrders
"));
//drop
Schema::dropIfExists('allOrders');

//re-create
$results=DB::select( DB::raw("
  create table allOrders
  like remailsynch.allOrderBackup
"));

// ** BEGIN INSERT
// Insert
DB::select( DB::raw("
  INSERT IGNORE INTO allOrders
    (
    propagent_id,
    receiver_email,
    payment_status,
    payment_date,
    payment_gross,
    payment_fee,
    txn_id,
    payment_type,
    payer_id,
    txn_type,
    item_number
    )
  SELECT            /* values corresponding to ccOrders */
    umid,
    receiver_email, /* email          */
    payment_status, /* reason_text    */
    payment_date,   /* entry_date     */
    payment_gross,  /* amount         */
    payment_fee,    /* N/A            */
    txn_id,         /* invoice_number */
    payment_type,   /* trans_type     */
    payer_id,       /* trans_id       */
    txn_type,       /* cardco         */
    item_number     /* item_number    */
  FROM remailsynch.orders_federated
"));

//insert cc_orders into allOrders
include(app_path().'/synch/resets/order/cc_orders.php');

//2nd backup
//delete if exists
Schema::dropIfExists('allOrderSynch');
Schema::connection('remailsynch')
->dropIfExists('allOrderSynch');
//re-create
$results=DB::select( DB::raw("
  create table remailsynch.allOrderSynch
  like allOrders
"));
//insert
$results = DB::select( DB::raw("
    INSERT INTO remailsynch.allOrderSynch
    SELECT *
    FROM allOrders
"));

//output json & exit
$idArray = array(
  'status'          => 'success',
  'next'            => 'reset_emailRemovals',
  'message1'        => 'orders Reset!',
  'message2'        => 'Now resetting emailRemovals...'
);
echo json_encode($idArray);
exit();
