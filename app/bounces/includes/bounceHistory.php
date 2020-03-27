<?php

Use App\bounces\models\bounceHistory;

// log all history 
// regardless of dups
bounceHistory::create([
	'email'			=>$the['email'],
	'msgDate'		=>$the['msgDate'],
	'checkDate'		=>\Carbon\Carbon::now(),
	'diagnostic'	=>$the['diagnostic'],]);