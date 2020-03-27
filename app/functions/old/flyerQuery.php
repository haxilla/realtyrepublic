<?php

use App\qcreate;
use App\propphoto;
use App\propstyle;
use App\propagent;
use App\agtoffice;
use App\propflyer;
use App\propmeta;
use App\propremark;
use App\propmapping;

$propInfo=propflyer::where('id','=',"$id")
->first();

$zipDir=propmeta::where('propflyer_id','=',"$id")
->pluck('zipDir')
->first();

$mlsDir=propmeta::where('propflyer_id','=',"$id")
->pluck('mlsDir')
->first();

if(!$propInfo || !$zipDir || !$mlsDir){
  dd('Sorry, we have an issue - app/functions/flyerquery-line25');
}

$sk1=propmeta::where('propflyer_id','=',"$id")
->pluck('sk1')
->first();

$propRemarks=propremark::where('propflyer_id','=',"$id")
->first();

$xIntersection=propmapping::where('propflyer_id','=',"$id")
->pluck('xIntersection')
->first();

//set variables
$xb1          = $propRemarks['xb1'];
$xb2          = $propRemarks['xb2'];
$xb3          = $propRemarks['xb3'];
$xb4          = $propRemarks['xb4'];
$xb5          = $propRemarks['xb5'];
$xb6          = $propRemarks['xb6'];
$xb7          = $propRemarks['xb7'];
$xb8          = $propRemarks['xb8'];
$xPubRemarks  = $propRemarks['xPubRemarks'];
$idFly        = $id;
$idMem        = $propInfo['propagent_id'];
$xMlsNum      = $propInfo['xMlsNum'];

//merge site fields code
include(app_path() . '/functions/mergeSiteFields.php');
include(app_path() . '/functions/countBullets.php');

//default count
$defaultPhoto=propphoto::select('photoName','ord','orient','photoID')
->where('propflyer_id','=',"$idFly")
->where('resized','=','500')
->where('def','=','1');

//separate first record
$defPhotoName=$defaultPhoto->first();
$defPhotoName=$defPhotoName['photoName'];
$defPhotoID=$defaultPhoto->first()->photoID;

//all others
$countOtherPhotos=propphoto::select(
  'photoName',
  'ord',
  'orient',
  'def',
  'photoID')
->where('propflyer_id','=',"$idFly")
->where('resized','=','500')
->orderBy('ord');

// style s1pc - limit 6 non-def for style s1pc
$allPhotos=$countOtherPhotos
->take(8)
->get();

//style s3pt
$photos8=propphoto::where('propflyer_id','=',"$idFly")
->where('resized','=','500')
->orderBy('def','desc')
->orderBy('ord')
->take(8)
->get();

//photo counts
$defCount=$defaultPhoto->count();
$allCount=$countOtherPhotos->count();
$totalPhotos=$allCount;

//string length
$totalString=strlen($xPubRemarks);
//count capitals
$capitals=strlen(preg_replace('![^A-Z]+!', '', $xPubRemarks));

//get percentage avoid division by zero
if($totalString > 0){

   // total percentage
   $capitalPerc=($capitals/$totalString)*100;

   // round to 2 digits
   $capitalPerc=round($capitalPerc,2);
}

$getStyle=propstyle::where('propflyer_id','=',"$idFly")
->first();

//dd($getStyle);

//get agent
$agentInfo=propagent::where('id','=',"$idMem")->first();
$agentPhoto=$agentInfo['agtPhoto'];
$agentLogo=$agentInfo['agtLogo'];
$agentDesigs=$agentInfo['agtDesigs'];
$officeID=$agentInfo['officeID'];
$agentName=$agentInfo['agtFullName'];
$agtMainPhone=$agentInfo['agtMainPhone'];
$agtEmail=$agentInfo['agtEmail'];

//getOffice
$officeInfo=agtoffice::where('propagent_id','=',"$idMem")->first();
$officeName=$officeInfo['officeName'];
$officeAddress=$officeInfo['officeAddress'];
$officeCity=$officeInfo['officeCity'];
$officeState=$officeInfo['officeState'];
$officeZip=$officeInfo['officeZip'];

//set variables
$xTemplate           = $getStyle['template'];
$templateChosen      = $getStyle['template_chosen'];
$colorsChosen        = $getStyle['colors_chosen'];
$headlineChosen      = $getStyle['headline_chosen'];
$flyer_background    = $getStyle['flyer_background'];
$headline_text       = $getStyle['headline_text'];
$roundedtop          = $getStyle['roundedtop'];
$graphic_words       = $getStyle['graphic_words'];
$graphic_textcolor   = $getStyle['graphic_textcolor'];
$graphic_style       = $getStyle['graphic_style'];
$theTemplate         = $getStyle['template'];
$headline_bar_bg     = $getStyle['headline_bar_bg'];
$headline_bar_text   = $getStyle['headline_bar_text'];
$accentbars          = $getStyle['accentbars'];
$hlGraphic           = $graphic_words.'_'.$graphic_textcolor.'_'.$graphic_style.'x.png';

//style s2pb
//name each photo separate to place accurately
//get all photos
$photoLoop=propphoto::select('orient','photoName','photoID')
   ->where('propflyer_id','=',"$idFly")
   ->where('resized','=','500')
   ->orderBy('def','desc')
   ->orderBy('ord')
   ->get();

//initialize loop counter
$theLoop=0;

//set defaults and override with real values
//to avoid issue with unnamed variables
$photo1name=null;
$photo2name=null;
$photo3name=null;
$photo4name=null;
$photo5name=null;
$photo6name=null;
$photo7name=null;
$photo8name=null;
$photo9name=null;
$photo10name=null;
$photo1orient=null;
$photo2orient=null;
$photo3orient=null;
$photo4orient=null;
$photo5orient=null;
$photo6orient=null;
$photo7orient=null;
$photo8orient=null;
$photo9orient=null;
$photo10orient=null;
$photo1id=null;
$photo2id=null;
$photo3id=null;
$photo4id=null;
$photo5id=null;
$photo6id=null;
$photo7id=null;
$photo8id=null;
$photo9id=null;
$photo10id=null;

//names photo{count}name & photo{count}orient
foreach($photoLoop->take(10) as $ph){
  $theLoop++;
  ${"photo".$theLoop."name"}=$ph->photoName;
  ${"photo".$theLoop."orient"}=$ph->orient;
  ${"photo".$theLoop."id"}=$ph->photoID;
}

//set defaults here - overridden later if found elsewhere
$fromURL='http://www.rosemary.test';
$fromURL2='http://www.rosemary.test';
$fromURL3='http://www.rosemary.test';

//override fromURL code below
//flyer photos
if(isset($zipDir) && isset($mlsDir) && isset($defPhotoName)){

   $src1  = 'http://www.realtyemails.com/hqphotos/'.$zipDir.'/'.$mlsDir.'/'.$defPhotoName;
   $src2 = 'http://www.realtyrepublic.com/hqphotos/'.$zipDir.'/'.$mlsDir.'/'.$defPhotoName;

   if (@getimagesize($src1)) {
     $fromURL='http://www.RealtyEmails.com';
   }elseif(@getimagesize($src2)){
     $fromURL='http://www.RealtyRepublic.com';
   }else{
     $fromURL='http://www.rosemary.test';
   }
}

//agentphoto
if(isset($officeID) && isset($agentPhoto)){

   $src3 = 'http://www.realtyemails.com/hqoffice/'. $officeID .'/'.$agentPhoto;
   $src4 = 'http://www.realtyrepublic.com/hqoffice/'. $officeID .'/'.$agentPhoto;

   if (@getimagesize($src3)) {
     $fromURL2='http://www.RealtyEmails.com';
   }elseif(@getimagesize($src4)){
     $fromURL2='http://www.RealtyRepublic.com';
   }else{
     $fromURL2='http://www.rosemary.test';
   }

}

//agent logo
if(isset($officeID) && isset($agentLogo)){

   $src5 = 'http://www.realtyemails.com/hqoffice/'. $officeID .'/'.'logos'.'/'.$agentLogo;
   $src6 = 'http://www.realtyrepublic.com/hqoffice/'. $officeID .'/'.'logos'.'/'.$agentLogo;

   if (@getimagesize($src5)) {
     $fromURL3='http://www.RealtyEmails.com';
   }elseif(@getimagesize($src6)){
     $fromURL3='http://www.RealtyRepublic.com';
   }else{
     $fromURL3='http://www.rosemary.test';
   }

}



