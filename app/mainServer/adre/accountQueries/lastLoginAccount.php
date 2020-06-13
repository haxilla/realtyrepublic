<?php
$thisLastLogin=$getAgent['lastLogin'];
//set lastLoginAccount
if($thisLastLogin>$lastLoginDate){
   $lastLoginAccount=$thisDup;
   $lastLoginDate=$thisLastLogin;}
