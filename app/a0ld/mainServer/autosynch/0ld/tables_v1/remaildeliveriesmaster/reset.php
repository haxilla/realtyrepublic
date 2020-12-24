<?php

dd('going to run remaildeliveriesmaster');

//******************//
// REMOTE SYNCH 	//
// BEFORE PULL 		//
//*****************************************
// RealtyEmails has new completed records
// archived into remaildeliveries2019
// or remaildeliveries(currentYear)
// merge latest into master before pulling
// *****************************************
$results = DB::connection('oldsite')
->select( DB::raw("
    INSERT IGNORE INTO maindata.remaildeliveriesmaster
    SELECT *
    FROM maindata.remaildeliveries2019
"));

//drops & recreates 
//remailsynch.remaildeliveriesmaster_federated
include('includes/federated_1create.php');

//insert
include('includes/federated_2insert.php');

//drop & recreate propdelivs
include('includes/recreate_propdeliv.php');


