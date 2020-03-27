<?php

//set user id
$umid=Auth::guard('member')->user()->id;

//error if missing criteria
if(!$umid||empty($_FILES)||empty($_POST)){
	dd('error');}

$file = $_FILES['file']['tmp_name']; 
$sourceProperties = getimagesize($file);
$fileNewName = time();
$folderPath = "agentUploadTest/";
$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
$imageType = $sourceProperties[2];

//if directory doesnt exist create it
if (!is_dir("agentUploadTest")) {
  mkdir("agentUploadTest", 0777, true);}

//test for image type
switch ($imageType) {

   case IMAGETYPE_PNG:
       $imageResourceId = imagecreatefrompng($file); 
       $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
       imagepng($targetLayer,$folderPath. $fileNewName. "_thump.". $ext);
       break;


   case IMAGETYPE_GIF:
       $imageResourceId = imagecreatefromgif($file); 
       $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
       imagegif($targetLayer,$folderPath. $fileNewName. "_thump.". $ext);
       break;


   case IMAGETYPE_JPEG:
       $imageResourceId = imagecreatefromjpeg($file); 
       $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
       imagejpeg($targetLayer,$folderPath. $fileNewName. "_thump.". $ext);
       break;

   default:
       echo "Invalid Image type.";
       exit;
       break;
}


move_uploaded_file($file, $folderPath. $fileNewName. ".". $ext);
echo "Image Resize Successfully.";

function imageResize($imageResourceId,$width,$height) {
	//get ratio
   $ratio=$width/$height;
   $ratio=round($ratio,4);
   //get orient
   if($width > $height){
      $orient='wide';
      $targetWidth  	= 200;
      $targetHeight 	= $targetWidth/$ratio;
      $targetHeight	= round($targetHeight);
   }else{
      $orient='tall';
      $targetHeight 	= 200;
      $targetWidth	= $targetHeight * ratio;
      $targetWidth 	= round($targetWidth);} 

   //target layer
	$targetLayer=imagecreatetruecolor($targetWidth,$targetHeight);
	
	/*
	imagecopyresampled() copies a rectangular portion of one image to another image, smoothly interpolating pixel values so that, in particular, reducing the size of an image still retains a great deal of clarity.

	In other words, imagecopyresampled() will take a rectangular area from src_image of width src_w and height src_h at position (src_x,src_y) and place it in a rectangular area of dst_image of width dst_w and height dst_h at position (dst_x,dst_y).
	*/

    imagecopyresampled($targetLayer,$imageResourceId,0,0,0,0,$targetWidth,$targetHeight, $width,$height);
    return $targetLayer;
}