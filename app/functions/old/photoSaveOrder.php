<?php

use App\propphoto;

$list=$_POST['list'];

$output=array();
$list=parse_str($list, $output);

foreach($output as $k => $v){

   //start loop at zero
   $loopCount=2;

   //loop through and update each order
   foreach($v as $v1){

      propphoto::where('photoID','=',"$v1")
      ->where('resized','=','500')
      ->update([
         'ord' => $loopCount
      ]);

      $loopCount++;
   }

}
