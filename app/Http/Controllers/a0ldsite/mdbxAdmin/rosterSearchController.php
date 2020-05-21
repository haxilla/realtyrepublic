<?php
namespace App\Http\Controllers\mdbxAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//models
use App\models\oldsite\oldAgent;
use App\models\core\propagent;
use App\models\core\propagentmeta;
use App\models\core\propflyer;
use App\models\core\propoffice;
use App\models\adre\adreAgent;
use App\models\adre\adreEntity;
use App\models\admin\agentNote;
use App\models\admin\officeNote;

class rosterSearchController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function rosterSearch(){
      //original formVal
      $formVal=trim(request('formVal'));
      //if a space inside variable
      //create first & last
      if(strpos($formVal," ") !== false){
         //separate by spaces
         $pieces = explode(" ", $formVal);
         //label first & last names
         $FirstName  = $pieces[0]; // piece1
         $LastName   = $pieces[1]; // piece2
         //5 char version
         $first6=substr($FirstName, 0,6); //address
         $last6=substr($LastName, 0,6); //address
         //set query
         $queries=adreAgent::select('FirstName','MiddleName','LastName',
         'LicNumber','LicStatus','EmployerDBAName','OriginalDate')
         ->where('FirstName','like','%'.$first6.'%')
         ->where('LastName','like','%'.$last6.'%')
         ->take(10)
         ->get();
         //make view
         $html=\View::make('mdbxAdmin.partials.autoCompleteLoop')
         ->with(compact('queries'))->render();
         //echo & exit
         echo $html;
         exit();

      }else{
      //no spaces in formVal
         $queries=adreAgent::select('FirstName','MiddleName','LastName',
         'LicNumber','LicStatus','EmployerDBAName')
         ->where('FirstName','like','%'.$formVal.'%')
         ->orWhere('LastName','like','%'.$formVal.'%')
         ->orWhere(\DB::raw('concat(FirstName," ",LastName)') , 'LIKE' , '%'.$formVal.'%')
         ->orderBy('LastName')
         ->take(10)
         ->get();

         $html=\View::make('mdbxAdmin.partials.autoCompleteLoop')
         ->with(compact('queries'))->render();

         echo $html;
         exit();
      }//end if
   }//end function

   public function adreAgentResult(){
      //get LicNumber
      $LicNumber=request('LicNumber');
      $propagent_id=request('propagent_id');

      //error if none
      if(!$LicNumber){
         dd('line76-rosterSearchController');}

      //run query
      $adreAgentResult=adreAgent::select('FirstName','MiddleName','LastName',
         'LicNumber','EmployerDBAName','EmployerLicNumber','MailingAddress1',
         'MailingCity','MailingState','MailingZip','MailingCounty','LicStatus',
         'LicType','originalDate','expireDate')
      ->where('LicNumber','=',"$LicNumber")
      ->first();

      //error if none
      if(!$adreAgentResult){
         dd('error-line91-rosterSearchController');}

      //find matching record
      $remReport=propagentmeta::where('LicNumber','=',"$LicNumber")
      ->select('propagent_id','newRemID','remStatus','newRemOfficeID')
      ->with(['theAgent'=>function($q){
         $q->select('id','startDate','expireDate','remCreds',
            'agtFullName','accountType','xxAgtUname','agtUname');
      }])
      ->first();
      //
      $propagentID=$remReport['propagent_id'];
      $EmployerLicNumber=$adreAgentResult['EmployerLicNumber'];
      $newRemOfficeID=$remReport['newRemOfficeID'];
      //
      $agentNotes=agentNote::where('propagent_id','=',"$propagentID")
      ->orWhere('LicNumber','=',"$LicNumber")
      ->get();
      //
      $officeNotes=officeNote::where('EmployerLicNumber','=',"$EmployerLicNumber")
      ->orWhere('newRemOfficeID','=',"$newRemOfficeID")
      ->get();
      //set vars
      $adreAgentFirst      =$adreAgentResult['FirstName'];
      $adreAgentLast       =$adreAgentResult['LastName'];
      $adreOfficeName      =$adreAgentResult['EmployerDBAName'];
      $adreOfficeAddress1  =$adreAgentResult['MailingAddress1'];
      //set adreAgentFirstClean
      include(app_path().'/functions/cleanup/adreAgentFirst.php');
      //set adreAgentLastClean
      include(app_path().'/functions/cleanup/adreAgentLast.php');
      //set adreOfficeNameClean
      include(app_path().'/functions/cleanup/adreOfficeName.php');
      //set adreOfficeAddress1Clean
      include(app_path().'/functions/cleanup/adreOfficeAddress1.php');
      //shortened
      $adreAgentFirst3=substr($adreAgentFirstClean, 0,3);
      $adreAgentLast3=substr($adreAgentLastClean, 0,3);
      $adreAgentFirst6=substr($adreAgentFirstClean, 0,6);
      $adreAgentLast6=substr($adreAgentLastClean, 0,6);
      $adreOfficeName3f=substr($adreOfficeNameClean, 0,3);
      $adreOfficeName3r=substr($adreOfficeNameClean, -3);
      $adreOfficeAddress3f=substr($adreOfficeAddress1Clean, 0,3); //first 3
      $adreOfficeAddress3r=substr($adreOfficeAddress1Clean, -3);  //last 3=
      //dd('line173rostersearchcontroller',$adreAgentFirst3,$adreAgentLast3);

      //run queries
      include(app_path().'/adre/queries/propagentQueries.php');
      include(app_path().'/adre/queries/agtOfficeQueries.php');

      //view
      return view('mdbxAdmin.fullPages.adreAgentResults',[
         'adreAgentResult'       => $adreAgentResult,
         'propagentLoop'         => $propagentLoop,
         'lastLoginAgentQuery'   => $lastLoginAgentQuery,
         'agentClearListQuery'   => $agentClearListQuery,
         'agentDeleteListQuery'  => $agentDeleteListQuery,
         'remReport'             => $remReport,
         'agentNotes'            => $agentNotes,
         'officeNotes'           => $officeNotes,
      ]);
   }

   public function theCheckmark(){
      //set vars
      $propagent_id        = request('propagentid');
      $LicNumber           = request('LicNumber');
      $LicStatus           = request('LicStatus');
      $sqlOK               = request('sqlOK');
      $useAgtMetas         = 0;
      //error if none
      if(!$propagent_id||!$LicNumber){
         dd('line171-rosterSearchController');}
      //query
      $adreAgentQuery=adreAgent::where('LicNumber','=',"$LicNumber")
      ->select('EmployerLicNumber','LicNumber','LicStatus')
      ->first();
      //set
      $EmployerLicNumber = $adreAgentQuery['EmployerLicNumber'];
      $LicStatus         = $adreAgentQuery['LicStatus'];
      //if agent is already in, use this instead of data-id fields
      //since they could be mixed up
      $propagentmeta=propagentmeta::where('propagent_id','=',"$propagent_id");
      //override default if value found
      if($propagentmeta->count()){
         //if using metas notate
         $useAgtMetas=1;
         //overwrite to new values
         $LicNumber=$propagentmeta->first()->LicNumber;
         $EmployerLicNumber=$propagentmeta->first()->EmployerLicNumber;
         //check current status
         $adreStatus=adreAgent::select('LicStatus')
         ->where('LicNumber','=',"$LicNumber");
         //overwrite to new value
         $LicStatus=$adreStatus->first()->LicStatus;}

      $propagent=propagent::where('id','=',"$propagent_id")
      ->select('agtFullName','id','accountType')
      ->first();

      //set array
      $adreAgent=[
         'LicNumber'          => $LicNumber,
         'EmployerLicNumber'  => $EmployerLicNumber,
         'LicStatus'          => $LicStatus,];
      //output display
      $html=\View::make('mdbxAdmin.adre.partials.theCheckmark')
      ->with([
         'propagent'    => $propagent,
         'adreAgent'    => $adreAgent,
         'useAgtMetas'  => $useAgtMetas,
      ])->render();

      echo $html;

   }

   public function theChoice(){
      include(app_path().'/adre/adreAgentMatch.php');
   }

   public function showJsonTree(){
      //id
      $id=request('id');
      if(!$id){
         dd('error-line199-rosterSearchController');}

      $file=file_get_contents(app_path()."/adre/notes/$id/jsonMergeLog-$id.txt");
      echo $file;
   }

   public function nextRecord(){
      //get NextRecord
      $nextRecord=request('nextRecord');
      //error if none
      if(!$nextRecord){
         dd('errorline240-rosterSearchController');}
      //query
      $nextPropAgent=propagent::where('id','=',"$nextRecord")
      ->select('id','agtFullName','agtFirst','agtLast')
      ->first();
      //error if none
      if(!$nextPropAgent){
         dd('error-line249-rosterSearchController');}

      //set vars
      $agtFullName=$nextPropAgent['agtFullName'];
      $remAgtFirst=$nextPropAgent['agtFirst'];
      $remAgtLast=$nextPropAgent['agtLast'];
      //fill in first/last if needed
      if(!$remAgtFirst||!$remAgtLast||!$agtFullName){

         if(!$agtFullName){
            dd('error-line259-rosterSearchController');
         }else{
            include(app_path().'/adre/functions/set_agtFirstLast.php');}

         if(!$agtFirstName||!$agtLastName){
            dd('line267-rosterSearchController');
         }else{
            $remAgtFirst=$agtFirstName;
            $remAgtLast=$agtLastName;}}

      //cleanup
      include(app_path().'/functions/cleanup/remAgtFirst.php');
      include(app_path().'/functions/cleanup/remAgtLast.php');
      // setup first3 & last3
      $agtFirst3=substr($remAgtFirstClean, 0,3);
      $agtLast3=substr($remAgtLastClean, 0,3);
      $agtLast6=substr($remAgtLastClean, 0,6);
      //adre record
      $adreAgentQuery=adreAgent::select('LicNumber','FirstName','LastName')
      ->where('FirstName','like','%'."$agtFirst3".'%')
      ->where('LastName','like','%'."$agtLast3".'%')
      ->first();
      //rework if no match
      if(!$adreAgentQuery){
         //re-query
         $adreAgentQuery=adreAgent::select('LicNumber','FirstName','LastName')
         ->where('LastName','like','%'."$remAgtLastClean".'%')
         ->first();}
      //rework if no match
      if(!$adreAgentQuery){
         //re-query
         $adreAgentQuery=adreAgent::select('LicNumber','FirstName','LastName')
         ->where('LastName','like','%'."$agtLast6".'%')
         ->first();}
      //error if none still
      if(!$adreAgentQuery){
         dd('error-line279-rosterSearchController');}

      //LicNumber
      $LicNumber=$adreAgentQuery['LicNumber'];
      //take first record found and show matches
      return \Redirect::route('adminRoster.adreAgentResult',[
         'LicNumber'    => $LicNumber,
         'propagent_id' => $nextRecord,]);
   }

   public function adreNoMatch(){
      //get LicNumber
      $LicNumber=request('LicNumber');
      //error if none
      if(!$LicNumber){
         dd('error-line287-rosterSearchController');}
      //mark as noMatch
      include(app_path().'/adre/sql/create/adreNoMatch.php');
      //return
      return back();
   }

}

//   **    "SELECT CONCAT(first_name, last_name) As name FROM people
//   **    WHERE (CONCAT(first_name, last_name) LIKE '%" . $term . "%')

/* outdated paths

   public function mergeChoice(){
      include(app_path().'/adre/adreMergeAgent.php');
   }
