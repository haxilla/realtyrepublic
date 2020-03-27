<?php
//leave here as default value
//can be changed below
$thisPurchase=5;
//set variables
if(strpos($item_number,'5101')!==false){
    $addCredit=1;
    $addTime=0;
    $desc='1 Credit';
}elseif(strpos($item_number,'5103')!==false){
    $addCredit=3;
    $addTime=0;
    $desc='3 Credits';
}elseif(strpos($item_number,'5105')!==false){
    $addCredit=5;
    $addTime=0;
    $desc='5 Credits';
}elseif(strpos($item_number,'5110')!==false){
    $addCredit=10;
    $addTime=0;
    $desc='10 Credits';
}elseif(strpos($item_number,'5115')!==false){
    $addCredit=15;
    $addTime=0;
    $desc='15 Credits';
}elseif(strpos($item_number,'5120')!==false){
    $addCredit=20;
    $addTime=0;
    $desc='20 Credits';
}elseif(strpos($item_number,'3099')!==false){
    $addCredit=0;
    $addTime=90;
    $expireDate=\Carbon\Carbon::now()->addMonths(3);
    $thisPurchase=3;
    $desc="3 months Unlimited Email Account";
}elseif(strpos($item_number,'3120')!==false){
    $addCredit=0;
    $addTime=180;
    $expireDate=\Carbon\Carbon::now()->addMonths(6);
    $thisPurchase=3;
    $desc="6 months Unlimited Email Account";
}else{
    //send error message to admin
    $data=[
      'errorMessage'=>'error with item_num -
      check lines 44 of mdbxPaypalItems',
    ];

    $theSubject='Error with Item Number';
    include('paypalAdminError.php');}
