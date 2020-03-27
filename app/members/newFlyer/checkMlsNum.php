<?php
//set models
Use App\models\core\propflyer;
Use App\models\core\tempflyer;

//detect duplicate
$flyerExists=propflyer::where('propagent_id','=',"$umid")
->where('xMlsNum','=',"$xMlsNum")
->first();

if($flyerExists){
   dd('duplicate found');}

$tempExists=tempflyer::where('propagent_id','=',"$umid")
->where('tempMlsNum','=',"$xMlsNum")
->first();

if($tempExists){
   //update
   tempFlyer::where('propagent_id','=',"$umid")
   ->where('tempMlsNum','=',"$xMlsNum")
   ->update([
      'tempMlsNum'=>$xMlsNum
   ]);
}

$tempInfo=tempFlyer::where('mdbxid','=',"$mdbxid")
->first();
