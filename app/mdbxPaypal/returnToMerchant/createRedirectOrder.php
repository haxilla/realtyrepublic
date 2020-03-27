<?php
use App\models\core\allorder;

//conversion for UTC Z literal time
//paypal errors with payment_date
//due to non-standardized date
//make string rather than timestamp and just save

allorder::create([
     'propagent_id'             => $umid,
     'payer_email'              => $payer_email,
     'payer_id'                 => $payer_id,
     'payer_status'             => $payer_status,
     'first_name'               => $first_name,
     'last_name'                => $last_name,
     'txn_id'                   => $txn_id,
     'mc_currency'              => $mc_currency,
     'mc_fee'                   => $mc_fee,
     'mc_gross'                 => $mc_gross,
     'protection_eligibility'   => $protection_eligibility,
     'payment_fee'              => $payment_fee,
     'payment_gross'            => $payment_gross,
     'payment_status'           => $payment_status,
     'payment_type'             => $payment_type,
     'item_name'                => $item_name,
     'item_number'              => $item_number,
     'payment_date'             => $payment_date,
     'business'                 => $business,
     'receiver_id'              => $receiver_id,
     'txn_type'                 => $txn_type,
     'redirect'                 => 1,
]);
