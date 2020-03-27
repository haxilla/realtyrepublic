<?php

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $img_url); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
$img_data = curl_exec($ch);
curl_close($ch);

$img = @imagecreatefromjpeg($img_data);

if (!$img) {
    echo  "Invalid Image";
} else {
    echo  "Valid Image";
}