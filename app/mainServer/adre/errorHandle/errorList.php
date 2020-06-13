<?php
//has remcreds
if($getAgent['remCreds'] && $multipleAccounts==1){
   $remCreds=$getAgent['remCreds'];
   $dupLoop['error'][$thisID]=['hasRemCreds'=>$remCreds,];}
//has startdate
if($getAgent['startDate'] && $multipleAccounts==1){
   $startDate=$getAgent['startDate'];
   $dupLoop['error'][$thisID]=['startDate'=>$startDate,];}
//active unlimited account
if($getAgent['expireDate'] > $now
&& $thisAccountType != 5){
   $expireDate=$getAgent['expireDate'];
   $dupLoop['error'][$thisID]=['expireDate'=>$expireDate,];}
//had username
if($getAgent['xxAgtUname'] || $getAgent['agtEmail']
&& $multipleAccounts==1){
   $dupLoop['error'][$thisID]['agtEmail']=$thisAgtEmail;
   $dupLoop['error'][$thisID]['xxAgtUname']=$thisXxAgtUname;}
//has logged in
if($getAgent['lastLogin']){
   $dupLoop['error'][$thisID]['lastLogin']=$thisLastLogin;}
//has flyers
if($thisFlyerCount && $multipleAccounts==1){
   $hasFlyers=1;
   $moveFlyers=1;
   $dupLoop['error'][$thisID]['hasFlyers']=$thisFlyerCount;
}elseif($thisFlyerCount){
   $hasFlyers=1;}
