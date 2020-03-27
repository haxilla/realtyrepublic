<?php
use App\models\core\propmapping;

//propMetas
$zipDir=$propMetas['zipDir'];
$mlsDir=$propMetas['mlsDir'];
$officeID=$agentInfo['officeID'];

//agentInfo
$officeID=$agentInfo['officeID'];
$agentPhoto=$agentInfo['agtPhoto'];
$agentLogo=$agentInfo['agtLogo'];

//theHeadline
$theHeadline=$propInfo['xHeadline'];
if(!$theHeadline){
   $theHeadline=$propInfo['xxHeadline'];
}

//propStyles
$graphic_words       = $propStyles['graphic_words'];
$graphic_textcolor   = $propStyles['graphic_textcolor'];
$graphic_style       = $propStyles['graphic_style'];
$flyer_background    = $propStyles['flyer_background'];
$hlGraphic           = $graphic_words.'_'.$graphic_textcolor.'_'.$graphic_style.'x.png';
$theTemplate         = $propStyles['template'];

if(!$theTemplate){$theTemplate='none';}

if($flyer_background=== '996600' or $flyer_background == '990000'
or $flyer_background == '999999' or $flyer_background == '000066'
or $flyer_background == '000000' or $flyer_background == '333333'){
   $showLight=1;
}else{
   $showLight=0;
}

//propPhotos

//use clone to have reusable queries
$defPhoto      = clone $propPhotos;
$defPhoto500   = clone $propPhotos;
$allPhotos     = clone $propPhotos;
$resize500     = clone $propPhotos;
//$totalPhotos   = $propPhotos->count();

//apply conditions to clones for refined results
$allPhotos     = $allPhotos->get();
$resize500     = $resize500->where('resized','=','500')->get();
$totalPhotos   = $resize500->count();

$defPhoto      = $defPhoto->where('def','=','1')->get();
$defPhoto500   = $defPhoto500->where('def','=','1')
                             ->where('resized','=','500')->get();

if($defPhoto500->first()){
   $defPhotoName  = $defPhoto500->first()->photoName;
}else{
   $defPhotoName = 'none';}

//propmapping
$xIntersection=propmapping::where('propflyer_id','=',"$idFly")
->pluck('xIntersection')
->first();
