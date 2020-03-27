<?php

//set now
$now=\Carbon\Carbon::now();
$origNow=\Carbon\Carbon::now();
// change the timezone of the object without changing it's time
$nowPhx=$origNow->setTimezone(new DateTimeZone('America/Phoenix'));

$date 			= new DateTime();
$timeZone 		= $date->getTimezone();
$showTimeZone 	= $timeZone->getName();


// THESE WORKED ONES ABOVE NOT WORKING
// time conversion if needed
// $nowPhx=\Carbon\Carbon::now()->setTimezone(new DateTimeZone('America/Phoenix'));
// $nowPhxPlus4h=\Carbon\Carbon::now()->setTimezone(new DateTimeZone('America/Phoenix'))->addHours(4);
// $hoursAgo4Phx=\Carbon\Carbon::now()->setTimezone(new DateTimeZone('America/Phoenix'))->subHours(4);

dd($now,$origNow,$nowPhx,date_default_timezone_get(),$date,$timeZone,$showTimeZone);