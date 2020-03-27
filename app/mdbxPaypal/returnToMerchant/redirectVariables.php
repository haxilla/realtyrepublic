<?php
// variable from paypal post
// return to merchant variables
$payer_email            = request('payer_email');
$payer_id               = request('payer_id');
$payer_status           = request('payer_status');
$first_name             = request('first_name');
$last_name              = request('last_name');
$txn_id                 = request('txn_id');
$mc_currency            = request('mc_currency');
$mc_fee                 = request('mc_fee');
$mc_gross               = request('mc_gross');
$protection_eligibility = request('protection_eligibility');
$payment_fee            = request('payment_fee');
$payment_gross          = request('payment_gross');
$payment_status         = request('payment_status');
$payment_type           = request('payment_type');
$item_name              = request('item_name');
$item_number            = request('item_number');
$txn_type               = request('txn_type');
$payment_date           = request('payment_date');
$business               = request('business');
$receiver_id            = request('reciever_id');
$custom                 = request('custom');
