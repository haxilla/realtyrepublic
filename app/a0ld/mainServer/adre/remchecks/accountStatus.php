<?php
//saveStatus
   $saveStatusLog[$thisID]['status']['neverActive']      = $neverActive;
   $saveStatusLog[$thisID]['status']['wasActive']        = $wasActive;
   $saveStatusLog[$thisID]['status']['isDormant']        = $isDormant;
   $saveStatusLog[$thisID]['status']['isActive']         = $isActive;
   $saveStatusLog[$thisID]['status']['hasCredits']       = $hasCredits;
   $saveStatusLog[$thisID]['status']['hasTime']          = $hasTime;
   //set thisAccountStatus
   $thisAccountStatus=null;
   if($neverActive){
      $thisAccountStatus='neverActive';
   }elseif($hasCredits){
      if(!$isDormant){
         $thisAccountStatus='ActiveCredits';
      }else{
         $thisAccountStatus='DormantCredits';}
   }elseif($hasTime){
      //hasCredits
      if(!$isDormant){
         $thisAccountStatus='ActiveUnlimited';
      }else{
         $thisAccountStatus='DormantUnlimited';}
   }elseif($wasActive){
      $thisAccountStatus='wasActive';
   }else{
      dd('error-line27-remchecks/accountStatus',
      $thisAccountStatus);}


