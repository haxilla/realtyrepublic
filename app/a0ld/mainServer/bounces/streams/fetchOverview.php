<?php

//sets max records
$max=100;

if($num_msg>$max){
	$max=100;
}else{
	$max=$num_msg;}

//result
$result = imap_fetch_overview($mbox,"1:$max",0);

//reverse sort by array key
//to get last recieved first
krsort($result);