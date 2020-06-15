<?php
//get models
use App\models\core\propmeta;
use App\models\oldsite\oldFlyer;

//remote server with bad sk1
/*
$remoteSK1=oldFlyer::select('ufid')
->where('sk1','like','%'.'='.'%')
->get();
*/

$localSK1=propmeta::select('propflyer_id')
->whereNull('sk1')
->orWhere('sk1','like','%'.'='.'%')
->get();

//gen password function (sets sk1 value)
require_once(app_path().'/members/keygens/mdbxGenPswd.php');

//local propmetas table
foreach($localSK1 as $the){

  $digits=rand(10,20);
  $sk1=generatePassword($digits);

   //update
   propmeta::where('propflyer_id','=',"$the->propflyer_id")
   ->update([
      'sk1'=>$sk1,
   ]);
   oldFlyer::where('ufid','=',"$the->propflyer_id")
   ->update([
      'sk1'=>$sk1,
   ]);}
