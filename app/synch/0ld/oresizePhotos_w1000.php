<?php
//set model
use App\models\core\propphoto;
use App\models\core\propflyer;
use App\models\oldsite\oldPhoto;

//determine if local or live
if(strpos(Request::url(),'.test')){
  $local=1;
  $live=0;
}else{
  $local=0;
  $live=1;}

//not allowed if local
if($local==1){
  //$localPhoto1000=$localPhoto1000->take(1);
  dd('NOT ACCESSIBLE BY LOCAL SERVER');}

//flyers sent or created in the last 30 days
$theDate=\Carbon\Carbon::today()->subDays(30);
//query where resized=0
$newPhotos=propflyer::select('id','propagent_id')
->where('created_at','>',"$theDate")
->orWhere('creationDate','>',"$theDate")
//where it has photos that are resized=0
//otherwise exclude
->whereHas('thePhotos',function($q){
  $q->where('resized','=','0');
})
//with these fields
->with(['thePhotos'=>function($q){
  $q->select('propflyer_id','photoName','resized',
  'width','height','photoID','ord','def','orient')
  ->where('resized','=','0');
}])
->get();
//totalRecord from original
$totalRecords=$newPhotos->count();
//function called on from loop
include(app_path().'/functions/imageControl/mdbxImageOptimize.php');

//loop through results
foreach($newPhotos as $the){
  //if count has w1000 otherwise make them
  if(!$the->thePhotos->first()){
    dd('error-line25-localPhotos_w1000');}

  //get zip/mls dirs
  $zipDir=$the->theMeta->zipDir;
  $mlsDir=$the->theMeta->mlsDir;
  $idFly=$the->id;
  $umid=$the->propagent_id;
  $localImage="none";
  $fileExists=0;
  $ratioUpdate=0;
  $photoCount=$the->thePhotos->count();
  //if(!$originalPhotos->first()){
  //  dd('check resize values');}
  $loopCount=0;
  //resize loop
  foreach($the->thePhotos as $t){
    $remoteURL="http://www.realtyemails.com/HQPhotos/$zipDir/$mlsDir/$t->photoName";
    $localImage="none";
    $width=$t->width;
    //if original is larger than 1000
    if($t->width > 1000){
      //ok to resize
      include('includes/photoResize/resizeTo1000process.php');
    }else{
      //update as resized=2 to mark as done but failed
      propphoto::where('photoID','=',"$t->photoID")
      ->update([
        'resized'=>2,
      ]);
      oldPhoto::where('photoID','=',"$t->photoID")
      ->update([
        'resized'=>2,
      ]);
    }
    $loopCount++;
    //return JSON & exit
    $idArray = array(
      'totalRecords'    => $totalRecords,
      'thisTotalPhotos' => $photoCount,
      'thisPhotoCount'  => $loopCount,
      'remoteURL'       => $remoteURL,
      'localImage'      => $localImage,
      'fileExists'      => $fileExists,
      'ratioUpdate'     => $ratioUpdate,
      'width'           => $width,
    );
    echo json_encode($idArray);
    exit();
  }//end of for each
  $totalRecords=$totalRecords-1;
}

