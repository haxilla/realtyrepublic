<?php
//handle errors here
//start array
$emailNotes=[];
//run loop on emails to add to emailSaves Variable
foreach($remailEventLog['error'] as $the){
   //error type1=agtEmail
   if($the['agtEmail']){
      $theAgtEmail=$the['agtEmail'];
      if(stripos($emailSaves,$theAgtEmail)===false){
         $emailSaves=trim($emailSaves.' || '.$theAgtEmail);}}

   //error type2=xxAgtUname
   if($the['xxAgtUname']){
      $theXxAgtUname=$the['xxAgtUname'];
      if(stripos($emailSaves,$theXxAgtUname)===false){
         $emailSaves=trim($emailSaves.' || '.$theXxAgtUname);}}
}
// **
// **  END OF FOREACH LOOP
// **
// ************************

