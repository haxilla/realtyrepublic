<?php

//defaults set below - override if necessary
$fromURL1    = 'http://www.rosemary.test';
$fromURL2   = 'http://www.rosemary.test';
$fromURL3   = 'http://www.rosemary.test';

//flyer photos
if(isset($zipDir) && isset($mlsDir) && isset($defPhotoName)){

  $src1  = 'http://www.realtyemails.com/hqphotos/'.$zipDir.'/'.$mlsDir.'/'.$defPhotoName;
  $src2 = 'http://www.realtyrepublic.com/hqphotos/'.$zipDir.'/'.$mlsDir.'/'.$defPhotoName;
  //$src3 = 'http://rosemary.test/'.$zipDir.'/'.$mlsDir.'/'.$defPhotoName;

  if (@getimagesize($src1)) {
    $fromURL1='http://www.RealtyEmails.com';
  }elseif(@getimagesize($src2)){
    $fromURL1='http://www.RealtyRepublic.com';
  }else{
    $fromURL1='http://rosemary.test';}}

//agentphoto
if(isset($officeID) && isset($agtPhoto)){

   $src3 = 'http://www.realtyemails.com/hqoffice/'. $officeID .'/'.$agtPhoto;
   $src4 = 'http://www.realtyrepublic.com/hqoffice/'. $officeID .'/'.$agtPhoto;

   if (@getimagesize($src3)) {
     $fromURL2='http://www.RealtyEmails.com';
   }elseif(@getimagesize($src4)){
     $fromURL2='http://www.RealtyRepublic.com';
   }else{
     $fromURL2='http://www.rosemary.test';
   }}

//agent logo
if(isset($officeID) && isset($agtLogo)){

   $src5 = 'http://www.realtyemails.com/hqoffice/'. $officeID .'/'.'logos'.'/'.$agtLogo;
   $src6 = 'http://www.realtyrepublic.com/hqoffice/'. $officeID .'/'.'logos'.'/'.$agtLogo;

   if (@getimagesize($src5)) {
     $fromURL3='http://www.RealtyEmails.com';
   }elseif(@getimagesize($src6)){
     $fromURL3='http://www.RealtyRepublic.com';
   }else{
     $fromURL3='http://www.rosemary.test';
   }}


