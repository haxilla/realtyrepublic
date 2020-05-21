<?php
namespace App\Http\Controllers\mdbxAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//models
use App\models\core\agtoffice;
use App\models\core\propoffice;
use App\models\admin\agentNote;
use App\models\admin\officeNote;

class officeRosterFunctionController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function agentClear(){
      //get umid
      $umid=request('umid');
      //check
      $check=agtoffice::where('propagent_id','=',"$umid");
      //error if none
      if(!$umid){
         dd('error-line25-officeRosterFunctionController');}

      //update
      agtoffice::where('propagent_id','=',"$umid")
      ->update([
         'agentClear'=>\Carbon\Carbon::now(),
      ]);
      //go back
      return back();
   }

   public function agentUnclear(){
      //get umid
      $umid=request('umid');
      //check
      $check=agtoffice::where('propagent_id','=',"$umid");
      //error if none
      if(!$umid){
         dd('error-line43-officeRosterFunctionController');}

      //update
      agtoffice::where('propagent_id','=',"$umid")
      ->update([
         'agentClear'=>null
      ]);
      //go back
      return back();
   }

   public function agentFlag(){
      //get umid
      $umid=request('umid');
      $formType=request('formType');
      //check
      $check=agtoffice::where('propagent_id','=',"$umid");
      //error if none
      if(!$umid){
         dd('error-line62-officeRosterFunctionController');}

      //update
      agtoffice::where('propagent_id','=',"$umid")
      ->update([
         'agentFlag'=>1,
      ]);
      //go back
      //return back();
      //output json
      $idArray = array(
        'status'     => 'success',
        'umid'       => $umid,
        'formType'   => $formType,
      );
      echo json_encode($idArray);
   }

   public function agentUnFlag(){
      //get umid
      $umid       = request('umid');
      $formType   = request('formType');
      //check
      $check=agtoffice::where('propagent_id','=',"$umid");
      //error if none
      if(!$umid){
         dd('error-line21-officeRosterFunctionController');}

      //update
      agtoffice::where('propagent_id','=',"$umid")
      ->update([
         'agentFlag' => 0,
      ]);
      //go back
      //return back();
      //output json
      $idArray = array(
        'status'     => 'success',
        'umid'       => $umid,
        'formType'   => $formType,
      );
      echo json_encode($idArray);
      exit();
   }

   public function agentConfirmDelete(){
      //get umid
      $umid                = request('umid');
      $agentDeleteReason   = request('agentDeleteReason');
      //used to refresh modals if value is "modal"
      $formType      = request('formType');
      //check
      $check=agtoffice::where('propagent_id','=',"$umid")
      ->first();
      //error if none
      if(!$umid||!$check||!$agentDeleteReason){
         dd('error-line21-officeRosterFunctionController');}

      if($agentDeleteReason=='unDelete'){
         //if unDelete set 0/null & exit
         agtoffice::where('propagent_id','=',"$umid")
         ->update([
            'agentConfirmDelete'=>0,
            'agentDeleteReason'=>null,
         ]);
         //output json
         $idArray = array(
            'status'    => 'undelete',
            'umid'      => $umid,
            'formType'  => $formType,
         );
         //output & exit
         echo json_encode($idArray);
         exit();
      }
      //update
      agtoffice::where('propagent_id','=',"$umid")
      ->update([
         'agentConfirmDelete'=>1,
         'agentDeleteReason'=>$deleteReason,
      ]);
      //go back
      //return back();
      //output json
      $idArray = array(
         'status'    => 'delete',
         'umid'      => $umid,
         'formType'  => $formType,
      );
      echo json_encode($idArray);
   }

   public function agentUndelete(){
      //get umid
      $umid=request('umid');
      $formType=request('formType');
      //check
      $check=agtoffice::where('propagent_id','=',"$umid");
      //error if none
      if(!$umid){
         dd('error-line21-officeRosterFunctionController');}

      //update
      agtoffice::where('propagent_id','=',"$umid")
      ->update([
         'agentConfirmDelete'=>0,
      ]);
      //go back
      //return back();
      //output json
      $idArray = array(
        'status'     => 'undelete',
        'umid'       => $umid,
        'formType'   => $formType,
      );
      echo json_encode($idArray);
   }

   //office add note
   public function officeAddNote(){
      //setup values
      $officeID=request('officeID');
      $theNote=request('theNote');
      //if value insert
      if($theNote){
         //insert
         officeNote::create([
            'officeID'     => $officeID,
            'theNote'      => $theNote,
         ]);}

      //format json
      $idArray = array(
         "status"    => 'success',
         "officeID"  => $officeID,
         "theNote"   => $theNote
      );
      //echo and exit
      echo json_encode($idArray);
      exit();
   }
   //officeShowNote
   public function officeShowNote(){
      $officeID=request('officeID');
      if(!$officeID){
         dd('error-line205-officeRosterFunctionController');}

      $showOfficeNote=officeNote::where('officeID','=',"$officeID")
      ->get();

      foreach($showOfficeNote->sortByDesc('created_at') as $the){
         ?>
         <div>
            <div class="inlineTop">
               <span class="badge" style="background-color:rgba(0,0,0,.5)">
                  <?php echo $the->created_at->diffForHumans(); ?>
               </span>
            </div>
            <div class="inlineTop">
               <?php echo $the->theNote; ?>
            </div>
         </div>
         <?php
      }

   }

   //agent add note
   public function agentAddNote(){
      //setup values
      $umid=request('umid');
      $LicNumber=request('LicNumber');
      $theNote=request('theNote');
      //insert
      agentNote::create([
         'propagent_id' => $umid,
         'LicNumber'    => $LicNumber,
         'theNote'      => $theNote
      ]);
      //format json
      $idArray = array(
         "status"     => 'success',
         "umid"       => $umid,
         "LicNumber"  => $LicNumber,
         "theNote"    => $theNote
      );
      //echo and exit
      echo json_encode($idArray);
      exit();
   }

   //OFFICE FUNCTIONS
      public function officeClear(){
         //get umid
         $officeID=request('officeID');
         $formType=request('formType');
         //check
         $check=propoffice::where('officeID','=',"$officeID");
         //error if none
         if(!$check){
            dd('error-line21-officeRosterFunctionController');}

         //update
         propoffice::where('officeID','=',"$officeID")
         ->update([
            'officeClear'=>\Carbon\Carbon::now(),
         ]);
         //update
         agtoffice::where('tempofficeID','=',"$officeID")
         ->update([
            'officeClear'=>\Carbon\Carbon::now(),
         ]);
         //format json
         $idArray = array(
            "status"    => 'success',
            "formType"  => $formType,
         );
         //echo and exit
         echo json_encode($idArray);
         return back();
         exit();
      }

      public function officeUnclear(){
         //get umid
         $officeID=request('officeID');
         $formType=request('formType');
         //check
         $check=propoffice::where('officeID','=',"$officeID");
         //error if none
         if(!$officeID){
            dd('error-line21-officeRosterFunctionController');}
         //update
         propoffice::where('officeID','=',"$officeID")
         ->update([
            'officeClear'=>null,
         ]);
         agtoffice::where('tempOfficeID','=',"$officeID")
         ->update([
            'officeClear'=>null,
         ]);
         //format json
         $idArray = array(
            "status"    => 'success',
            "formType"  => $formType,
         );
         //echo and exit
         echo json_encode($idArray);
         return back();
         exit();
      }

      public function officeFlag(){
         //get umid
         $officeID=request('officeID');
         $formType=request('formType');
         //check
         $check=propoffice::where('officeID','=',"$officeID");
         //error if none
         if(!$check){
            dd('error-line226-officeRosterFunctionController');}
         //update
         propoffice::where('officeID','=',"$officeID")
         ->update([
            'officeFlag'=>1,
         ]);
         agtoffice::where('tempOfficeID','=',"$officeID")
         ->update([
            'officeFlag'=>1,
         ]);
         //check clickCount
         $clickCount=request('clickCount');
         if($clickCount){
            $clickCount++;
         }else{
            $clickCount=0;}
         //format json
         $idArray = array(
            "status"       => 'success',
            "formType"     => $formType,
            "clickCount"   => $clickCount,
         );
         //echo and exit
         echo json_encode($idArray);
         exit();
      }

      public function officeUnFlag(){
         //get umid
         $officeID=request('officeID');
         $formType=request('formType');
         //check
         $check=propoffice::where('officeID','=',"$officeID");
         //error if none
         if(!$check){
            dd('error-line244-officeRosterFunctionController');}
         //update
         propoffice::where('officeID','=',"$officeID")
         ->update([
            'officeFlag'=>0,
         ]);
         agtoffice::where('tempOfficeID','=',"$officeID")
         ->update([
            'officeFlag'=>0,
         ]);
         //format json
         $idArray = array(
            "status"    => 'success',
            "formType"  => $formType,
         );
         //echo and exit
         echo json_encode($idArray);
         exit();
      }

      public function officeConfirmDelete(){
         //get umid
         $officeID      = request('officeID');
         $deleteReason  = request('deleteReason');
         //used to refresh modals if value is "modal"
         $formType      = request('formType');
         //check
         $check=propoffice::where('officeID','=',"$officeID")
         ->first();
         //error if none
         if(!$officeID||!$check||!$deleteReason){
            dd('error-line21-officeRosterFunctionController');}

         if($officeDeleteReason=='undelete'){
            //if unDelete set 0/null & exit
            propoffice::where('officeID','=',"$officeID")
            ->update([
               'confirmDelete'=>0,
               'deleteReason'=>null,
            ]);
            agtoffice::where('tempOfficeID','=',"$officeID")
            ->update([
               'officeConfirmDelete'=>0,
               'officeDeleteReason'=>null,
            ]);
            //output json
            $idArray = array(
               'status'    => 'undelete',
               'officeID'  => $officeID,
               'formType'  => $formType,
            );
            //output & exit
            echo json_encode($idArray);
            exit();
         }
         //update
         propoffice::where('officeID','=',"$officeID")
         ->update([
            'confirmDelete'=>1,
            'deleteReason'=>$deleteReason,
         ]);
         agtoffice::where('tempOfficeID','=',"$officeID")
         ->update([
            'officeConfirmDelete'=>1,
            'officeDeleteReason'=>$deleteReason,
         ]);
         //go back
         //return back();
         //output json
         $idArray = array(
            'status'    => 'delete',
            'officeID'  => $officeID,
            'formType'  => $formType,
         );
         echo json_encode($idArray);
      }

      public function officeFlagAll(){
         //called from main officeRosterDisplay
         include(app_path().'/admin/officeRoster/officeFlagAll.php');
         return back();
      }

      public function OLDofficeDelete(){
         // if deleted - wipe tempOfficeID from any agent
         // inside that office & flag
         include(app_path().'/admin/officeRoster/officeConfirmDelete.php');
         return back();
      }
}
