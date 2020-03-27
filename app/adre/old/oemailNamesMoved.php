<?php
//emailNotes
include('emailNotes.php');

//build emailNamesMoved List
$emailNamesMoved=null;
dd($emailNotes);
foreach($emailNotes as $the){
   //emailNote1
   if($the['emailNote']){
      $theEmailNote1=$the['emailNote'];
      if($emailNamesMoved != null){
         if(!stripos($emailNamesMoved,$theEmailNote1)!==false){
            $emailNamesMoved=$emailNamesMoved.', '.$theEmailNote1;}
      }else{
         if(!stripos($emailNamesMoved,$theEmailNote1)!==false){
            $emailNamesMoved=$the['emailNote'];}}}

   //emailNote2
   if($the['emailNote2']){
      $theEmailNote2=$the['emailNote'];
      if($emailNamesMoved != null){
         if(!stripos($emailNamesMoved,$theEmailNote2)!==false){
            $emailNamesMoved=$emailNamesMoved.', '.$theEmailNote2;}
      }else{
         if(!stripos($emailNamesMoved,$theEmailNote2)!==false){
            $emailNamesMoved=$the['emailNote'];}}}
   //emailNote3
   if($the['emailNote3']){
      $theEmailNote3=$the['emailNote'];
      if($emailNamesMoved != null){
         if(!stripos($emailNamesMoved,$theEmailNote3)!==false){
            $emailNamesMoved=$emailNamesMoved.', '.$theEmailNote3;}
      }else{
         if(!stripos($emailNamesMoved,$theEmailNote3)!==false){
            $emailNamesMoved=$the['emailNote'];}}}}
            //END FOREACH(emailSaves) loop

//notate any emailNames Moved if found;
if($emailNamesMoved){
      $remailEventLog[]=['emailNamesMoved'=>$emailNamesMoved,];}
