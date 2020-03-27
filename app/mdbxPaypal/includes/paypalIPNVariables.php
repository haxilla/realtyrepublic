<?php
if(isset($_POST['test_ipn'])){
   $test_ipn=$_POST['test_ipn'];
}else{
   $test_ipn=0;}

$receiver_email         = $_POST['receiver_email'];
$receiver_id            = $_POST['receiver_id'];
$txn_id                 = $_POST['txn_id'];
if(isset($_POST['receipt_id'])){
	$receipt_id          = $_POST['receipt_id'];
}else{
	$receipt_id=0;}

$txn_type               = $_POST['txn_type'];
$payment_status         = $_POST['payment_status'];
$payment_type           = $_POST['payment_type'];

if(isset($_POST['payment_gross'])){
	$payment_gross          = $_POST['payment_gross'];
	$payment_fee            = $_POST['payment_fee'];
}else{
	$payment_gross=0;
	$payment_fee=0;}

$mc_gross               = $_POST['mc_gross'];
$mc_fee                 = $_POST['mc_fee'];
$mc_currency            = $_POST['mc_currency'];
// SHIPPING FIELDS //
//$address_name           = $_POST['address_name'];
//$address_street         = $_POST['address_street'];
//$address_city           = $_POST['address_city'];
//$address_state          = $_POST['address_state'];
//$address_zip            = $_POST['address_zip'];
//$address_country_code   = $_POST['address_country_code'];
//$address_status         = $_POST['address_status'];
$first_name             = $_POST['first_name'];
$last_name              = $_POST['last_name'];
$payer_id               = $_POST['payer_id'];
$payer_email            = $_POST['payer_email'];
$payer_status           = $_POST['payer_status'];
$business               = $_POST['business'];
$item_name              = $_POST['item_name'];
$item_number            = $_POST['item_number'];

if(isset($_POST['protection_eligibility'])){
	$protection_eligibility = $_POST['protection_eligibility'];
}else{
	$protection_eligibility = 0;}



