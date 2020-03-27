<?php

//   ***   YOU ARE IN A LOOP      ***   //
//   ***  CurrentVariable is $t   ***   //

//variables
$remoteURL="http://www.realtyemails.com/HQPhotos/$zipDir/$mlsDir/$t->photoName";
$localURL="https://www.realtyrepublic.com/hqphotos/$zipDir/$mlsDir/$t->photoName";
$localPath="hqphotos/$zipDir/$mlsDir/$t->photoName";
//if found mark
if(file_exists($localPath)){
$localFound=1;}

if(!$localFound){
   //check remote
   $contents=@file_get_contents($remoteURL);
   if($contents===FALSE && $localFound==0){
     $notFound=1;
   }else{
      //set remoteFound
      $remoteFound=1;
      //if directory doesnt exist create it
      if(!is_dir("hqphotos/$zipDir/$mlsDir")){
         mkdir("hqphotos/$zipDir/$mlsDir", 0777, true);}

      //get image
      file_put_contents($localPath, file_get_contents($remoteURL));
      $localFound=1;}}
