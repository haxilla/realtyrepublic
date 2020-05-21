<?php

namespace App\Http\Controllers\mdbxMember;
use App\Http\Controllers\Controller;

use Request;
use App\models\core\tempflyer;

class memberNewFlyerAjaxController extends Controller
{

   public function __construct()
   {
      $this->middleware('auth:member');
   }

   public function ajaxSaveStep(Request $request){
      //set variables
      $umid=\Auth::guard('member')->user()->id;
      $mdbxid=request('mdbxid');
      $thisStep=request('thisStep');
      //if requests are missing, error
      if(!$mdbxid||!$thisStep){
         dd('error-line27-memberNewFlyerAjaxController',$mdbxid,$thisStep);}

      //run query
      $existing=tempflyer::where('mdbxid','=',"$mdbxid")
      ->where('propagent_id','=',"$umid")
      ->first();
      //if not there, error
      if(!$existing){
         dd('error-line32-memberNewFlyerAjaxController',$mdbxid,$umid);}

      //all steps can reverify this info
      if($thisStep=='1'||$thisStep=='2'){
         //Step 1 saved here
         include(app_path().'/members/inputHelpers/step1request.php');
         //validate
         include(app_path().'/members/inputHelpers/step1validate.php');
         //exit if not validated
         if(!$validator->passes()){
            //send values and exit
            $data['error'] = $validator->errors()->all();
            echo json_encode($data);
            exit();}

         //default smartyCheck=0 - change if no DPB
         $checkSmarty=0;
         //check for DPB (delivery point barcode)
         $DPB=$existing['DPB'];
         //if not there look for it
         if(!$DPB){
            $checkSmarty=1;}

         //get smartyStreets info
         if($checkSmarty=='1'){
            @include(app_path() . '/sstrmdbx/start.php');}

         //set next formStep
         $formStep=2;
         //save
         include(app_path().'/members/inputHelpers/step1update.php');
         //if its step 1 STOP HERE
         //if its step 2 it needs to go on
         if($thisStep=='1'){
            //send json ressponse
            $idArray = array(
               'status'    => 'success',
               'thisStep'  => 'step1'
            );
            //show values & exit
            echo json_encode($idArray);
            exit();}}

      //if Step2 or Step3
      if($thisStep=='2'||$thisStep=='3'){
         //variables
         include(app_path().'/members/inputHelpers/step2request.php');
         //validate
         include(app_path().'/members/inputHelpers/step2validate.php');
         //exit if not validated
         if (!$validator->passes()) {
            //send values and exit
            $data['error'] = $validator->errors()->all();
            echo json_encode($data);
            exit();}

         //set next formStep
         $formStep=3;
         //save
         include(app_path().'/members/inputHelpers/step2update.php');
         //if its step 2 send values / exit
         if($thisStep=='2'){
            //setup json reply
            $idArray = array(
               'status'    => 'success',
               'thisStep'  => $thisStep,);
            //send values & exit
            echo json_encode($idArray);
            exit();}

         //if its step 3 ???
         if($thisStep=='3'){
            dd('TBD');}

      }
   }

   public function ajaxSaveMls(Request $request){

      $mdbxid=request('mdbxid');
      $xMlsNum=request('theXmlsNum');

      $validator = \Validator::make($request::all(), [
         'theXmlsNum'      => 'digits_between:6,15|nullable',
      ]);

      if($validator->passes()){
         tempflyer::where('mdbxid','=',"$mdbxid")
         ->update([
            'tempMlsNum'=>$xMlsNum
         ]);
         $status="success";
      }else{
         $status="fail";
      }

      //json output
      $idArray = array(
         'status'       => $status,
         'xMlsNum'      => $xMlsNum,
      );

      echo json_encode($idArray);
   }
}
