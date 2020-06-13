<?php

//thisDup remCreds
$thisRemCreds=$the['remCreds'];
//get mainAccount RemCreds
$mainAccountCreds=$mostFlyersAccountQuery['remCreds'];
if(!$mainAccountCreds){
   $mainAccountCreds=0;}
//set new
$newRemCreds=$thisRemCreds+$mainAccountCreds;
//sql update
//include(app_path().'/adre/sql/moveRemCredSQL.php')''
//set mergerNote
$mergerNotes[0]['creditActiveNote'] = "Found "
.$thisRemCreds." Credit(s) in Account # "
.$thisDup."! Main Account had "
.$mainAccountCreds.' But now it has '
.$newRemCreds." Credit deleted from Account# "
.$thisDup." And added to ".$mainAccountID;
