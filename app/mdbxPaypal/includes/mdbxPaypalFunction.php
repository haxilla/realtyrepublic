<?php

//account possibilities
if($currentAccount=='2'||$currentAccount=='3'){
    //existing Unlmited account
    include(app_path().'/functions/mdbxPaypal/accountSetups/mdbxAccount3.php');
}elseif($currentAccount=='5'){
    //existing Credit account
    include(app_path().'/functions/mdbxPaypal/accountSetups/mdbxAccount5.php');
}else{
    //admin error if its not account 1,2,3 or 5
    $data=[
    'errorMessage'=>
    'error with Account Type - check line 33 mdbxPaypalFunction',];

    $theSubject='Error with Account Type';
    include('paypalAdminError.php');}
