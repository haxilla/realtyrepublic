<?php
use Auth;
use App\models\core\propagent;

//AUTH is using **passHash** for password field
//this is set in the User.php model getAuthPassword()
//checks 2 fields agtUname && xxAgtUname
if (Auth::attempt([
'agtUname' => $uName,
'password' => $thePswd],$rememberMe)
||
Auth::attempt([
'xxAgtUname'=> $uName,
'password' => $thePswd],$rememberMe)
||
Auth::viaRemember()){
	$loginOK=1;}

//  ***  If OK
//  ***  Update record with last login
if($loginOK){
	//set lastLogin
	$lastLogin=\Carbon\Carbon::now();
	//set umid
	$umid=Auth::guard('member')->user()->id;
	//update table
	propagent::where('id','=',"$umid")
	->update([
		'lastLogin'=>$lastLogin
	]);}