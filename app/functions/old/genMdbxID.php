<?php

$mdbxid  = uniqid()."$umid";
//generate random length
$trimL=rand(1,4);
$trimR=rand(11, 18);
$finalTrimL=rand(1,3);
$finalTrimR=rand(-1,-3);
//trim to length
$mdbxid2=$mdbxid;
$mdbxid3 = substr($mdbxid2, $trimL, $trimR);
$mdbxid4 = substr($mdbxid3,  $finalTrimL, $finalTrimR);
//reset
$mdbxid=$mdbxid4;
