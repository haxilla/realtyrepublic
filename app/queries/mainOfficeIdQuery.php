<?php

use App\models\core\propoffice;
//get officeID
$officeID=request('officeID');
//error if none
if(!$officeID){
   dd('error-line8-mainOfficeIdQuery');}

$mainOfficeIdQuery=propoffice::where('officeID','=',"$officeID")
->select('tempOfficeID','propagent_id','officeName','officeID',
  'officeAddress1','officeCity','officeState','officeZip',
  'officeFlag','confirmDelete')
->get();
//renamed to suit a partial layout
$thisRecord=$mainOfficeIdQuery;
