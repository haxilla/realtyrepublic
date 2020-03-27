<?php 
$img=imagecreatefromjpeg($fullOriginalPath); // Load and instantiate the image
if($img) {
  $cropped=imagecropauto($img,IMG_CROP_THRESHOLD, 1, 16777215); // Auto-crop the image

  imagedestroy($img); // Clean up as $img is no longer needed
  imagejpeg($cropped,$fullPath);

}else{
	dd("ERROR");	
}