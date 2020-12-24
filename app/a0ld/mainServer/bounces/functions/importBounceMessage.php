<?php

Use App\bounces\models\bounceMessage;

$check=bounceMessage::where('msgID','=',$msgID)
->first();

if(!$check){
	bounceMessage::create([
		'msgID'		=> $msgID,
		'plainmsg'	=> $plainmsg,
		'htmlmsg'	=> $htmlmsg,
		'rawBody'	=> $imap_body,
		'rawHeader'	=> $msg_header,
	]);
}

