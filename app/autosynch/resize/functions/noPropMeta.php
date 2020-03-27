<?php

//model
Use App\autosynch\models\propphoto\propphotos;
Use App\autosynch\models\propphoto\propphotoOld;
Use App\autosynch\models\propphoto\propphotoCurArc;
Use App\autosynch\models\propphoto\propphotoOldArc;

//update as resized=4 to mark as noMeta (no associated flyer)
propphotos::where('photoName','=',"$the->photoName")
->update([
  'resized'     => 4,
  'notFound'	  => 1,
  'existCheck'  => \Carbon\Carbon::now(),]);

//oldPhoto = realtyemails.com
propphotoOld::where('locname','=',"$the->photoName")
->update([
  'resized'      => 4,
  'notFound'	   => 1,
  'exist_check'  => \Carbon\Carbon::now(),]);

//oldPhoto = realtyemails.com
propphotoCurArc::where('locname','=',"$the->photoName")
->update([
  'resized'      => 4,
  'notFound'	   => 1,
  'exist_check'  => \Carbon\Carbon::now(),]);

//oldPhoto = realtyemails.com
propphotoOldArc::where('locname','=',"$the->photoName")
->update([
  'resized'      => 4,
  'notFound'	   => 1,
  'exist_check'  => \Carbon\Carbon::now(),]);

//output json & exit
$idArray = array(
	'status'=>$status,
	'synchID'=>$synchID,
	'synchType'=>$synchType,
	'currentSynch'=>$currentSynch,
);

echo json_encode($idArray);
exit();
