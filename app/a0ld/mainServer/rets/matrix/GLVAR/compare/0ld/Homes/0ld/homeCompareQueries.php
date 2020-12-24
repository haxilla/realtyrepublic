<?php

$retsClass='homes';
$nowHomes=$mlsName.$retsClass;
$oldHomes=$nowHomes."_backup";

// ** Queries
//price
include("mysql/homePriceQuery.php");

//status
include("mysql/homeStatusQuery.php");

//new
include("mysql/homeNewQuery.php");

//removed
include("mysql/homeRemovedQuery.php");
