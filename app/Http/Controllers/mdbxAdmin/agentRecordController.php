<?php
//namespace
namespace App\Http\Controllers\mdbxAdmin;
//controller
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//models
Use App\models\core\agtoffice;
Use App\models\core\propoffice;

class agentRecordController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function agentSingleRecord(){
      include(app_path().'/admin/officeRoster/agentSingleRecord.php');
   }

   public function agentFlagCounts(){
      include(app_path().'/admin/officeRoster/agentFlagCounts.php');
   }

   public function agentIdMatch(){
      //get umid
      $umid=request('propagent_id');
      //error if none
      if(!$umid){
         dd('error-line31-agentRecordController');}

      //get single record info
      include(app_path().'/queries/thisAgentIdRecord.php');
      //shows matches has 3 remailAgent queries
      include(app_path().'/queries/remailAgentIdQuery_full.php');

      //view
      return view('mdbxAdmin.fullpages.officeRoster',[
         'thisAgentIdRecord'     => $thisAgentIdRecord,
         'remailAgentIdQuery'    => $remailAgentIdQuery,
         'remailAgentIdFirst5'   => $remailAgentIdFirst5,
         'remailAgentIdLast5'    => $remailAgentIdLast5,
         'showPanel'             => 'agentMatch',
      ]);

   }

   public function agentEditPost(){
      //get umid
      $umid=request('umid');
      $curAgentTempOfficeID=request('curAgentTempOfficeID');
      $newAgentTempOfficeID=request('newAgentTempOfficeID');

      //error if none
      if(!$umid||!$curAgentTempOfficeID||!$newAgentTempOfficeID){
         dd('error-line54-agentRecordController');}

      $checkAgent=agtoffice::where('propagent_id','=',"$umid")
      ->first();

      if(!$checkAgent){
         dd('error-line60-agentRecordController');}

      //detect tempOfficeIdChange
      $tempOfficeIdChange=0;
      //if different change to 1
      if($curAgentTempOfficeID !== $newAgentTempOfficeID){
         //set to 1
         $tempOfficeIdChange=1;
         //check verified
         $officeCheck=propoffice::select('officeClear')
         ->where('officeID','=',"$newAgentTempOfficeID")
         ->first();
         //get officeClear
         $officeClear=$officeCheck['officeClear'];
         //error if none
         if(!$officeClear){

            $idArray = array(
               'status'                => 'notClear',
               'curAgentTempOfficeID'  => $curAgentTempOfficeID,
               'newAgentTempOfficeID'  => $newAgentTempOfficeID,
               'tempOfficeIdChange'    => $tempOfficeIdChange,
            );
            //display & exit
            echo json_encode($idArray);
            exit();

         }else{
            //change all fields of agtoffice to match propoffice values
            $newOffice=propoffice::where('officeID','=',"$newAgentTempOfficeID")
            ->select('officeName','officeAddress1','officeCity',
               'officeState','officeZip')
            ->first();
            //change to new office variables
            $officeName       = $newOffice['officeName'];
            $officeAddress1   = $newOffice['officeAddress1'];
            $officeCity       = $newOffice['officeCity'];
            $officeState      = $newOffice['officeState'];
            $officeZip        = $newOffice['officeZip'];
            //check old office - if no agent records left - trash
            $oldOfficeCount=agtoffice::where('tempOfficeID','=',"$curAgentTempOfficeID")
            ->count();
            //if no old counts update
            if(!$oldOfficeCount){
               //agtoffice
               agtoffice::where('tempOfficeID','=',"$curAgentTempOfficeID")
               ->update([
                  'officeConfirmDelete'=>1,
                  'officeDeleteReason'=>'Last Agent Moved',
               ]);
               //propoffice
               propoffice::where('officeID','=',"$curAgentTempOfficeID")
               ->update([
                  'confirmDelete'=>1,
                  'deleteReason'=>'Last Agent Moved',
                  'officeClear'=>null,
               ]);
            }

            agtoffice::where('propagent_id','=',"$umid")
            ->update([
               'tempOfficeID'    => $newAgentTempOfficeID,
               'officeName'      => $officeName,
               'officeAddress1'  => $officeAddress1,
               'officeCity'      => $officeCity,
               'officeState'     => $officeState,
               'officeZip'       => $officeZip,
            ]);

            $idArray = array(
               'status'                => 'moved',
               'umid'                  => $umid,
               'curAgentTempOfficeID'  => $curAgentTempOfficeID,
               'newAgentTempOfficeID'  => $newAgentTempOfficeID,
               'tempOfficeIdChange'    => $tempOfficeIdChange,
            );

            //display & exit
            echo json_encode($idArray);
            exit();
         }
      }

      //ok to update if passed above
      agtoffice::where('propagent_id','=',"$umid")
      ->update([
         'tempOfficeID'=>$newAgentTempOfficeID,
      ]);

      $idArray = array(
         'status'                => 'success',
         'curAgentTempOfficeID'  => $curAgentTempOfficeID,
         'newAgentTempOfficeID'  => $newAgentTempOfficeID,
         'tempOfficeIdChange'    => $tempOfficeIdChange,
      );
      //display & exit
      echo json_encode($idArray);
      exit();
   }

}
