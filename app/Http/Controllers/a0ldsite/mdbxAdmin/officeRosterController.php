<?php
namespace App\Http\Controllers\mdbxAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\models\core\propoffice;
use App\models\core\propagent;
use App\models\core\agtoffice;
use App\models\oldsite\oldAgent;

class officeRosterController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function index(){
      //cleanup -- can remove later
      //include(app_path().'/admin/officeRoster/cleanup/rosterCleanup.php');
      //include(app_path().'/admin/officeRoster/cleanup/synchAgtOffice.php');
      include(app_path().'/admin/officeRoster/cleanup/officeEntityFix.php');
      include(app_path().'/synch/set_remailAgentID.php');
      include(app_path().'/synch/set_tempOfficeID.php');
      //include(app_path().'/adre/loadDataInfile.php');
      //query
      $propoffice=propoffice::select('officeID','officeName',
         'officeAddress1','officeCity','officeState','officeZip',
         'officeFlag','officeClear','confirmDelete','armlsOfficeID')
      ->orderBy('officeAddress1','desc')
      ->with(['theAgtOffice'=>function($q){
         $q->select('xOfficeID','tempOfficeID','propagent_id');
      }])
      ->whereNotNull('officeClear')
      ->take(5)
      ->get();

      $thisRecord=$propoffice;

      //view
      return view('mdbxAdmin.fullPages.officeRoster',[
         'thisRecord'    => $thisRecord,
         'showPanel'     => 'officeRoster'
      ]);
   }

   public function modalOfficeAgents(){
      include(app_path().'/admin/officeRoster/modalOfficeAgents.php');
   }

   public function officeMatch(){
      //get officeID
      $officeID=request('officeID');
      $autoSearch=request('autoSearch');
      //error if none
      if(!$officeID){
         dd('error-line54-officeRosterController');}

      //count length
      if(!$autoSearch && strlen($officeID)<10){
         dd('please correct to 10 digit officeID first!');}

      // if it came from autosearch request
      // determine if agent or office
      $isAgentID=0;
      if($autoSearch){
         $check=propagent::where('id','=',"$officeID")
         ->first();
         if($check){
            $isAgentID=1;}}

      //redirect if agent
      if($isAgentID){
         return \Redirect::route("adminRoster.agentIdMatch",
            ['propagent_id' => $officeID,]);}

      //use officeID to search for match
      $first5=substr($officeID, 0,5);  //address
      $last5=substr($officeID, -5);    //address

      //has officeName & officeAddress1 query
      include(app_path().'/queries/officeMatchQueries.php');

      //Office Data
      $thisRecord=propoffice::select('officeID','officeName','officeAddress1',
         'officeCity','officeState','officeZip','armlsOfficeID','officeFlag',
         'officeClear')
      ->where('officeID','=',"$officeID")
      ->with(['theAgtOffice'=>function($q){
         $q->select('propagent_id','armlsOfficeID','tempOfficeID','officeID',
            'officeAddress1','agentClear','agentFlag','agentConfirmDelete',
            'officeConfirmDelete','remailAgentID','officeName')
            ->with(['theAgent'=>function($q2){
               $q2->select('id','agtFullName','remCreds','startDate',
               'expireDate','accountType','lastLogin','accountType','agtUname',
               'agtCity','agtState','agtZip','agtMainPhone','xxAgtUname')
               ->with(['theAgentNote'=>function($q3){
                  $q3->select('propagent_id','created_at','theNote');
               }]);
            }]);
      }])
      ->get();

      if(!$thisRecord->first()){
         dd('error-line87-officeRosterController');}

      //dd($thisRecord->first()->theAgtOffice->first()->theAgent->first()->id);

      //View
      return view('mdbxAdmin.fullPages.officeRoster',[
         'officeNameQuery'      => $officeNameQuery,
         'officeAddress1Query'  => $officeAddress1Query,
         'thisRecord'           => $thisRecord,
         'showPanel'            => 'officeMatch',
      ]);

   }

}
