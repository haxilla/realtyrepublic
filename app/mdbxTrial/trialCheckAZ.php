<?php

use App\models\distro\azphxmetro;
use App\models\distro\azphxne;
use App\models\distro\azphxse;
use App\models\distro\azphxwv;
use App\models\distro\aznaz;
use App\models\distro\azsaz;

if(!isset($eidx)){
   $eidx="xnonex";}

//azphxmetro
if($listName=='none'){
   $theList=azphxmetro::where('agtEmail','=',"$theEmail")
   ->orWhere('eidx','=',"$eidx")
   ->first();
   if($theList){
      $listName='azphxmetro';
   }
}
//azphxne
if($listName=='none'){
   $theList=azphxne::where('agtEmail','=',"$theEmail")
   ->orWhere('eidx','=',"$eidx")
   ->first();
   if($theList){
      $listName='azphxne';
   }
}
//azphxse
if($listName=='none'){
   $theList=azphxse::where('agtEmail','=',"$theEmail")
   ->orWhere('eidx','=',"$eidx")
   ->first();
   if($theList){
      $listName='azphxse';
   }
}
//azphxwv
if($listName=='none'){
   $theList=azphxwv::where('agtEmail','=',"$theEmail")
   ->orWhere('eidx','=',"$eidx")
   ->first();
   if($theList){
      $listName='azphxwv';
   }
}
//aznaz
if($listName=='none'){
   $theList=aznaz::where('agtEmail','=',"$theEmail")
   ->orWhere('eidx','=',"$eidx")
   ->first();
   if($theList){
      $listName='aznaz';
   }
}
//azsaz
if($listName=='none'){
   $theList=azsaz::where('agtEmail','=',"$theEmail")
   ->orWhere('eidx','=',"$eidx")
   ->first();
   if($theList){
      $listName='azsaz';
   }
}
