<?php

use App\propstyle;
use App\qcreate;

$getStyle=propstyle::where('propflyer_id','=',"$id")
->first();

$template_chosen  = $getStyle['template_chosen'];
$headline_chosen  = $getStyle['headline_chosen'];
$colors_chosen    = $getStyle['colors_chosen'];
$delivery_chosen  = $getStyle['delivery_chosen'];
$xMlsNum          = qcreate::where('id','=',"$id")
                     ->pluck('xMlsNum')
                     ->first();
if(!$getStyle){
   $nextURL="preImport";
}elseif($template_chosen=='0'){
   $nextURL="flyerLanding";
}elseif($headline_chosen=='0'){
   $nextURL="chooseHeadline";
}elseif($colors_chosen=='0'){
   $nextURL="chooseColors";
}elseif($delivery_chosen=='0'){
   $nextURL="chooseDelivery";
}else{
   $nextURL="qEdit";
}

