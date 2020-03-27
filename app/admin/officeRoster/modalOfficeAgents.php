<?php
use App\models\core\agtoffice;
use App\models\core\propoffice;

$officeID=request('officeID');
//error if none
if(!$officeID){
   dd('error-line5-modalOfficeAgents.php');}

//query
include(app_path().'/queries/modalOfficeMatchQuery.php');
//query - *contains thisRecord variable*
include(app_path().'/queries/mainOfficeIdQuery.php');
//officeID view
$modalOfficeHeader=View::make('mdbxAdmin.partials.modalOfficeHeader')
   ->with(compact('thisRecord'))->render();
//officeID match view
$officeMatchResults=View::make('mdbxAdmin.partials.modalOfficeMatchResultLoop')
   ->with(compact('modalOfficeMatchQuery'))->render();
//output
echo $modalOfficeHeader;
echo $officeMatchResults;
