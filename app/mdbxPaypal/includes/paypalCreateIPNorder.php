<?php

use App\models\core\allorder;

allorder::create([
    'propagent_id'           => $umid,
    'receiver_email'         => $receiver_email,
    'txn_id'                 => $txn_id,
    'receipt_id'             => $receipt_id,
    'txn_type'               => $txn_type,
    'payment_status'         => $payment_status,
    'payment_type'           => $payment_type,
    'payment_gross'          => $payment_gross,
    'payment_fee'            => $payment_fee,
    'mc_gross'               => $mc_gross,
    'mc_fee'                 => $mc_fee,
    'mc_currency'            => $mc_currency,
    // ** SHIPPING FIELDS
    //'address_name'           => $address_name,
    //'address_street'         => $address_street,
    //'address_city'           => $address_city,
    //'address_state'          => $address_state,
    //'address_zip'            => $address_zip,
    //'address_country_code'   => $address_country_code,
    //'address_status'         => $address_status,
    'first_name'             => $first_name,
    'last_name'              => $last_name,
    'payer_id'               => $payer_id,
    'payer_email'            => $payer_email,
    'payer_status'           => $payer_status,
    'business'               => $business,
    'item_name'              => $item_name,
    'item_number'            => $item_number,
    'test_ipn'               => $test_ipn,
    'protection_eligibility' => $protection_eligibility,
]);

if($accountType=='1'){
    allorder::where('txn_id','=',$txn_id)
    ->update([
        'shortKey'=>$theID,
    ]);}
