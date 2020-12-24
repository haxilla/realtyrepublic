<?php

$thisStartDate=$getAgent['startDate'];
//earliestAccount
if($thisStartDate && $thisStartDate<$earliestStartDate){
   $earliestAccount=$thisDup;
   $earliestStartDate=$thisStartDate;}
