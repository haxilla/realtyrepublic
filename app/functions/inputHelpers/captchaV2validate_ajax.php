<?php 

//key v2
$secret='6LfSH4kUAAAAAB6RGx4o13Mdfd9UDP41mtNveyy8';
$captcha=$_POST['g-recaptcha-response'];
//set response
$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
//decode into json
$json=json_decode($response);
//set success
$success=$json->success;
//if false error
//v2 captcha
if($success==false){
	$data=['error-line15-app/functions/inputhelper/cv2_ajax'];
	//Do something with error
	return response()->json(['errors'=>$data,]);}