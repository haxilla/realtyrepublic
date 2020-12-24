<?php

//   ***   THIS IS A LOOP
//   ***   CURRENT RECORD
//   ***   $moveThis

//get models
use App\models\core\propflyer;
use App\models\core\propphoto;
use App\models\core\propstyle;
use App\models\core\propmeta;
use App\models\core\propmapping;
use App\models\core\propflyerstat;
use App\models\core\propdeliv;
use App\models\core\propdelivnow;
use App\models\core\agtoffice;
//setup moved flyers log
$flyersMoved=0;
$flyerMoveNote=0;
$flyerIdsMoved=0;
if($theFlyerCount){
   $flyersMoved=1;
   if($flyerIdsMoved){
      $flyerIdsMoved=$moveThis;
   }else{
      $flyerIdsMoved=$flyerIdsMoved.','.$moveThis;}}

//propflyer
propflyer::where('propagent_id','=',"$moveThis")
->update([
   'propagent_id'=>$mainAccountID]);
//propphotos
propphoto::where('propagent_id','=',"$moveThis")
->update([
   'propagent_id'=>$mainAccountID]);
//propstyle
propstyle::where('propagent_id','=',"$moveThis")
->update([
   'propagent_id'=>$mainAccountID]);
//propmeta
propmeta::where('propagent_id','=',"$moveThis")
->update([
   'propagent_id'=>$mainAccountID]);
//propmappin
propmapping::where('propagent_id','=',"$moveThis")
->update([
   'propagent_id'=>$mainAccountID]);
//propflyerstat
propflyerstat::where('propagent_id','=',"$moveThis")
->update([
   'propagent_id'=>$mainAccountID]);
//propdeliv
propdeliv::where('propagent_id','=',"$moveThis")
->update([
   'propagent_id'=>$mainAccountID]);
//propdelivnow
propdelivnow::where('propagent_id','=',"$moveThis")
->update([
   'propagent_id'=>$mainAccountID]);



