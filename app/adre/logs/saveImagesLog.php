<?php
//images array
//agtPhoto
$saveImagesLog[$thisID]['images']['agent']['hasPhoto']=$hasAgtPhoto;
$saveImagesLog[$thisID]['images']['agent']['agtPhoto']=$thisAgtPhoto;
$saveImagesLog[$thisID]['images']['agent']['agtPhotoDownload']=$agtPhotoDownload;
$saveImagesLog[$thisID]['images']['agent']['localAgtPhotoFound']=$localAgtPhotoFound;
$saveImagesLog[$thisID]['images']['agent']['remoteAgtPhotoFound']=$remoteAgtPhotoFound;
$saveImagesLog[$thisID]['images']['agent']['path']="/agentPhotos/$newRemID";
$saveImagesLog[$thisID]['images']['agent']['agtPhotoCheck']=$agtPhotoCheck;
//agtLogo
$saveImagesLog[$thisID]['images']['office']['hasLogo']=$hasAgtLogo;
$saveImagesLog[$thisID]['images']['office']['agtLogo']=$thisAgtLogo;
$saveImagesLog[$thisID]['images']['office']['agtLogoDownload']=$agtLogoDownload;
$saveImagesLog[$thisID]['images']['office']['localAgtLogoFound']=$localAgtLogoFound;
$saveImagesLog[$thisID]['images']['office']['remoteAgtLogoFound']=$remoteAgtLogoFound;
$saveImagesLog[$thisID]['images']['office']['path']="/officeLogos/$EmployerLicNumber";
$saveImagesLog[$thisID]['images']['office']['agtLogoCheck']=$agtLogoCheck;

//logic
if(!$hasAgtPhoto && !$hasAgtLogo
||($localAgtPhotoFound && $localAgtLogoFound)){
   $imagesOK=1;}
