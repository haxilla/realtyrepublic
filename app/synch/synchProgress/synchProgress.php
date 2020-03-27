<?php

$table = request('table');
$synchID = request('synchID');

if(!$table){
	dd('error-line7-app/synch/synchProgress/synchProgress.php');}

if($table=='propagent'){
	include('tables/propagentCount.php');
}else if($table=='agtoffice'){
	dd('ready for agtoffices');
}else{
	dd('error finding table-synchProgress.php');
}