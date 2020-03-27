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

$propInfo=qcreate::where('id','=',"$id")
->first();

$defPhotoName=propphoto::where('propflyer_id','=',"$id")
  ->pluck('photoName')
  ->first();

//if its NOT in qcreate get info from main tables
if(!$propInfo){

  $propInfo=propflyer::where('id','=',"$id")
    ->first();

  $zipDir=propmeta::where('propflyer_id','=',"$id")
    ->pluck('zipDir')
    ->first();

  $mlsDir=propmeta::where('propflyer_id','=',"$id")
    ->pluck('mlsDir')
    ->first();

  $sk1=propmeta::where('propflyer_id','=',"$id")
    ->pluck('sk1')
    ->first();

  $propRemarks=propremark::where('propflyer_id','=',"$id")
    ->first();

  $xIntersection=propmapping::where('propflyer_id','=',"$id")
    ->pluck('xIntersection')
    ->first();

  $xPubRemarks=$propRemarks['xPubRemarks'];
  $xb1=$propRemarks['xb1'];
  $xb2=$propRemarks['xb2'];
  $xb3=$propRemarks['xb3'];
  $xb4=$propRemarks['xb4'];
  $xb5=$propRemarks['xb5'];
  $xb6=$propRemarks['xb6'];
  $xb7=$propRemarks['xb7'];
  $xb8=$propRemarks['xb8'];

}else{

  $zipDir         = $propInfo['zipDir'];
  $mlsDir         = $propInfo['mlsDir'];
  $xPubRemarks    = $propInfo['xPubRemarks'];
  $xIntersection  = $propInfo['xIntersection'];
  $xb1            = propInfo['xb1'];
  $xb2            = propInfo['xb2'];
  $xb3            = propInfo['xb3'];
  $xb4            = propInfo['xb4'];
  $xb5            = propInfo['xb5'];
  $xb6            = propInfo['xb6'];
  $xb7            = propInfo['xb7'];
  $xb8            = propInfo['xb8'];
  $sk1            = propInfo['sk1'];

}

if(!$propInfo || !$zipDir || !$mlsDir || !$defPhotoName){
  dd('Sorry, we have an issue - app/flyerquery-line18');
}

$idFly         = $id;
$idMem         = $propInfo['propagent_id'];
$xMlsNum       = $propInfo['xMlsNum'];

if($propInfo->xHeadline){
  $xHeadline = $propInfo['xHeadline'];
}else{
  $xHeadline = $propInfo['xxHeadline'];
}

if($propInfo->xBeds){
  $xBeds=$propInfo['xBeds'];
}else{
  $xBeds=$propInfo['xxBeds'];
}

if($propInfo->xBaths){
  $xBaths=$propInfo->xBaths;
}else{
  $xBaths=$propInfo->xxBaths;
}

if($propInfo->xSqft){
  $xSqft=$propInfo->xSqft;
}else{
  $xSqft=$propInfo->xxSqft;
}

if($propInfo->xYrBuilt){
  $xYrBuilt=$propInfo->xYrBuilt;
}else{
  $xYrBuilt=$propInfo->xxYrBuilt;
}

if($propInfo->xPoolPvt){
  $xPoolPvt=$propInfo->xPoolPvt;
}else{
  $xPoolPvt=$propInfo->xxPoolPvt;
}

if($propInfo->xBaths){
  $xParking=$propInfo->xParking;
}else{
  $xParking=$propInfo->xxParking;
}

if($propInfo->xBaths){
  $xZip=$propInfo->xZip;
}else{
  $xZip=$propInfo->xxZip;
}

//default count
$defaultPhoto=propphoto::select('photoName','ord','orient')
->where('propflyer_id','=',"$idFly")
->where('resized','=','500')
->where('def','=','1');

//separate first record
$defPhotoName=$defaultPhoto->first();
$defPhotoName=$defPhotoName['photoName'];

//all others
$countOtherPhotos=propphoto::select('photoName','orient','def')
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
   ->orderBy('ord')
   ->take(8)
   ->get();

//photo counts
$defCount=$defaultPhoto->count();
$allCount=$countOtherPhotos->count();
$totalPhotos=$defCount+$allCount;

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

$getStyle=propstyle::where('propflyer_id','=',"$idFly")->first();

//get agent
$agentInfo=propagent::where('id','=',"$idMem")->first();
$agentPhoto=$agentInfo['agtPhoto'];
$agentLogo=$agentInfo['agtLogo'];
$agentDesigs=$agentInfo['agtDesigs'];
$officeID=$agentInfo['officeID'];
$agentName=$agentInfo['agtFullName'];
$agtMainPhone=$agentInfo['agtMainPhone'];

//getOffice
$officeInfo=agtoffice::where('propagent_id','=',"$idMem")->first();
$officeName=$officeInfo['officeName'];
$officeAddress=$officeInfo['officeAddress'];
$officeCity=$officeInfo['officeCity'];
$officeState=$officeInfo['officeState'];
$officeZip=$officeInfo['officeZip'];

//set variables
$xTemplate           = $getStyle['template'];
$flyer_background    = $getStyle['flyer_background'];
$headline_text       = $getStyle['headline_text'];
$roundedtop          = $getStyle['roundedtop'];
$graphic_words       = $getStyle['graphic_words'];
$graphic_textcolor   = $getStyle['graphic_textcolor'];
$graphic_style       = $getStyle['graphic_style'];
$template            = $getStyle['template'];
$headline_bar_bg     = $getStyle['headline_bar_bg'];
$headline_bar_text   = $getStyle['headline_bar_text'];
$accentbars          = $getStyle['accentbars'];
$hlGraphic           = $graphic_words.'_'.$graphic_textcolor.'_'.$graphic_style.'.png';

//style s2pb
//name each photo separate to place accurately
$photo1=propphoto::select('orient','photoName')
   ->where('propflyer_id','=',"$idFly")
   ->where('resized','=','500')
   ->where('ord','=','1')
   ->first();
$photo1name    = $photo1['photoName'];
$photo1orient  = $photo1['orient'];

$photo2=propphoto::select('orient','photoName')
   ->where('propflyer_id','=',"$idFly")
   ->where('resized','=','500')
   ->where('ord','=','2')
   ->first();
$photo2name    = $photo2['photoName'];
$photo2orient  = $photo2['orient'];

$photo3=propphoto::select('orient','photoName')
   ->where('propflyer_id','=',"$idFly")
   ->where('resized','=','500')
   ->where('ord','=','3')
   ->first();
$photo3name    = $photo3['photoName'];
$photo3orient  = $photo3['orient'];

$photo4=propphoto::select('orient','photoName')
   ->where('propflyer_id','=',"$idFly")
   ->where('resized','=','500')
   ->where('ord','=','4')
   ->first();
$photo4name    = $photo4['photoName'];
$photo4orient  = $photo4['orient'];

$photo5=propphoto::select('orient','photoName')
   ->where('propflyer_id','=',"$idFly")
   ->where('resized','=','500')
   ->where('ord','=','5')
   ->first();
$photo5name    = $photo5['photoName'];
$photo5orient  = $photo5['orient'];

$photo6=propphoto::select('orient','photoName')
   ->where('propflyer_id','=',"$idFly")
   ->where('resized','=','500')
   ->where('ord','=','6')
   ->first();
$photo6name    = $photo6['photoName'];
$photo6orient  = $photo6['orient'];

$photo7=propphoto::select('orient','photoName')
   ->where('propflyer_id','=',"$idFly")
   ->where('resized','=','500')
   ->where('ord','=','7')
   ->first();
$photo7name    = $photo7['photoName'];
$photo7orient  = $photo7['orient'];

$photo8=propphoto::select('orient','photoName')
   ->where('propflyer_id','=',"$idFly")
   ->where('resized','=','500')
   ->where('ord','=','8')
   ->first();
$photo8name    = $photo8['photoName'];
$photo8orient  = $photo8['orient'];

$photo9=propphoto::select('orient','photoName')
   ->where('propflyer_id','=',"$idFly")
   ->where('resized','=','500')
   ->where('ord','=','9')
   ->first();
$photo9name    = $photo9['photoName'];
$photo9orient  = $photo9['orient'];

$photo10=propphoto::select('orient','photoName')
   ->where('propflyer_id','=',"$idFly")
   ->where('resized','=','500')
   ->where('ord','=','10')
   ->first();
$photo10name    = $photo10['photoName'];
$photo10orient  = $photo10['orient'];

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



