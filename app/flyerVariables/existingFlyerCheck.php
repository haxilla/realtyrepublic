<?php
//get ID
$id=request('id');
//error if none
if(!$id){
   dd('error-line12-app/flyerVariables/existingFlyerCheck');}

use App\models\core\propmeta;

//try sk1
$flyerCheck=propmeta::select('propflyer_id','propagent_id')
->where('sk1','=',"$id")
->first();

if(!$flyerCheck){
   dd('error-line16-app/flyerVariables/existingFlyerCheck');}

$umid=$flyerCheck['propagent_id'];
$idFly=$flyerCheck['propflyer_id'];