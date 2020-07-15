<?php

//get models
use App\models\core\propmeta;
use App\models\oldsite\oldFlyer;
use App\models\remarchives\remailflyersmaster;
/*
//remote server with bad sk1
$oldSK1=oldFlyer::select('ufid')
->where('sk1','like','%'.'='.'%')
->orWhereNull('sk1');
//count
$oldSK1count=$oldSK1->count();
*/

//query
$fixSK1=propmeta::select('propflyer_id')
->whereNull('sk1')
->orWhere('sk1','like','%'.'='.'%');
//get count
$sk1_fixCount=$fixSK1->count();
//notice if not needed
if(!$sk1_fixCount > 0){
  dd('no fix needed');}

//retrieve one record
$fixSK1=$fixSK1->take(1)->get();

//gen password funciton
require_once(app_path().'/members/keygens/mdbxGenPswd.php');

// *** start foreach
foreach($fixSK1 as $the){
  //set value
  $digits=rand(10,20);
  $genPswd=generatePassword($digits);
  $sk1=$genPswd;
  //update current
  propmeta::where('propflyer_id','=',"$the->propflyer_id")
  ->update([
    'sk1'=>$sk1,]);
  //archives
  remailflyersmaster::where('ufid','=',"$the->propflyer_id")
  ->update([
    'sk1'=>$sk1,]);
  //old server
  oldFlyer::where('ufid','=',"$the->propflyer_id")
  ->update([
    'sk1'=>$sk1,]);}
// ***************
// *** end foreach

$html=\View::make('admin.overlays.content.sk1Fix')
->with([
	'sk1_fixCount'	 => $sk1_fixCount,
])->render();

//echo
echo $html;
//exit
exit();
