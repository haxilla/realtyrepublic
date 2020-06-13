<?php
//models
use App\models\core\propagentcleanup;

//check if record exists
$recordExists=propagentcleanup::where('propagent_id','=',$thisID)
->first();

//blank newRemID must be created or updated
if(!$existingRemID){
   if($recordExists){
      //update
      propagentcleanup::where('propagent_id','=',$thisID)
      ->update([
         'propagent_id'    => $thisID,
         'agtPhotoError'   => $agtPhotoError,
         'newRemID'        => $newRemID,
         'agtPhotoCheck'   => \Carbon\Carbon::now(),
      ]);
   }else{   
      //create sql
      propagentcleanup::create([
         'propagent_id'    => $thisID,
         'agtPhotoError'   => $agtPhotoError,
         'newRemID'        => $newRemID,
         'agtPhotoCheck'   => \Carbon\Carbon::now(),]);
   }

//otherwise newRemID exists - just update
}else{
   //update sql
   propagentcleanup::where('propagent_id','=',"$thisID")
   ->update([
      'agtPhotoCheck' => \Carbon\Carbon::now(),
      'agtPhotoError' => $agtPhotoError,]);}
