<?php

Use App\bounces\models\bounceReview;

$theMsgID=null;

$getMsgID=bounceReview::select('reviewID','msgID')
->where('email','=',$checkEmail)
->first();

if($getMsgID){
	$theMsgID=$getMsgID['msgID'];}