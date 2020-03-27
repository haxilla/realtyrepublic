<?php

//if not completed error
if($payment_status!=='Completed'){
      //if incorrect decryption handle custom error
    //set data
    $data=[
    'errorMessage'=>
    'Payment Not Complete',];
    // email subject
    $theSubject='Payment Status = '.$payment_status;
    // email the error 
    include('paypalAdminError.php');}