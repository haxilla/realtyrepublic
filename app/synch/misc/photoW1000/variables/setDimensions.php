<?php 

//get width & height
list($width, $height) = getimagesize($localURL);

//set orient
if($width>$height){
	$orient='wide';
}else{
	$orient='tall';}

$ratio=$width/$height;
$ratio=round($ratio,4);

if(!$width||!$height||!$orient||!$ratio||
$width==0||$height==0||$ratio==0){
	dd('error-line17-autosynch/variables/setDimensions');}