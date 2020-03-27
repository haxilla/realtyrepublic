<?php

Use App\models\core\propmapping;

$getGeo=propmapping::where('propflyer_id','=',"$idFly")
->whereNotNull('geoAddress')
->first();

if(!$getGeo){
   dd('error-line10-appPath/functions/getGoogleMap');}

$geoAddress=$getGeo['geoAddress'];
//SHOULD USE THIS IN PRODUCTION CURRENT PROCESS IS NOT SECURE
//$geocode=file_get_contents("https://maps.google.com/maps/api/geocode/json?address=$geoAddress&sensor=false&key=AIzaSyARwZL9ddEztjI7xCQrlyfNY5bzLr4Z8Tg");
$url="https://maps.google.com/maps/api/geocode/json?address=$geoAddress&sensor=false&key=AIzaSyARwZL9ddEztjI7xCQrlyfNY5bzLr4Z8Tg";
$geocode=file_get_contents($url, false, stream_context_create(array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false))));

//JSON DECODE RESPONSE
$output= json_decode($geocode);

//ASSIGN VARIABLES
//this part errors out if OUTPUT is not there
//write a script to detect if output failed
//put inside if statement
$googlat = $output->results[0]->geometry->location->lat;
$googlng = $output->results[0]->geometry->location->lng;

if(!$googlat||!$googlng){
   dd('error-line29-appPath/functions/getGooglat');}

propmapping::where('propflyer_id','=',"$idFly")
->update([
   'googlat'=>$googlat,
   'googlng'=>$googlng,
]);
