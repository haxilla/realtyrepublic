<?php

//this file needs more memory
ini_set('memory_limit', '256M');

//regex 
$string = file_get_contents($extractFilePath, TRUE);
//$pattern = '/(?<=\w)""/';
$pattern = '/(?<=[\w.])""/';
$replacement = '\\""';
$result1=preg_replace($pattern, $replacement, $string);
$pattern2='( ")';
$replacement2=' \\"';
$result2=preg_replace($pattern2,$replacement2,$result1);

//resaves file to final location
file_put_contents($finalFilePath,$result2);