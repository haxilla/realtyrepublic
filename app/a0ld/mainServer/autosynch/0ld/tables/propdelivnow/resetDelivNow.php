<?php

// check & prepare backup tables
include('includes/backupPrep.php');

// perform first backup
include('includes/firstBackup.php');

// recreate federated table
include('includes/federated_recreate.php');

// insert federated into main
include('includes/federated_insert.php');

// final backup
include('includes/finalBackup.php');

// insert into archives 
// if it is finished
$results=DB::select( DB::raw("
   insert IGNORE into propdeliv
   select * from propdelivnow
   where emComplete is not null;
"));
// delete from propdelivnow 
// if its finished
$results=DB::select( DB::raw("
   delete from propdelivnow
   where emComplete is not null;
"));

//output json & exit
$idArray = array(
    'status'       => 'success',
    'next'         => 'reset_orders',
    'message1'     => 'propdelivnow reset',
    'message2'     => 'Now resetting orders...'
);

echo json_encode($idArray);
exit();
