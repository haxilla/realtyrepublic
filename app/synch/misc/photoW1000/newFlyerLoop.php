<?php

//    ***    YOU ARE IN A LOOP      ***   //
//    ***   CurrentRecord is $the   ***   //

//if no records error
if(!$the->thePhotos){
   dd('error-line29-localPhotos_w1000');}

// set variables
$idFly=$the->id;
$zipDir=$the->theMeta->zipDir;
$mlsDir=$the->theMeta->mlsDir;
$umid=$the->propagent_id;
$thisTotalPhotos=$the->thePhotos->count();
$thisPhotoCount=0;
