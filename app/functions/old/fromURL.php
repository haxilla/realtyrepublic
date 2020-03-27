<?php

//defaults set below - override if necessary
$fromURL    = 'http://www.rosemary.test';
$fromURL2   = 'http://www.rosemary.test';
$fromURL3   = 'http://www.rosemary.test';

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


