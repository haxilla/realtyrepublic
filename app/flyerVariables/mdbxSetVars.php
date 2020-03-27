<?php
//theHeadline
$theHeadline=$propInfo['xHeadline'];
if(!$theHeadline){
   $theHeadline=$propInfo['xxHeadline'];}

//propStyles
if($propInfo->theStyle){
   $graphic_words       = $propInfo->theStyle->graphic_words;
   $graphic_textcolor   = $propInfo->theStyle->graphic_textcolor;
   $graphic_style       = $propInfo->theStyle->graphic_style;
   $flyer_background    = $propInfo->theStyle->flyer_background;
   $hlGraphic           = $graphic_words.'_'.$graphic_textcolor.'_'.$graphic_style.'x.png';
   $theTemplate         = $propInfo->theStyle->template;
}else{
   $flyer_background=null;
   $graphic_words=null;
   $graphic_textcolor=null;
   $graphic_style=null;
   $hlGraphic=null;}

//dont leave as null
if(!isset($theTemplate)){
   $theTemplate='none';}
//showLight
if($flyer_background=== '996600' or $flyer_background == '990000'
or $flyer_background == '999999' or $flyer_background == '000066'
or $flyer_background == '000000' or $flyer_background == '333333'){
   $showLight=1;
}else{
   $showLight=0;}
//for mdbxFromURL file
$zipDir        = $propInfo->theMeta->zipDir;
$mlsDir        = $propInfo->theMeta->mlsDir;

if($propInfo->thePhotos
->where('def','=','1')->count() > 0){
$defPhotoName  = $propInfo->thePhotos
   ->where('def','=','1')
   ->where('resized','=','500')
   ->first()->photoName;}

$officeID    = $propInfo->theAgent->officeID;
$agtPhoto    = $propInfo->theAgent->agtPhoto;
$agtLogo     = $propInfo->theAgent->agtLogo;
//for flyers
$totalPhotos = $propInfo->thePhotos
   ->where('resized','=','500')
   ->count();


