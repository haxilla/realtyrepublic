<?php

//   ***   YOU ARE IN A LOOP            ***   //
//   ***   Current Record = $moveThis   ***   //

//models
use App\models\core\agtoffice;
use App\models\core\propagentmeta;
//set adminID
$adminID=\Auth::guard('admin')->user()->id;
//update
agtoffice::where('propagent_id','=',"$moveThis")
->update([
   'agentConfirmDelete'=>1,
   'officeConfirmDelete'=>1,
   'agentDeleteReason'  => 'Merged',
   'officeDeleteReason' => 'Merged',
   'agentClear'=>\Carbon\Carbon::now(),
   'mergedWith'=>$mainAccountID,
]);
//figure out current propoffice they came from
//if no other agents found delete from propoffice
