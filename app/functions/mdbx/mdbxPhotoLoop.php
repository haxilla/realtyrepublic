<?php
//style s2pb
//name each photo separate to place accurately
//get all photos
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

//setupPhoto Loop
$photoLoop=clone $propPhotos;
$photoLoop=$photoLoop->take(10)->get();

//serves to generate photo# and associated fields
//names photo{count}name & photo{count}orient
foreach($photoLoop as $ph){
  $theLoop++;
  ${"photo".$theLoop."name"}=$ph->photoName;
  ${"photo".$theLoop."orient"}=$ph->orient;
  ${"photo".$theLoop."id"}=$ph->photoID;
}


