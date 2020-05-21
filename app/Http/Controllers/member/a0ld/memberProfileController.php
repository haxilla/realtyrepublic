<?php

namespace App\Http\Controllers\member;
use App\Http\Controllers\Controller;

use Auth;
use Request;
use App\models\core\propagent;

class memberProfileController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:member');
   }

   public function addAgentPhoto(){
      include(app_path().'/members/functions/addAgentPhoto.php');
   }

   public function addAgentLogo(){
      include(app_path().'/members/functions/addAgentLogo.php');
   }

   public function deleteAgentPhoto(){
      //get umid
      $umid=Auth::guard('member')->user()->id;
      //error if nonen
      if(!$umid){
         //setup values
         $idArray = array(
            "status"            => "Failed",
            "message"           => "Issue with MemberID",);

         //echo and exit
         echo json_encode($idArray);
         exit();}

      //remove photo values
      propagent::where('id','=',$umid)
      ->update([
         'agtPhoto'           => null,
         'agtPhotoHeight'     => null,
         'agtPhotoWidth'      => null,
         'agtPhotoRatio'      => null,
         'agtPhotoOrient'     => null,
         'agtPhotoFileSize'   => null,
      ]);

      //setup values
      $idArray = array(
         "umid"              => $umid,
         "status"            => "Success",
         "message"           => "Agent Photo Deleted",);

      //echo and exit
      echo json_encode($idArray);
      exit();
   }

   public function deleteAgentLogo(){
      //get umid
      $umid=Auth::guard('member')->user()->id;
      //error if nonen
      if(!$umid){
         //setup values
         $idArray = array(
            "status"            => "Failed",
            "message"           => "Issue with MemberID",);

         //echo and exit
         echo json_encode($idArray);
         exit();}

      //remove photo values
      propagent::where('id','=',$umid)
      ->update([
         'agtLogo'           => null,
         'agtLogoHeight'     => null,
         'agtLogoWidth'      => null,
         'agtLogoRatio'      => null,
         'agtLogoOrient'     => null,
         'agtLogoFileSize'   => null,
      ]);

      //setup values
      $idArray = array(
         "umid"              => $umid,
         "status"            => "Success",
         "message"           => "Agent Logo Deleted",);

      //echo and exit
      echo json_encode($idArray);
      exit();
   }

   public function updateProfile(Request $request){
      //get umid
      $umid=Auth::guard('member')->user()->id;
      //to figure out originating request
      $key=request('k');
      //error if none
      if(!$umid){
         dd('error-line106-memberProfileController');}

      //request form info
      include(app_path().'/functions/inputHelpers/agentInfoRequest.php');

      //validate
      include(app_path().'/functions/inputHelpers/agentInfoValidate_noCaptcha.php');

      //return if validation fails
      if($validator->fails()){
         return back()
         ->withInput()
         ->withErrors($validator);}

      //no commas allowed in first or last name
      if(strpos($agtFirst,',')!==false||strpos($agtLast,',')!==false){
         $errors=['No Commas Allowed in First or Last Name!'];
         return back()
         ->withInput()
         ->withErrors($errors);}

      //database update
      include(app_path().'/functions/inputHelpers/agentInfoUpdate.php');

   }
}
