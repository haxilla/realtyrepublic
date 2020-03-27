<?php

Use App\bounces\models\bounceWorksheet;

$theList=$the->list;
$bounceID=$the->bounceID;
$email=$the->email;
$theModel="App\models\oldEmails\\$theList";
$distroFound=null;

$getEIDX=$theModel::select('eidx')
->where('email','=',$email)
->first();

$eidx=$getEIDX['eidx'];
if($eidx){
	$distroFound=1;}

bounceWorksheet::where('bounceID','=',$bounceID)
->update([
	'eidx'			=> $eidx,
	'distroFound'	=> $distroFound,
]);




