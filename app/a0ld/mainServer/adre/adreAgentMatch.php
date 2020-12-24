<?php
//starterVariables
include('starterVariables.php');
include('accountQueries/mainAccountIDVariables.php');
//run loop
foreach($dupCheck as $thisDup){
   //run through checked choices & gather
   include('dupLoop.php');}
//  ***  END OF LOOP   ***  //
//  ***  OUTSIDE LOOP  ***  //

// determine & mark mainAccountID, etc.
include('remchecks/setMainIds.php');
// Handle errors
if (array_key_exists('error', $remailEventLog)){
   include('errorHandle/agtAccountError.php');}
// creates separation between main / merge accounts

include('mergeDupLoop.php');
// emailTesting
include(app_path().'/adre/remchecks/emailTesting.php');
// checkDistro
include(app_path().'/adre/remchecks/distroCheck.php');
// check EmployerLicNumber
include('remchecks/checkEmployerLicNumber.php');

//past all errors
if($sqlOK){
   include('functions/deleteSuccessProcess.php');}
// log related office members
include('queries/officePeerQuery.php');

// create view
$html=View::make('mdbxAdmin.adre.partials.theReport')
->with([
   'remailEventLog'     => $remailEventLog,
   'LicNumber'          => $LicNumber,
   'multipleAccounts'   => $multipleAccounts,
   'mainOfficeQuery'    => $mainOfficeQuery,
   'propAgentMetaQuery' => $propAgentMetaQuery,
   'remDistroCheck'     => $remDistroCheck,
])->render();
// setup array
$idArray=array(
   'html'         => $html,
   'nextRecord'   => $nextRecord,
   'sqlOK'        => $sqlOK,);
// echo json
echo json_encode($idArray);

// create jsonLogFile
include('functions/create_JsonLogFile.php');

