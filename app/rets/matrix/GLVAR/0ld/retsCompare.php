<?php

//returns homePrice,homeStatus,homeNew,homeRemoved
include("homes/homeCompareQueries.php");

//start Log and get new LogID
include("functions/startLog.php");

// **  HOMES  ** //
//insert price change records
include("homes/homePriceLoop.php");

//insert status change records
include("homes/homeStatusLoop.php");

//insert new listings
include("homes/homeNewLoop.php");

//insert removed listings
include("homes/homeRemovedLoop.php");


//   ** AGENTS **  //

//   ** OFFICES ** //

dd($homePrice,$homeStatus,$homeNew,$homeRemoved);