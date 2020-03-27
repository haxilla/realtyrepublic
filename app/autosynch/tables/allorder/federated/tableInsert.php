<?php

// GLOBAL transaction isolation level changed 
// to track number of records during insert
// reverted back to repeatable-read when completed
DB::statement("
  SET GLOBAL TRANSACTION ISOLATION LEVEL READ UNCOMMITTED;
");

// ** BEGIN INSERT
// Insert
DB::select( DB::raw("
  INSERT INTO $tableMains
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
  SELECT            
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
  FROM remailsynch.$tableFed
"));

//revert back to default
DB::statement("
  SET GLOBAL TRANSACTION ISOLATION LEVEL REPEATABLE READ;
");