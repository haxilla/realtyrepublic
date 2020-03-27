<?php

if($propInfo->xHeadline){
  $xHeadline = $propInfo['xHeadline'];
}else{
  $xHeadline = $propInfo['xxHeadline'];
}

if($propInfo->xBeds){
  $xBeds=$propInfo['xBeds'];
}else{
  $xBeds=$propInfo['xxBeds'];
}

if($propInfo->xBaths){
  $xBaths=$propInfo->xBaths;
}else{
  $xBaths=$propInfo->xxBaths;
}

if($propInfo->xSqft){
  $xSqft=$propInfo->xSqft;
}else{
  $xSqft=$propInfo->xxSqft;
}

if($propInfo->xYrBuilt){
  $xYrBuilt=$propInfo->xYrBuilt;
}else{
  $xYrBuilt=$propInfo->xxYrBuilt;
}

if($propInfo->xPoolPvt){
  $xPoolPvt=$propInfo->xPoolPvt;
}else{
  $xPoolPvt=$propInfo->xxPoolPvt;
}

if($propInfo->xBaths){
  $xParking=$propInfo->xParking;
}else{
  $xParking=$propInfo->xxParking;
}

if($propInfo->xBaths){
  $xZip=$propInfo->xZip;
}else{
  $xZip=$propInfo->xxZip;
}
