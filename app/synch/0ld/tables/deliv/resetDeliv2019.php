<?php
//backup prep / table checks
include('includes/backupPrep.php');

//drop & recreate federated
include('includes/createFederated.php');

// FIRST Backup of existing data
// ---------------
// drop & recreate main table
// remaildeliveries2019
include('includes/firstBackup.php');

// ** BEGIN INSERT
include('includes/insertFederated.php')

// Final backup
include('includes/finalBackup.php');

//********************************//
// combine new import             //
// with archive local & remote    //
//********************************//

//LOCAL
$results = DB::select( DB::raw("
    INSERT IGNORE INTO remuserdb.propdelivs
    SELECT *
    FROM remarchives.remaildeliveries2019
"));

//REMOTE
$results = DB::connection('oldsite')
->select( DB::raw("
    INSERT IGNORE INTO maindata.remaildeliveriesmaster
    SELECT *
    FROM maindata.remaildeliveries2019
"));

//output json & exit
$idArray = array(
  'status'      => 'success',
  'next'        => 'resetDelivNow',
  'message1'    => 'propdelivs Reset!',
  'message2'    => 'Now resetting propdelivnow...'
);
echo json_encode($idArray);
exit();
