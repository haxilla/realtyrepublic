<?php

//   ***   YOU ARE IN A LOOP   ***   //
//   *** Current Value is $t   ***   //

//set vars
$width   = $t->width;
$height  = $t->height;
$orient  = $t->orient;
$ratio   = $t->ratio;
//error
if(!$width||!$height||!$orient){
   dd('error-line12-photoLoopVariables',$width,$height,$orient);}

//set ratio
if($ratio==0){
   $ratio=$width/$height;
   $ratio=round($ratio,4);}

//zipDir -- mlsDir
if(!$zipDir||!$mlsDir){
   dd('error-line22-photoLoopVariables',$zipDir,$mlsDir,$t->photoName,$t->propagent_id,$t->propflyer_id);}




