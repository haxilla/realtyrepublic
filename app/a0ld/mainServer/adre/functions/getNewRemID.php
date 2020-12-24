<?php
//  *******************************
//  **  YOU ARE IN A LOOP
//  **  Current Record is $thisDup
//  *******************************
Use App\models\core\propagentcleanup;

$getNewRemID=propagentcleanup::where('propagent_id','=',"$thisDup")
->select('propagent_id','newRemID')
->first();

if(!$getNewRemID){
   dd('error-line13-getNewRemID.php');}

$newRemID=$getNewRemID['newRemID'];
