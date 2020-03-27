<?php
//use model
use App\models\core\propagent;
//query agent
$checkAgent=propagent::where('id','=',"$umid")
->first();
//error if none
if(!$checkAgent){
	//ERROR send admin email
	$data=[
	'errorMessage'=>
	'agent doesnt exist! error-line59-mdbxIPNsimple',];
	//send error email to admin
	// this is if the purchase is neither 3 or 5
	$theSubject='Error with UMID!';
	include('paypalAdminError.php');}

$currentAccount=$checkAgent['accountType'];