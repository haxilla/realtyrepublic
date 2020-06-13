<?php
$sqlOK=0;
foreach($thisAccount as $the){
   $thisFlyerCount=0;
   $thisID=0;
   //set variables
   $thisID=$the['propagent_id'];
   $thisFlyerCount=$the['flyerCount'];
   //echo "$thisID".' - '."$thisFlyerCount".'<br>';
   //set if mainAccountID
   if($thisID==$mainAccountID){
      $theMain=1;
   }else{
      $theMain=0;}

   //if it has flyers
   if($thisFlyerCount>0){
      //Has Flyers / Check Main
      if(!$theMain){
         //echo $thisFlyerCount." FLYERS NEED TO MOVE FROM ".$thisID.'<BR>';
         $message="**Move** "
         .$thisFlyerCount." FLYERS FROM "
         .$thisID." INTO ACCOUNT# "
         .$mainAccountID;
         //add to Array
         $flyerMoveNotes[]=$message;
         if($sqlOK=1){/*enter sql here*/}
      }else{
         //echo $flyerMoveCount." FLYERS NEED TO MOVE INTO ".$thisID.'<BR>';
         $message="**Main** NEED "
         .$flyerMoveCount." FLYERS MOVED INTO ACCOUNT# ".$thisID;
         //add to Array
         $flyerMoveNotes[]=$message;
         if($sqlOK=1){/*enter sql here*/}}

   //NO Flyers
   }else{
      //echo "NO FLYERS IN ACCOUNT ".$thisID.'<BR>';
      $message="NO FLYERS IN ACCOUNT# ".$thisID;
      $flyerMoveNotes[]=$message;}}

$remailEventLog['accountsMoved']['flyerMoveNotes']=$flyerMoveNotes;
