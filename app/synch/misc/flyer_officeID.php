<?php

use App\models\core\propagent;
use App\models\core\propflyer;
use App\models\maindata\maindataRemailFlyer;
use App\models\oldsite\oldFlyer;

// adds officeID to flyers where there is none
$getOfficeID=propflyer::select('id','propagent_id')
->whereNull('officeID')
->get();

$archiveOfficeID=maindataRemailFlyer::select('ufid','umid')
->whereNull('officeID')
->get();

foreach($getOfficeID as $the){

   $getAgent=propagent::select('officeID')
   ->where('id','=',"$the->propagent_id")
   ->first();

   $officeID=$getAgent['officeID'];

   if(!$officeID){
      //set generic OID
      $officeID='OID';
      propagent::where('id','=',$the->propagent_id)
      ->update([
         'officeID'=>$officeID
      ]);
      propflyer::where('id','=',"$the->id")
      ->update([
        'officeID'=>$officeID,
      ]);

      $result=oldFlyer::where('ufid','=',"$the->id")
      ->select('umid','e_address')
      ->first();

      oldFlyer::where('ufid','=',"$the->id")
      ->update([
        'officeID2'=>$officeID,
      ]);

      //dd('1',$officeID,$the->id,$result);

   }else{

      propflyer::where('id','=',"$the->id")
      ->update([
        'officeID'=>$officeID,
      ]);

      $result=oldFlyer::where('ufid','=',"$the->id")
      ->select('umid','e_address')
      ->first();
      //USING OFFICEID2 ON REMOTE SERVER DUE TO AMBIGUOUS KEY
      oldFlyer::where('ufid','=',"$the->id")
      ->update([
        'officeID2'=>$officeID,
      ]);

      //dd('2',$officeID,$the->id,$result);
   }
}

foreach($archiveOfficeID as $the){
   $getAgent=propagent::select('officeID')
   ->where('id','=',"$the->umid")
   ->first();

   $officeID=$getAgent['officeID'];
   //if no officeID make one
   if(!$officeID){
      //set generic OID
      $officeID='OID';
      propagent::where('id','=',$the->propagent_id)
      ->update([
         'officeID'=>$officeID
      ]);
      //update maindata.remailflyers
      maindataRemailFlyer::where('ufid','=',"$the->ufid")
      ->update([
        'officeID'=>$officeID,
      ]);
   //if officeID from propagent, use it
   }else{
      //update maindata.remailflyers
      maindataRemailFlyer::where('ufid','=',"$the->ufid")
      ->update([
        'officeID'=>$officeID,
      ]);
   }
}
