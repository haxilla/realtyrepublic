<?php
//model
use App\models\core\propagentmeta;
//set vars
$dupCheck=request('dupCheck');
$now=\Carbon\Carbon::now();
$sqlOK=request('sqlOK');
$LicNumber=request('LicNumber');
$EmployerLicNumber=request('EmployerLicNumber');
$multiples=0;
$jsonPreview=0;

//prepare newRemID
$newRemID=propagentmeta::where('LicNumber','=',"$LicNumber")
->pluck('newRemID')
->first();
//set if none
if(!$newRemID){
   $jsonPreview=1;
   include(app_path().'/functions/keyGens/ezshortUID.php');
   $newRemID=$ezshortUID;}

//setup deleteLoop
$dupLoop=[];
//run loop
foreach($dupCheck as $thisDup){
   //run through checked choices & gather
   include('deleteIncludes/dupLoop.php');}

// ** END OF LOOP  *  *  * //
// ** OUTSIDE MAIN LOOP ** //

//determine & mark mainID / mainRemailAgentID
include('remchecks/setMainIds.php');
//creates a separation between main / merge accounts
include(app_path().'/adre/deleteIncludes/mergeDupLoop.php');

//Handle errors
if (array_key_exists('error', $remailEventLog)){
   include('errorHandle/agtAccountError.php');}

//past all errors
if($sqlOK){
   include('functions/deleteSuccessProcess.php');}

//send output to browser
$html=View::make('mdbxAdmin.adre.partials.deleteReport')
   ->with(compact('remailEventLog'))
   ->with(['LicNumber'=>$LicNumber])
   ->render();
echo $html;

//create jsonLogFile
include('functions/create_JsonLogFile.php');


//$remailEventLog=json_encode($remailEventLog);

