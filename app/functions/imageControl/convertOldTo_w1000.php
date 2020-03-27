<?php

use App\models\core\propphoto;
//function called on from loop
include('mdbxImageOptimize.php');
//loop through results
foreach($newAdds as $the){
  //if count has w1000 otherwise make them
  if($the->thePhotos->count()>0){

    //dd('seems OK to me');

  }else{

    $originalPhotos=propphoto::select(
      'photoID','photoName','propflyer_id','def','ord',
      'propagent_id','width','height','ratio','orient')
    ->where('propflyer_id','=',"$the->id")
    ->where('resized','=','0')
    ->with(['theMeta'=>function($q){
      $q->select('propflyer_id','zipDir','mlsDir');
    }])
    ->get();

    //if(!$originalPhotos->first()){
    //  dd('check resize values');}

    //resize loop
    foreach($originalPhotos as $the){
      //if original is larger than 1000 make resize
      if($the->width > 1000){
        //get zip/mls dirs
        $zipDir=$the->theMeta->zipDir;
        $mlsDir=$the->theMeta->mlsDir;
        $idFly=$the->propflyer_id;
        $umid=$the->propagent_id;
        //if directory doesnt exist create it
        if (!is_dir("hqphotos/$zipDir/$mlsDir")) {
          mkdir("hqphotos/$zipDir/$mlsDir", 0777, true);}
        //set photoName
        $photoName=$the->photoName;
        //if not there / get it
        if(!file_exists("hqphotos/$zipDir/$mlsDir/$photoName")){
          //fetch image from realtyemails
          $url = "http://www.realtyemails.com/HQPhotos/$zipDir/$mlsDir/$photoName";
          $localImage = "hqphotos/$zipDir/$mlsDir/$photoName";
          file_put_contents($localImage, file_get_contents($url));
        }//end !if file_exists()

        //check if ratio
        if($the->ratio == 0){
          $width=$the->width;
          $height=$the->height;
          $ratio=$width/$height;
          $ratio=round($ratio,4);
          //update database
          propphoto::where('propflyer_id','=',"$idFly")
          ->update([
            'ratio'=>$ratio
          ]);
        }
        //run localImage through image optimizer
        include('flyerPhotos1000w600h.php');

      }//end if width > 1000

    }

  }

}
