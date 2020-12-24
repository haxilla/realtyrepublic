<?php

if($the){
   $emailSaves=trim($the);}

$pieces = explode("@",$emailSaves);
//label name & host
$emailName  = trim($pieces[0]); // piece1
$emailHost  = trim($pieces[1]); // piece2
//check host respose
$file = 'http://www.'.$emailHost;
//check header
$file_headers = @get_headers($file);
if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
   //not valid
   $emailTest['Invalid'][]=$emailSaves;
}else{
   $validEmail=1;
   $emailTest['Valid'][]=$emailSaves;
}
