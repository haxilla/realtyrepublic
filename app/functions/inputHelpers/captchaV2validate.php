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