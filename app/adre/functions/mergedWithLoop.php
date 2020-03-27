<?php
//IF MERGE ACCOUNT EXISTS
$mergedWithSaves=null;
$mergeCheck=$remailEventLog['allAccounts'];
if(array_key_exists('mergeAccount', $mergeCheck)){
   // **  SET ARRAY TO MERGEACCOUNT
   $setMergeAccount=$remailEventLog['allAccounts']['mergeAccount'];
   //run loop
   foreach($setMergeAccount as $t){
      $thisID=$t['details']['metaIds']['propagent_id'];

      if($sqlOK==1){
         include(app_path().'/adre/sql/update/updateMergeSQL.php');}
      //track mergedWithSaves for display
      $mergedWith[$mainAccountID][$thisID]=$thisID;
      if(!$mergedWithSaves){
         $mergedWithSaves=$thisID;
      }else{
         $mergedWithSaves=$mergedWithSaves.','.$thisID;}}

   //log
   $remailEventLog['allAccounts']['mainAccount'][$mainAccountID]
   ['mergedWith']=$mergedWith[$mainAccountID];}
