<?php

use App\autosynch\models\propphoto\propphotos;
use App\autosynch\models\propphoto\propphotoOld;
use App\autosynch\models\propphoto\propphotoCurArc;
use App\autosynch\models\propphoto\propphotoOldArc;

//update as resized=3 to mark as done but failed
propphotos::where('photoName','=',"$the->photoName")
->update([
  'resized'     => 3,
  'notFound'	  => 1,
  'existCheck'  => \Carbon\Carbon::now(),]);

//update as resized=3 to mark as done but failed
propphotoOld::where('locname','=',"$the->photoName")
->update([
  'resized'      => 3,
  'notFound'	   => 1,
  'exist_check'  => \Carbon\Carbon::now(),]);

//update as resized=3 to mark as done but failed
propphotoCurArc::where('locname','=',"$the->photoName")
->update([
  'resized'      => 3,
  'notFound'	   => 1,
  'exist_check'  => \Carbon\Carbon::now(),]);

//update as resized=3 to mark as done but failed
propphotoOldArc::where('locname','=',"$the->photoName")
->update([
  'resized'      => 3,
  'notFound'	   => 1,
  'exist_check'  => \Carbon\Carbon::now(),]);