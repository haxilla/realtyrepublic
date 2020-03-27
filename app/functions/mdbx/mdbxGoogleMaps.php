<!doctype html>
<?php

use \App\propflyer;
use \App\propmapping;
use \App\qcreate;
use \App\propflyerstat;

$checkProp=propflyerstat::where('propflyer_id','=',"$newID")
->where('xAgtSent','>','0')
->first();

//if any records its ok to check and map
if($checkProp){

   $seoNames = propflyer::where("id","=","$newID")
   ->get();

   foreach($seoNames as $seo){
   	$seoCity=trim($seo->xCity);
   	$seoCity=str_replace(' ', '_', $seoCity);
   	$seoCity=str_replace('.', '', $seoCity);
   	$seoState=trim($seo->xState);
   	$seoZip=trim($seo->xZip);
   	$seoAddress=trim($seo->xFullStreet);
   	$seoAddress=str_replace(' ', '_', $seoAddress);
   	$seoAddress=str_replace('.', '', $seoAddress);
   }

   $seoAddress="$seoAddress"."_"."$seoCity"."_"."$seoState";
   $seoAddress=trim($seoAddress);

   $geoAddress=$seoAddress=str_replace('_', '+', $seoAddress);

   if(!$geoAddress){
      dd('ERROR WITH MAP Line 36');
   }

   //SHOULD USE THIS IN PRODUCTION CURRENT PROCESS IS NOT SECURE
   //$geocode=file_get_contents("https://maps.google.com/maps/api/geocode/json?address=$geoAddress&sensor=false&key=AIzaSyARwZL9ddEztjI7xCQrlyfNY5bzLr4Z8Tg");

   $url="https://maps.google.com/maps/api/geocode/json?address=$geoAddress&sensor=false&key=AIzaSyARwZL9ddEztjI7xCQrlyfNY5bzLr4Z8Tg";
   $geocode=file_get_contents(
      $url, false, stream_context_create(
         array(
            'ssl' => array(
               'verify_peer' => false, 'verify_peer_name' => false)
         )
      )
   );

   //JSON DECODE RESPONSE
   $output= json_decode($geocode);

   //ASSIGN VARIABLES
   $googlat = $output->results[0]->geometry->location->lat;
   $googlng = $output->results[0]->geometry->location->lng;

}

//check if it exists
$getMap=propmapping::where('propflyer_id','=',"$id")
->first();

//if a record exists in propmapping update
if($getMap){
   if(!$getMap->googlat){
      //USE VARIABLES TO GET COORDINATES AND MAP
      propmapping::where('propflyer_id','=', "$id")
      ->update([
         'geoAddress' => "$geoAddress",
         'seoAddress' => "$seoAddress",
         'googlat'    => "$googlat",
         'googlng'    => "$googlng"
      ]);
   }
}
?>
