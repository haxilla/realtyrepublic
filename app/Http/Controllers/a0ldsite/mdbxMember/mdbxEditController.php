<?php

namespace App\Http\Controllers\mdbxMember;
use App\Http\Controllers\Controller;

use Request;
use App\models\core\propflyer;
use App\models\core\propagent;
use App\models\core\agtoffice;
use App\models\core\propremark;
use App\models\core\propmapping;
use Auth;

class mdbxEditController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:member');
   }

   public function editFlyerDetails(){

      include(app_path().'/flyerVariables/existingFlyerCheck.php');

      $propInfo=propflyer::where('id','=',"$idFly")
      ->where('propagent_id','=',"$umid")
      ->first();

      $propRemarks=propremark::where('propflyer_id','=',"$idFly")
      ->where('propagent_id','=',"$umid")
      ->first();

      $xIntersection=propmapping::where('propflyer_id','=',"$idFly")
      ->where('propagent_id','=',"$umid")
      ->pluck('xIntersection')
      ->first();

      return view('mdbxMember.fullPages.editFlyerDetails',[
         'propInfo'        => $propInfo,
         'propRemarks'     => $propRemarks,
         'xIntersection'   => $xIntersection
      ]);

   }

   public function editAgentDetails(){

      $umid=Auth::guard('member')->user()->id;
      $id=request('id');

      if(!$umid){
         dd('error-line52-mdbxEditController');}

      $agentInfo=propagent::select(
         'officeID','agtFirst','agtLast','agtDesigs',
         'agtPhoto','agtLogo','agtMainPhone','agtEmail',
         'agtWebsite','id')
      ->with(['theAgentMeta'=>function($q){
         $q->select('newRemID','propagent_id');}])
      ->where('id','=',"$umid")
      ->first();

      $officeInfo=agtoffice::select
         ('officeName','officeAddress1',
         'officeCity','officeState','officeZip','officeID')
         ->where('propagent_id','=',"$umid")
         ->first();

      include(app_path().'/accountVariables/accountInfo.php');

      return view('mdbxMember.fullPages.editAgentDetails',[
         'umid'               => $umid,
         'agentInfo'          => $agentInfo,
         'officeInfo'         => $officeInfo,
         'accountInfo'        => $accountInfo,
         'activeCampaigns'    => $activeCampaigns,
         'completeCampaigns'  => $completeCampaigns,
         'id'                 => $id,
      ]);

   }

   public function editFlyerLinks(){

      $idFly=request('idFly');
      $umid=Auth::user()->id;

      if(!$idFly||!$umid){
         dd('error-line65-mdbxEditController');}

      dd($idFly);

   }

   public function flyerDetailsPost(request $request){

      include(app_path().'/flyerVariables/existingFlyerCheck.php');

      $xListPrice    = request('xListPrice');
      $xMlsNum       = request('xMlsNum');
      $xIntersection = request('xIntersection');
      $xFullStreet   = request('xFullStreet');
      $xUnitNum      = request('xUnitNum');
      $xCity         = request('xCity');
      $xState        = request('xState');
      $xZip          = request('xZip');
      $xBeds         = request('xBeds');
      $xBaths        = request('xBaths');
      $xSqft         = request('xSqft');
      $xYrBuilt      = request('xYrBuilt');
      $xPoolPvt      = request('xPoolPvt');
      $xParking      = request('xParking');
      $xb1           = request('xb1');
      $xb2           = request('xb2');
      $xb3           = request('xb3');
      $xb4           = request('xb4');
      $xb5           = request('xb5');
      $xb6           = request('xb6');
      $xb7           = request('xb7');
      $xb8           = request('xb8');
      $xPubRemarks   = request('xPubRemarks');

      //validate
      $validator = \Validator::make($request::all(), [
         'xMlsNum'         => 'nullable|numeric|min:3',
         'xFullStreet'     => 'Required|min:5',
         'xCity'           => 'Required|min:3',
         'xState'          => 'Required|size:2',
         'xZip'            => 'nullable|digits:5',
         'xUnitNum'        => 'nullable|alpha_dash',
         'xListPrice'      => 'Required|numeric|min:3',
         'xIntersection'   => 'Required|min:3',
         'xBeds'           => 'Required|numeric',
         'xBaths'          => 'Required|numeric',
         'xSqft'           => 'Required|numeric',
         'xYrBuilt'        => 'Required|numeric|between:1500,2200',
         'xPoolPvt'        => 'notin:Select',
         'xParking'        => 'notin:Select',
      ]);

      if ($validator->passes()){

         propflyer::where('id','=',"$idFly")
         ->where('propagent_id','=',"$umid")
         ->update([
            'xMlsNum'         => $xMlsNum,
            'xFullStreet'     => $xFullStreet,
            'xCity'           => $xCity,
            'xState'          => $xState,
            'xZip'            => $xZip,
            'xUnitNum'        => $xUnitNum,
            'xListPrice'      => $xListPrice,
            'xBeds'           => $xBeds,
            'xBaths'          => $xBaths,
            'xSqft'           => $xSqft,
            'xYrBuilt'        => $xYrBuilt,
            'xPoolPvt'        => $xPoolPvt,
            'xParking'        => $xParking,
         ]);

         propremark::where('propflyer_id','=',"$idFly")
         ->where('propagent_id','=',"$umid")
         ->update([
            'xb1'             => $xb1,
            'xb2'             => $xb2,
            'xb3'             => $xb3,
            'xb4'             => $xb4,
            'xb5'             => $xb5,
            'xb6'             => $xb6,
            'xb7'             => $xb7,
            'xb8'             => $xb8,
            'xPubRemarks'     => $xPubRemarks
         ]);

         propmapping::where('propflyer_id','=',"$idFly")
         ->where('propagent_id','=',"$umid")
         ->update([
            'xIntersection' =>$xIntersection
         ]);

         return \Redirect::route("member.editFlyerDetails", ['id'=>$id])
         ->with('message', "Changes Saved!");

      }

      //if you're here validation did not pass
      //back to form with errors
      return back()
      ->withErrors($validator);

   }

   public function agentDetailsPost(request $request){

      $id=request('id');
      $umid=Auth::user()->id;
      $changePswd=request('changePswd');

      if(!$umid){
         dd('error-line196-mdbxEditController');}

      //requests basic agent info fields
      include(app_path().'/functions/inputHelpers/agentInfoRequest.php');
      //validate
      include(app_path().'/functions/inputHelpers/agentInfoValidate_noCaptcha.php');

      //no commas allowed
      $searchString=',';
      // if found back with message
      // change to error since message looks like success
      if(strpos($agtFirst, $searchString) !== false
      ||strpos($agtLast, $searchString) !== false ){
         return \Redirect::route("member.editAgent")
         ->with('message', "NO COMMAS ALLOWED IN FIRST OR LAST NAME");}

      if ($validator->passes()){

         //if they need to change password - validate
         if($changePswd==1){
            //validate
            include(app_path().'/functions/inputHelpers/agentPswdValidate.php');
            //if it fails send back
            if(!$validator->passes()){
               return \Redirect::route("member.login")
               ->withErrors($validator);
            }else{
               //otherwise
               //code to update password
               $agtPassword=request('agtPassword');
               $passHash=bcrypt($agtPassword);
               propagent::where('id','=',"$umid")
               ->update([
                  'passHash'=>$passHash,
               ]);
               //send email about password change
            }
         }

         propagent::where('id','=',"$umid")
         ->update([
            'agtFirst'        => $agtFirst,
            'agtLast'         => $agtLast,
            'agtFullName'     => $agtFirst.' '.$agtLast,
            'agtEmail'        => $agtEmail,
            'agtMainPhone'    => $agtMainPhone,
            'agtWebsite'      => $agtWebsite,
            'agtDesigs'       => $agtDesigs,
         ]);

         agtoffice::where('propagent_id','=',"$umid")
         ->update([
            'officeName'      => $officeName,
            'officeAddress1'  => $officeAddress1,
            'officeCity'      => $officeCity,
            'officeState'     => $officeState,
            'officeZip'       => $officeZip
         ]);

         //used for determining where to redirect
         $checkAgent=propagent::select('agtReview')
         ->where('id','=',"$umid")
         ->first();

         $agtReview=$checkAgent['agtReview'];

         if($agtReview=='1'){
            propagent::where('id','=',"$umid")
            ->update([
               'agtReview'=>0,
            ]);

            return \Redirect::route("member.login")
            ->with('message', "Changes Saved!");
         }

         if($id){
            return \Redirect::route("member.flyerEdit", ['id'=>$id])
            ->with('message', "Agent Changes Saved!");
         }

         return \Redirect::route("member.editAgent")
         ->with('message', "Agent Changes Saved!");

      }

      //if you're here validation did not pass
      //back to form with errors
      return back()
      ->withInput()
      ->withErrors($validator);

   }

}
