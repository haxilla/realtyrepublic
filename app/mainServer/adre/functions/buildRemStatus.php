<?php
$remStatus=null;
foreach($remailEventLog['allAccounts']['mainAccount'][$mainAccountID]['status'] as $the=>$value){
   if($value=='1'){
      if(!$remStatus){
         $remStatus=$the;
      }else{
         $remStatus=$remStatus.' || '.$the;}}}
