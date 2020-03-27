<?php

use App\models\oldsite\oldAgent;
use App\models\core\propagent;
use App\models\core\agtoffice;


$getAgent=propagent::select('officeID','id')
->whereNotNull('officeID')
->whereNull('moved')
->get();

foreach($getAgent as $the){
   //original
   $oldOfficeID=$the->officeID;
   //new ID
   $newOfficeID=$oldOfficeID;
   //trim
   $newOfficeID=trim($newOfficeID);
   //remove spaces
   $newOfficeID=str_replace(' ','_',$newOfficeID);
   //all lowercase
   $newOfficeID=strtolower($newOfficeID);
   //rename directory
   if(is_dir("hqoffice/$oldOfficeID")){
      rename("hqoffice/$oldOfficeID", "hqoffice/$newOfficeID");
   }elseif(!is_dir("hqoffice/$newOfficeID")){
      //dd('error-line25-appPath/synch/officeDirectoryFix',$oldOfficeID,$newOfficeID);
   }

   //update agent
   propagent::where('id','=',"$the->id")
   ->update([
      'officeID'=>$newOfficeID,
      'moved'     => \Carbon\Carbon::now(),
   ]);

   //office
   agtoffice::where('propagent_id','=',"$the->id")
   ->update([
      'officeID'  => $newOfficeID,
   ]);

   //remote realtyemails
   $oldAgent=oldAgent::where('umid','=',"$the->id")
   ->select('officeID','umid')
   ->first();
   //set oldOfficeID
   $oldOfficeID=$oldAgent['officeID'];
   //error if none
   if(!$oldOfficeID){
      dd('error-line50-appPath/synch/officeDirectoryFix');}

   //show oldOfficeID
   dd($oldOfficeID);

   oldFlyer::where('ufid','=',"$theID")
   ->update([
      'officeID'  => $officeID,
      'moved'     => \Carbon\Carbon::now(),
   ]);

}
