<?php

// not needed in synch, no information changes in this table
// One pull is sufficient to use as archive table is in maindata.ccOrder
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
    FROM maindata.cc_orders
"));
