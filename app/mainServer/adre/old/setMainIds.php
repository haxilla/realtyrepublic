<?php
//model
use App\models\core\agtoffice;
//office
$mainOfficeQuery=agtoffice::where('propagent_id','=',"$mainAccountID")
->select('newRemID','tempOfficeID')
->first();
//setup newRemID
if(!$newRemID){
   //create new remailAgentID
   include(app_path().'/functions/keyGens/ezshortUID.php');
   $newRemID=$ezShortUID;}
//error if none
if(!$mainRemailAgentID){
   dd('error-line39-adreDeleteAgent');}
