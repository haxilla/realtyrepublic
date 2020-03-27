<?php

$submitID='incomplete';
$formID='incomplete';
$getMLS=0;
$getListPrice=0;
$getAddress=0;
$getDetails=0;
$getRemarks=0;
$getHighlights=0;

if(!$propMetas->addressConfirmed){
   $getAddress=1;
   $submitID='getAddress';
}elseif(!$propMetas->mlsConfirmed){
   $getMLS=1;
   $submitID='getMLS';
}elseif(!$propMetas->listPriceConfirmed){
   $getListPrice=1;
   $submitID='getPrice';
}elseif(!$propMetas->remarksConfirmed){
   $getRemarks=1;
   $submitID='getRemarks';
}elseif(!$propMetas->highlightsConfirmed){
   $getHighlights=1;
   $submitID='getHighlights';
   $formID='updateNewRecord';
}
