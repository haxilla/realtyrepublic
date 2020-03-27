<?php
//models
Use App\models\core\propphoto;
//set default
$maxResize=0;
//check 1000
$photo1000count=propphoto::where('propflyer_id','=',"$idFly")
->where('resized','=','1000')
->where('def','=','1')
->count();
//check 500
$photo500count=propphoto::where('propflyer_id','=',"$idFly")
->where('resized','=','500')
->where('def','=','1')
->count();

if($photo1000count &&
   $photo1000count == $photo500count){
   $maxResize=1000;}
//has no 1000
if(!$photo1000count && $photo500count){
   $maxResize=500;
}elseif($photo1000count){
   $maxResize=1000;
}else{
   $maxResize=0;}


//error if none
if(!$maxResize){
   dd($idFly,'error-line23-maxPhotoSize.php');}
