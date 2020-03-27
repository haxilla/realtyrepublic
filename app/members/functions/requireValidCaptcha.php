<?php

use Request;
use Validator;

//default
$captchaPresent=1;

//validate
$validator = Validator::make($request::all(), [
'g-recaptcha-response' => 'required',]);

//if fails return back
if ($validator->fails()) {
	$captchaPresent=null;}

//set message to use in captchaV2validate
$errorMessage='loginModalCaptchaError';
//validate captcha
include(app_path().'/functions/inputHelpers/captchaV2validate.php');