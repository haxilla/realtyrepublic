<?php

$thisStartDate=$getAgent['startDate'];
//earliestAccount
if($thisStartDate && $thisStartDate>$latestStartDate){
   $latestAccount=$thisDup;
   $latestStartDate=$thisStartDate;}
