<?php

//   ***   YOU ARE IN A LOOP   ***   //
//   *** Current Value is $t   ***   //

//model
Use App\models\core\propphoto;
Use App\models\oldsite\oldPhoto;

//include photoLoopVariables
include(app_path().'/synch/photoW1000/variables/photoLoopVariables.php');
//update as resized=2 to mark as done but failed
propphoto::where('photoID','=',"$t->photoID")
->update([
  'resized'     => 2,
  'ratio'       => $ratio,
  'existCheck'  => \Carbon\Carbon::now(),]);
//oldPhoto = realtyemails.com
oldPhoto::where('photoID','=',"$t->photoID")
->update([
  'resized'      => 2,
  'ratio'        => $ratio,
  'exist_check'  => \Carbon\Carbon::now(),]);
