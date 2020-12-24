<?php
//WORKING FILE BUT CREATES STRING
//GOOD EXAMPLE BUT CHANGED TO ARRAY

//start accountIdNote
$accountIdNote=0;
$accountIdsMoved=null;
//run loop
foreach($dupCheck as $thisDup){
   if($thisDup != $mainAccountID){
      //first entry
      if($accountIdNote==0){
         $accountIdNote=1;
         $accountIdsMoved=$thisDup;
      }else{
      //next entry appends first
         $accountIdsMoved=$accountIdsMoved.', '.$thisDup;}}}
         //end foreach - for accountIdsMoved

if($accountIdsMoved){
   $remailEventLog[0]['accountIdsMoved']=$accountIdsMoved;}
