<?php

namespace App\Http\Controllers;

use Request;
use Validator;
use Auth;
use App\newaccessrequest;
use App\propagent;
use App\agtoffice;

class adminTrialRequestController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function show(){
      //$newTrialRequests=newaccessrequest::where('adminApproved','=','0')
      //->get();
      $trialID=request('trialID');

      if($trialID){

         $trialRequestor=newaccessrequest::where('id','=',"$trialID")
         ->first();

         return view('admin.showTrialRecord',[
            'trialRequestor'=>$trialRequestor
         ]);
      }

      return view('admin.showNewTrials');
   }

   public function post(Request $request){
      //get ID
      $trialID=request('trialID');
      //error if not
      if(!$trialID){
         dd('error-line37-newTrialRequestController');}
      // ---> proceed
      //get variables
      include(app_path().'/functions/inputHelpers/agentInfoRequest.php');
      include(app_path().'/functions/inputHelpers/trialInfoRequest.php');
      //validate
      include(app_path().'/functions/inputHelpers/agentInfoValidate.php');
      //redirect if not validated
      if (!$validator->passes()){
         return redirect()->back()->withInput()->withErrors($validator);}

      // ---> proceed
      // process variables
      // if any of the fields below are missing just update
      if(!$agtMlsID||!$agtBoard||!$agtCounty||!$areaList){
         //only update agent in database
         include(app_path().'/functions/inputHelpers/trialAgentUpdate.php');

         return redirect()->back()
         ->with('message', "Info Updated!");}

      // ---> proceed
      // process account
      //update all fields
      include(app_path().'/functions/inputHelpers/trialAgentUpdate.php');
      include(app_path().'/functions/inputHelpers/trialFieldsUpdate.php');
      //redirect out and have modal confirmation before adding to propagent
      $dup=propagent::where('agtUname','=',"$agtEmail")
      ->first();

      if($dup){
         $msg='Account Exists - Info Updated';
      }else{
         $msg='Confirm Account';}

      return \Redirect::route("showNewTrials",['trialID' => $trialID,])
         ->with('message', "$msg");

   }

   public function trialAccountApproved(){

      $trialID=request('trialID');
      if(!$trialID){
         dd('error-line75=newTrialRequestController');}

      // ---> proceed
      $getTrial=newaccessrequest::where('id','=',"$trialID")
      ->first();

      //set variables
      $agtUname         = $getTrial['agtEmail'];
      $agtFirst         = $getTrial['agtFirst'];
      $agtLast          = $getTrial['agtLast'];
      $agtFullName      = $agtFirst.' '.$agtLast;
      $officeName       = $getTrial['officeName'];
      $officeAddress1   = $getTrial['officeAddress1'];
      $officeCity       = $getTrial['officeCity'];
      $officeState      = $getTrial['officeState'];
      $officeZip        = $getTrial['officeZip'];
      $agtEmail         = $getTrial['agtEmail'];
      $agtWebsite       = $getTrial['agtWebsite'];
      $agtDesigs        = $getTrial['agtDesigs'];
      $agtMainPhone     = $getTrial['agtMainPhone'];
      $areaList         = $getTrial['areaList'];

      //set passwords
      $trialPassword=str_random(10);
      $passHash=bcrypt($trialPassword);

      $dup=propagent::where('agtUname','=',"$agtUname")
      ->first();

      if($dup){
         //set umid
         $umid=$dup['id'];
         //update existing propagent
         propagent::where('id','=',"$umid")
         ->update([
            'agtUname'        => $agtUname,
            'agtFirst'        => $agtFirst,
            'agtLast'         => $agtLast,
            'agtFullName'     => $agtFullName,
            'agtEmail'        => $agtEmail,
            'agtMainPhone'    => $agtMainPhone,
            'agtWebsite'      => $agtWebsite,
            'agtDesigs'       => $agtDesigs,
         ]);
         // update existing agtoffice
         agtoffice::where('propagent_id','=',"$umid")
         ->update([
            'officeName'      => $officeName,
            'officeAddress1'  => $officeAddress1,
            'officeCity'      => $officeCity,
            'officeState'     => $officeState,
            'officeZip'       => $officeZip,
         ]);

      }else{
      //add to propagent agtUname
         $getVersion=masterVersion::orderBy('id','desc')
         ->first();
         $microVersion=$getVersion['microVersion'];

         $newID=propagent::create([
            'accountType'     => 1,
            'agtUname'        => $agtUname,
            'agtFirst'        => $agtFirst,
            'agtLast'         => $agtLast,
            'agtFullName'     => $agtFullName,
            'agtEmail'        => $agtEmail,
            'agtMainPhone'    => $agtMainPhone,
            'agtWebsite'      => $agtWebsite,
            'agtDesigs'       => $agtDesigs,
            'trialPswd'       => $trialPassword,
            'passHash'        => $passHash,
            'agtReview'       => 1,
            'microVersion'    => $microVersion,
         ]);
         // add agtoffice
         agtoffice::create([
            'officeName'      => $officeName,
            'officeAddress1'  => $officeAddress1,
            'officeCity'      => $officeCity,
            'officeState'     => $officeState,
            'officeZip'       => $officeZip,
            'propagent_id'    => $newID->id,
         ]);
      }

      //create new distribution
      include(app_path().'/functions/adminOptions/addNewDistrib.php');

      //get adminID
      $adminID=Auth::guard('admin')->user()->id;
      //update as approved
      newaccessrequest::where('id','=',"$trialID")
      ->update([
         'adminApprove'       => $adminID,
         'adminApproveDate'   => \Carbon\Carbon::now(),
      ]);

      //redirect ask to send agent Account Email
      return redirect()->back()
         ->with('message', "Send Agent Email");

   }


}
