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
  INSERT INTO $tableSchema.$tableMains
    (
      propagent_id,
      receiver_email,
      payment_status,
      payment_date,
      payment_gross,
      txn_id,
      payment_type,
      payer_id,
      txn_type,
      item_number,
      item_name
    )
  SELECT
    umid,
    email,
    reason_text,
    entry_date,
    amount,
    invoice_number,
    trans_type,
    trans_id,
    cardco,
    item_number,
    description
    FROM remarchives.$tableArchive
"));

//revert back to default
DB::statement("
  SET GLOBAL TRANSACTION ISOLATION LEVEL REPEATABLE READ;
");