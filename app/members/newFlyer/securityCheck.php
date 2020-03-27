<?php
use App\models\core\propmeta;

$mdbxid=request('mdbxid');
$umid=Auth::guard('web')->user()->id;

if(!$mdbxid||!$umid){
   dd('error-line10-mdbxSecurityCheck');}

//run query
$getID=propmeta::where('mdbxid','=',"$mdbxid")
->where('propagent_id','=',"$umid")
->first();
//error if none
if(!$getID){
   dd('error-line17-appPath/members/newFlyer/securityCheck');}

//set idFly
$idFly=$getID['propflyer_id'];


