<?php

$retsClass='homes';
$nowHomes=$mlsName.$retsClass;
$oldHomes=$nowHomes."_backup";

// ** Queries
//price
include(app_path()
."/rets/$retsSystem/$mlsName/mysql/homes/priceCompare.php");

//status
include(app_path()
."/rets/$retsSystem/$mlsName/mysql/homes/statusCompare.php");

//new listing
include(app_path()
."/rets/$retsSystem/$mlsName/mysql/homes/newListing.php");

//removed
include(app_path()
."/rets/$retsSystem/$mlsName/mysql/homes/removedListing.php");


