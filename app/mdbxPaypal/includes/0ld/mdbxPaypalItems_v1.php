<?php
//leave here as default value
//can be changed below
$thisPurchase=5;

if($item_number=='5101'||$item_number=='5101T'||$item_number=='5101x'){
    $addCredit=1;
    $addTime=0;
    $desc='1 Credit';
}elseif($item_number=='5103'||$item_number=='5103T'||$item_number=='5103x'){
    $addCredit=3;
    $addTime=0;
    $desc='3 Credits';
}elseif($item_number=='5105'||$item_number=='5105T'||$item_number=='5105x'){
    $addCredit=5;
    $addTime=0;
    $desc='5 Credits';
}elseif($item_number=='5110'||$item_number=='5110T'||$item_number=='5110x'){
    $addCredit=10;
    $addTime=0;
    $desc='10 Credits';
}elseif($item_number=='5115'||$item_number=='5115T'||$item_number=='5115x'){
    $addCredit=15;
    $addTime=0;
    $desc='15 Credits';
}elseif($item_number=='99rn'||$item_number=='99rn-T'||$item_number=='99rnx'){
    $addCredit=0;
    $addTime=180;
    $thisPurchase=3;
    $desc="6 months Unlimited Email Account";
}else{

    //send error message to admin
    $data=[
      'errorMessage'=>'error with item_num -
      check lines 183 of mdbxIPNsimple',
    ];

    $theSubject='Error with Item Number';
    include('paypalAdminError.php');

}
