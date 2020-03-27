<?php

Use App\models\core\tempflyer;

$check=tempflyer::where('mdbxid','=',"$mdbxid")
->first();

if(!$check){
   dd('error-line9-appPath/members/newFlyer/checkMdbxid.php');}

tempflyer::where('mdbxid','=',"$mdbxid")
->update([
   'tempMlsNum'   => $xMlsNum,
]);

$tempInfo=$check;
