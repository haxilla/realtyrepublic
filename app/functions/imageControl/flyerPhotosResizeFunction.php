<?php
//get models
use App\models\core\propphoto;
use App\models\core\propmeta;

//run query
$resizeThis=propphoto::select(
   'propflyer_id','photoName','width',
   'height','orient','ratio','ord','def',
   'oldFileSize','photoID'
)->with(['theMeta'=>function($q){
   $q->select('zipDir','mlsDir','propflyer_id','sk1');
}])
->where('propflyer_id','=',"$idFly")
->where('propagent_id','=',"$umid")
->where('resized','=',null)
->get();
//if records - run loop
if($resizeThis->count()>0){
   //include image optimize function
   require_once('mdbxImageOptimize.php');

   foreach($resizeThis as $t){
      //how big is original photo
      $thisOrient = $t->orient;
      $thisWidth  = $t->width;
      $zipDir     = $t->theMeta->zipDir;
      $mlsDir     = $t->theMeta->mlsDir;

      if($thisOrient=='wide' && $thisWidth>=1000){
         include('flyerPhotos500w300h.php');
         include('flyerPhotos1000w600h.php');
      }elseif($thisOrient=='wide' && thisWidth>=500){
         include('flyerPhotos500w300h.php');
      }else{
         dd('error-line26-flyerPhotoResizeFunction');
      }
   }
}
