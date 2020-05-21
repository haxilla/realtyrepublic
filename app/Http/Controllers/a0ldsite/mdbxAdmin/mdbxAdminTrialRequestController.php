<?php

namespace App\Http\Controllers\mdbxAdmin;
use App\Http\Controllers\Controller;
use Request;
use Validator;
use Auth;
use App\models\admin\newaccessrequest;
use App\models\core\propagent;
use App\models\core\propagentmeta;
use App\models\core\agtoffice;
use App\models\dev\masterVersion;

class mdbxAdminTrialRequestController extends Controller
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

         return view('mdbxAdmin.fullPages.mdbxAdminOptions',[
            'showPanel'       => 'showTrialRecord',
            'trialRequestor'  => $trialRequestor
         ]);
      }

      return view('mdbxAdmin.fullPages.mdbxAdminOptions',[
         'showPanel'=>'showTrialList'
      ]);
   }

   public function post(Request $request){
      //get ID
      $trialID=request('trialID');
      //get adminID
      $adminID=Auth::guard('admin')->user()->id;
      //error if not
      if(!$trialID){
         dd('error-line37-newTrialRequestController');}
      // ---> proceed
      //get variables
      include(app_path().'/functions/inputHelpers/agentInfoRequest.php');
      include(app_path().'/functions/inputHelpers/trialInfoRequest.php');
      include(app_path().'/functions/inputHelpers/addAgentRequest.php');
      //validate
      include(app_path().'/functions/inputHelpers/agentInfoValidate.php');
      include(app_path().'/functions/inputHelpers/addAgentValidate.php');
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
      //check dups
      $dup=propagent::where('agtUname','=',"$agtEmail")
      ->first();
      //set umid
      $umid=$dup['id'];
      //update if dup
      if($dup){
         //set msg
         $msg='Account Exists - Info Updated';
         //check newaccessrequest record
         $check=newaccessrequest::where('id','=',"$trialID")
         ->first();
         //error if none
         if(!$check){
            dd('error-line84-mdbxAdminTrialRequestController');}

         //check propagentmeta
         $theAgtMeta=propagentmeta::where('propagent_id','=',"$umid")
         ->first();
         //add if not present
         if(!$theAgtMeta){
            propagentmeta::create([
               'propagent_id'=>$umid,
               'newRemID'=>$newRemID,
               'adminID'=>$adminID
            ]);}
         //update as approved
         newaccessrequest::where('id','=',"$trialID")
         ->update([
            'adminApprove'       => $adminID,
            'adminApproveDate'   => \Carbon\Carbon::now(),
         ]);

      }else{

         $msg='Confirm Account';}

      return \Redirect::route("admin.showNewTrials",['trialID' => $trialID,])
         ->with('message', "$msg");

   }

   public function trialAccountApproved(){
      //get adminID
      $adminID=Auth::guard('admin')->user()->id;
      //trialID
      $trialID=request('trialID');
      //error if none
      if(!$trialID){
         dd('error-line75=newTrialRequestController');}

      //newaccessrequest query
      $getTrial=newaccessrequest::where('id','=',"$trialID")
      ->first();
      //set variables
      $agtMlsID         = $getTrial['agtMlsID'];
      $agtUname         = $getTrial['agtEmail'];
      $agtFirst         = $getTrial['agtFirst'];
      $agtLast          = $getTrial['agtLast'];
      $agtFullName      = $agtFirst.' '.$agtLast;
      $officeID         = $getTrial['officeID'];
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
      $agtCounty        = $getTrial['agtCounty'];
      $agtBoard         = $getTrial['agtBoard'];
      $amt              = $getTrial['amt'];
      $firstPurchase    = $getTrial['firstPurchase'];
      //set accountType
      $accountType=1;
      if($amt && !$firstPurchase){
         $accountType=4;}
      //create clean password
      include(app_path().'/functions/keyGens/cleanPassword.php');
      //set passwords
      $trialPassword=cleanPassword();
      //bcrypt password
      $passHash=bcrypt($trialPassword);
      //check dups
      $dup=propagent::where('agtUname','=',"$agtUname")
      ->first();
      //secret key
      include(app_path().'/functions/keyGens/ezshortUID.php');
      //set newRemID
      $newRemID=$ezshortUID;
      //update if dup
      if($dup){
         //set umid
         $umid=$dup['id'];
         //update existing propagent
         propagent::where('id','=',"$umid")
         ->update([
            'agtMlsID'        => $agtMlsID,
            'agtUname'        => $agtUname,
            'agtFirst'        => $agtFirst,
            'agtLast'         => $agtLast,
            'agtFullName'     => $agtFullName,
            'agtEmail'        => $agtEmail,
            'agtMainPhone'    => $agtMainPhone,
            'agtWebsite'      => $agtWebsite,
            'agtDesigs'       => $agtDesigs,
            'officeID'        => $officeID,
            'agtCounty'       => $agtCounty,
            'agtBoard'        => $agtBoard,
         ]);
         // update existing agtoffice
         agtoffice::where('propagent_id','=',"$umid")
         ->update([
            'officeID'        => $officeID,
            'officeName'      => $officeName,
            'officeAddress1'  => $officeAddress1,
            'officeCity'      => $officeCity,
            'officeState'     => $officeState,
            'officeZip'       => $officeZip,
         ]);
         //check propagentmeta
         $theAgtMeta=propagentmeta::where('propagent_id','=',"$umid")
         ->first();
         //add if not present
         if(!$theAgtMeta){
            propagentmeta::create([
               'propagent_id'=>$newID->id,
               'newRemID'=>$newRemID,
               'adminID'=>$adminID
            ]);}

      }else{

         //add to propagent agtUname
         $getVersion=masterVersion::orderBy('id','desc')
         ->first();
         //set microversion
         $microVersion=$getVersion['microVersion'];
         //create new record
         $newID=propagent::create([
            'accountType'     => $accountType,
            'agtMlsID'        => $agtMlsID,
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
            'officeID'        => $officeID,
            'agtReview'       => 1,
            'microVersion'    => $microVersion,
            'agtCounty'       => $agtCounty,
            'agtBoard'        => $agtBoard,
         ]);
         //capture umid
         $umid=$newID->id;
         // add agtoffice
         agtoffice::create([
            'officeID'        => $officeID,
            'officeName'      => $officeName,
            'officeAddress1'  => $officeAddress1,
            'officeCity'      => $officeCity,
            'officeState'     => $officeState,
            'officeZip'       => $officeZip,
            'propagent_id'    => $newID->id,
         ]);
         //propagentmeta
         propagentmeta::create([
            'propagent_id'=>$umid,
            'newRemID'=>$newRemID,
            'adminID'=>$adminID
         ]);}
         //end of if/else statement
      //create new distribution
      include(app_path().'/functions/adminOptions/addNewDistrib.php');
      //update as approved
      newaccessrequest::where('id','=',"$trialID")
      ->update([
         'adminApprove'       => $adminID,
         'umid'               => $umid,
         'adminApproveDate'   => \Carbon\Carbon::now(),
      ]);

      //redirect ask to send agent Account Email
      return \Redirect::route("admin.showNewTrials")
         ->with('message', "Agent Added!");

   }

   public function sendTrialWelcome(){
      //get
      $trialID=request('trialID');
      //query
      $getTrial=newaccessrequest::where('id','=',"$trialID")
      ->first();
      //send email
      //template stored in
      $sendThis="emails.mdbx.members.mdbxTrialApproved";
      //toName
      $toName=$getTrial['agtFirst'];
      //toEmail
      $toEmail=$getTrial['agtEmail'];
      $agtEmail=$toEmail;
      $agtFirst=$getTrial['agtFirst'];
      //Subject
      $theSubject="Welcome! Your RealtyEmails Account is now active!";
      //Password Query
      $getPassword=propagent::where('agtEmail','=',"$toEmail")
      ->select('trialPswd')
      ->first();
      //set fromURL
      include(app_path().'/functions/fromURL.php');
      //set Password
      $trialPassword=$getPassword['trialPswd'];
      //data
      $data=[
         'agtUname'        => $toEmail,
         'trialPassword'   => $trialPassword,
         'agtEmail'        => $agtEmail,
         'agtFirst'        => $agtFirst,
         'fromURL'         => $fromURL,
      ];
      //redirect after complete
      $redirectRoute = 'admin.showNewTrials';
      $redirectMsg   = "Welcome Email Sent to $toEmail";
      //sendEmail Template
      include(app_path().'/functions/email/sendEmailTemplate.php');
      //mark sent in database
      newaccessrequest::where('id','=',"$trialID")
      ->update([
         'welcomeSent'=>1,
         'welcomeSentDate'=>\Carbon\Carbon::now(),
      ]);
      //show success email sent
      return \Redirect::route("$redirectRoute")
      ->with('message', "$redirectMsg");

   }

   public function trialDelete(){
      //get umid from url
      $umid=request('umid');
      //check query
      $checkAgent=propagent::where('id','=',$umid)
      ->select('accountType')
      ->first();
      //get accountType
      $accountType=$checkAgent['accountType'];
      //autoTrialDelete only if accountType=1
      if($accountType=='1'){
         include(app_path().'/functions/autoTrialDelete.php');
      }else{
         dd('DENIED! UNABLE TO DELETE PAID ACCOUNT');}
      
   }

}
