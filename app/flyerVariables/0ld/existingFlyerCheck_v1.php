<?php
//get ID
$id=request('id');
//error if none
if(!$id){
   dd('error-line12-app/flyerVariables/existingFlyerCheck');}

use App\models\core\propmeta;

//for admin
if(Auth::guard('admin')){
   //try sk1
   $flyerCheck=propmeta::select('propflyer_id','propagent_id')
   ->where('sk1','=',"$id")
   ->first();
   //try mdbxid
   if(!$flyerCheck){
      $flyerCheck=propmeta::select('propflyer_id','propagent_id')
      ->where('mdbxid','=',"$id")
      ->first();}

   if(!$flyerCheck){
      dd('error-line18-app/flyerVariables/existingFlyerCheck');}

   $umid=$flyerCheck['propagent_id'];
   $idFly=$flyerCheck['propflyer_id'];

//for member
}elseif(Auth::guard('member')){
   //set umid
   $umid=Auth::guard('member')->user()->id;
   //check for record
   $flyerCheck=propmeta::select('propflyer_id','propagent_id')
   ->where('propagent_id','=',"$umid")
   ->where('sk1','=',"$id")
   ->first();
   //error if none
   if(!$flyerCheck){
      dd('error-line34-appPath/flyerVariables/existingFlyerCheck');}
   //set idFly
   $idFly=$flyerCheck['propflyer_id'];
}else{
   //error
   dd('error-line28-flyerVariables/existingFlyerCheck.php');}

