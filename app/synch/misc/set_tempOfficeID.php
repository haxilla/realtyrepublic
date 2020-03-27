<?php

Use App\models\core\agtoffice;
//find Nulls
$setTempOfficeID=agtoffice::select('propagent_id','tempOfficeID')
->where('tempOfficeID','=',"")
->orWhereNull('tempOfficeID')
->get();

foreach($setTempOfficeID as $the){
   //set thisID
   $thisID=$the['propagent_id'];
   //check office
   $getOffice=agtoffice::select('officeName','officeAddress1')
   ->where('propagent_id','=',"$thisID")
   ->first();
   //create ID
   include(app_path().'/synch/xOfficeID/setXofficeID.php');
   $tempOfficeIdChars=strlen($tempOfficeID);
   if($tempOfficeIdChars<10){
      include(app_path().'/functions/keyGens/ezshortUID.php');
      $tempOfficeID=$ezshortUID;}

   agtoffice::where('propagent_id','=',"$thisID")
   ->update([
      'tempOfficeID'=>$tempOfficeID,]);}
      //end of foreach loop
