<?php

//old & current synchs for comparison
$oldHomes=$mlsName.'homes_backup';
$nowHomes=$mlsName.'homes';
//price
$priceCompare='homePrice_'.$retsSystem
$priceCompareFile=$priceCompare.'.php';
//status
$statusCompare='homeStatus_'.$retsSystem;
$statusCompareFile=$statusCompare.'.php';
//new
$newCompare='homeNew_'.$retsSystem;
$newCompareFile=$newCompare.'.php';
//removed
$removeCompare='homeRemoved_'.$retsSystem;
$removeCompareFile=$removeCompare.'.php';

//include Loops
include("$priceCompareFile");
include("$statusCompareFile");
include("$newCompareFile");
include("$removeCompareFile");


