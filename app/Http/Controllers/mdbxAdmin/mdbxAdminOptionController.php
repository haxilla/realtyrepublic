<?php

namespace App\Http\Controllers\mdbxAdmin;
use App\Http\Controllers\Controller;

use Request;
use Auth;
use App\models\core\User;
use App\models\core\allorder;
use App\models\core\propagent;
use App\models\archive\archiveFlyer;
use App\models\core\agtoffice;
use App\models\admin\adminTable;
use App\models\admin\adminOption;

use App\models\core\propphoto;
use App\models\core\propflyer;

class mdbxAdminOptionController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function show(){

      $showPanel=request('showPanel');
      $agentID=request('agentID');

      if(!$showPanel){
         $showPanel='modes';}

      //not used but just working example of getting admin ID//
      $adminID = Auth::guard('admin')->user()->id;
      //set variables
      $adminOptions=adminOption::first();
      $emailMode=$adminOptions['emailMode'];
      $agentLoginMode=$adminOptions['agentLoginMode'];
      $paymentMode=$adminOptions['paymentMode'];
      $journalMode=$adminOptions['journalMode'];
      //show view
      return view('mdbxAdmin.fullPages.mdbxAdminOptions',[
         'emailMode'       => $emailMode,
         'agentLoginMode'  => $agentLoginMode,
         'paymentMode'     => $paymentMode,
         'journalMode'     => $journalMode,
         'showPanel'       => $showPanel,
         'agentID'         => $agentID,
         'newAdd'          => null,
      ]);
   }

   public function post(){

      $emailMode=request('emailMode');
      $agentLoginMode=request('agentLoginMode');
      $paymentMode=request('paymentMode');
      $journalMode=request('journalMode');

      //update modes if value other then Change is set
      if($emailMode !== 'Change'){
         adminOption::where('adminID','=','1')
         ->update([
            'emailMode'=>$emailMode
         ]);
      }
      if($agentLoginMode !== 'Change'){
         adminOption::where('adminID','=','1')
         ->update([
            'agentLoginMode'=>$agentLoginMode
         ]);
      }
      if($paymentMode !== 'Change'){
         adminOption::where('adminID','=','1')
         ->update([
            'paymentMode'=>$paymentMode
         ]);
      }
      if($journalMode !== 'Change'){
         adminOption::where('adminID','=','1')
         ->update([
            'journalMode'=>$journalMode
         ]);
      }
      return back();
   }

   public function addAgentCheck(Request $request){
      //set variables
      $areaList=request('areaList');
      $agtEmail=request('agtEmail');
      $lastArea=request('lastArea');
      //sets null but replaced if found
      $agentID1=null;
      $agentID2=null;
      //validate as email
      $validator = \Validator::make($request::all(), [
         'agtEmail'        => 'email|required',]);
      //if validation fails send back
      if (!$validator->passes()){
         //back to form with errors
         return back()->withErrors($validator);}
      //check distribution
      $theEmail=$agtEmail;
      include(app_path().'/functions/adminOptions/distribCheck.php');
      //check accounts
      include(app_path().'/functions/adminOptions/accountCheck.php');

      //if not found anywhere redirect out
      if(!$agentID1 && !$agentID2){
         return \Redirect::route("addAgentReturn",[
            'showPanel'    => 'addAgent',
            'agentID'      => null,
            'eidx'         => null,
            'accountID'    => null,
            'newAdd'       => 1,
            'addDistrib'   => 1,
            'addAccount'   => 1,
            'agtEmail'     => $agtEmail,
            'areaList'     => $areaList,
            'lastAdd'      => 'new',
            'lastArea'     => $lastArea,
            'hasAccount'   => null,
         ]);}
      // if still here analyze
      // script below returns $agentID,$agentInfo,$officeInfo,
      // $addDistrib, $addAccount
      include(app_path().'/functions/adminOptions/accountAnalyzer.php');
      //return page view
      return \Redirect::route("addAgentReturn",[
         'showPanel'    => 'addAgent',
         'agentID'      => $agentID,
         'eidx'         => $eidx,
         'lastArea'     => $lastArea,
         'lastAdd'      => $lastAdd,
         'addDistrib'   => $addDistrib,
         'addAccount'   => $addAccount,
         'areaList'     => $areaList,
         'newAdd'       => 0,
         'hasAccount'   => $hasAccount,
      ]);

   }

   public function addAgentPost(Request $request){

      $agentID       = request('agentID');
      $agtFirst      = request('agtFirst');
      $agtLast       = request('agtLast');
      $agtEmail      = request('agtEmail');
      $agtDesigs     = request('agtDesigs');
      $agtWeb        = request('agtWeb');
      $agtMainPhone  = request('agtMainPhone');
      $officeID      = request('officeID');
      $officeName    = request('officeName');
      $officeAddress = request('officeAddress');
      $officeCity    = request('officeCity');
      $officeState   = request('officeState');
      $officeZip     = request('officeZip');
      $agtUname      = request('agtUname');
      $password      = request('password');
      $areaList      = request('areaList');
      $eidx          = request('eidx');
      $remCreds      = request('remCreds');
      $pCreds        = request('pCreds');
      $expireDate    = request('expireDate');
      $accountType   = request('accountType');
      $agtReview     = request('agtReview');
      $agtBoard      = request('agtBoard');
      $agtCounty     = request('agtCounty');
      $agtMlsID      = request('agtMlsID');

      if(!$agtUname && !$areaList){
         dd('You must add to area list or add username/password');}

      if($agtUname && !$accountType){
         dd('You must choose an Account type!');}

      //no commas allowed
      $searchString=',';
      // if found back with message
      // change to error since message looks like success
      if(strpos($agtFirst, $searchString) !== false
      ||strpos($agtLast, $searchString) !== false ){
         dd('no commas allowed in first or last name!');
      }

      //validate
      $validator = \Validator::make($request::all(), [
         'agtFirst'        => 'min:3|required',
         'agtLast'         => 'min:3|required',
         'agtEmail'        => 'email|required',
         'agtUname'        => 'email|nullable',
         'password'        => 'min:7|nullable',
         'agtMainPhone'    => 'max:15|required',
         'officeName'      => 'min:3|required',
         'officeAddress'   => 'min:3|required',
         'officeCity'      => 'min:3|required',
         'officeState'     => 'size:2|required',
         'officeZip'       => 'digits:5|required',
         'agtWebsite'      => 'nullable|url',
      ]);

      //if validation fails send back
      if (!$validator->passes()){
         //back to form with errors
         return back()->withErrors($validator);}

      //get variables from form post
      $addDistrib    = request('addDistrib');
      $addAccount    = request('addAccount');
      $agentID       = request('agentID');
      $accountID     = request('accountID');
      $hasAccount    = request('hasAccount');

      //distribution add / update
      if($addDistrib && $areaList){
         include(app_path().'/functions/adminOptions/addNewDistrib.php');
         $lastAdd='distrib';
         $lastArea=$areaList;
      }elseif($areaList){
         include(app_path().'/functions/adminOptions/updateDistrib.php');
         $lastAdd='distrib';
         $lastArea=$areaList;}

      //agent account add / update
      if($addAccount){
         //only create account if $agtUname provided
         if($agtUname){
            include(app_path().'/functions/adminOptions/addNewAccount.php');
            $lastAdd='account';
            $lastArea='account';}
      }else{
         include(app_path().'/functions/adminOptions/updateAccount.php');
         $lastAdd='account';
         $lastArea='account';}

      //redirect with agentID to avoid refreshes on post
      return \Redirect::route("addAgentReturn",[
         'showPanel'    => 'addAgent',
         'agentID'      => $agentID,
         'lastAdd'      => $lastAdd,
         'lastArea'     => $lastArea,
         'areaList'     => $areaList,
         'addAccount'   => $addAccount,
         'addDistrib'   => $addDistrib,
         'eidx'         => $eidx,
         'accountID'    => $accountID,
         'hasAccount'   => $hasAccount
      ]);
   }

   public function return(){
      //this serves as a redirect to use GET instead of POST
      //after a submission
      //get variables from url
      $lastAdd=request('lastAdd');
      //comes from distro check or update
      $lastArea=request('lastArea');
      //comes from dropdown form
      $areaList=request('areaList');
      $agentID=request('agentID');
      $agtEmail=request('agtEmail');
      //set to invoke post behaviour
      $addAccount=request('addAccount');
      $addDistrib=request('addDistrib');
      $eidx=request('eidx');
      $accountID=request('accountID');
      $hasAccount=request('hasAccount');

      if(!$areaList && $lastArea){
         $areaList=$lastArea;}

      if(!$agentID){
         return view('mdbxAdmin.fullPages.mdbxAdminOptions',[
            'showPanel'    => 'addAgent',
            'agentID'      => null,
            'eidx'         => null,
            'accountID'    => null,
            'newAdd'       => 1,
            'addDistrib'   => 1,
            'addAccount'   => 1,
            'agtEmail'     => $agtEmail,
            'areaList'     => $areaList,
            'lastAdd'      => 'new',
            'lastArea'     => $lastArea,
            'hasAccount'   => $hasAccount,
         ]);}

      if($lastAdd==='account'){
         //get info
         $agentInfo=propagent::where('id','=',"$agentID")
         ->first();
         $officeInfo=agtoffice::where('propagent_id','=',"$agentID")
         ->first();
      }else{
         //set model
         $appPrefix = 'App';
         $theList=$appPrefix.'\\'.$lastArea;
         //get info
         $agentInfo=$theList::where('eidx','=',"$agentID")
         ->first();
         $officeInfo=$theList::where('eidx','=',"$agentID")
         ->first();
      }

      //return to view
      return view('mdbxAdmin.fullPages.mdbxAdminOptions',[
         'showPanel'    => 'addAgent',
         'agentID'      => $agentID,
         'eidx'         => $eidx,
         'accountID'    => $accountID,
         'agentInfo'    => $agentInfo,
         'officeInfo'   => $officeInfo,
         'areaList'     => $areaList,
         'newAdd'       => null,
         'lastAdd'      => $lastAdd,
         'lastArea'     => $lastArea,
         'addDistrib'   => $addDistrib,
         'addAccount'   => $addAccount,
         'hasAccount'   => $hasAccount,
      ]);

   }

   public function loginAsAgent(){

      $umid=request('umid');
      $id=request('id');

      if(!$umid){
         dd('error-line334-adminOptionController');}

      //prepare for login
      $user    = User::find($umid);
      //log user in
      Auth::guard('member')->login($user);

      if($id){
         //direct to mLogin Route
         return \Redirect::route("member.flyerEdit",['id'=>$id])
         ->with('message', "Logged in as agent!");
      }else{
         return \Redirect::route("member.login")
         ->with('message', "Logged in as agent!");
      }

   }

   public function addAdminPost(Request $request){
      //form request
      include(app_path().'/functions/inputHelpers/adminInfoRequest.php');
      //2 validations because later update function
      //password is not required so its a separate validation

      //validate Info
      include(app_path().'/functions/inputHelpers/adminInfoValidate.php');
      //if errors send back
      if (!$validator->passes()){
         //back to form with errors
         return back()->withInput()->withErrors($validator);}

      //Validate Password
      include(app_path().'/functions/inputHelpers/adminPasswordValidate.php');
      //if errors send back
      if (!$validator->passes()){
         //back to form with errors
         return back()->withInput()->withErrors($validator);}

      //encrypt
      $password=bcrypt($password);
      //create new admin
      include(app_path().'/functions/inputHelpers/adminInfoCreate.php');

      return \Redirect::route("adminOptions",[
         'showPanel'=>'addAdmin',
      ])->with('message', "New Admin Added Successfully!");

   }

   public function adminProfilePost(Request $request){

      $adminID = Auth::guard('admin')->user()->id;
      //form request
      include(app_path().'/functions/inputHelpers/adminInfoRequest.php');
      //validate Info
      include(app_path().'/functions/inputHelpers/adminInfoValidate.php');
      //if errors send back
      if (!$validator->passes()){
         //back to form with errors
         return back()->withInput()->withErrors($validator);}

      //ok to update
      include(app_path().'/functions/inputHelpers/adminInfoUpdate.php');

      return \Redirect::route("adminOptions",[
         'showPanel'=>'adminProfile',
      ])->with('message', "Profile Updated Successfully!");

   }

   public function testPurchaseDelete(){
      //get vars
      $umid=request('umid');
      $orderID=request('orderID');
      //error if not found
      if(!$umid||!$orderID){
         dd('error-line402-mdbxAdminOptionController');}
      //delete command
      allorder::destroy($orderID);
      propagent::destroy($umid);
      agtoffice::destroy($umid);
      //redirect
      return back();
   }

}
