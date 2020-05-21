<?php

namespace App\Http\Controllers\mdbxPublic;
use App\Http\Controllers\Controller;

use App\models\core\agtoffice;
use App\models\core\propflyer;
use App\models\core\propmeta;
use App\models\core\propagent;
use App\models\core\propdelivnow;
use App\models\core\propdeliv;
use App\models\admin\adminOption;
use Request;
use Validator;
use Auth;
use Hash;

class mdbxPublicLoginController_v1 extends Controller
{
  public function login(Request $request){
    //formfields
    $thePswd      = $request::input('password');
    $uName        = $request::input('agtUname');
    $rememberMe   = $request::input('rememberMe') ? true : false;
    $fromForm     = $request::input('fromForm');
    //if fromForm has captcha in it require captcha validation
    if($fromForm=='loginCaptchaModal'){
      //require captcha check
      $validator = Validator::make($request::all(), [
      'g-recaptcha-response' => 'required',]);
      //if fails return back
      if ($validator->fails()) {
        return back()
        ->withErrors($validator)
        ->withInput()
        ->with('loginModalCaptchaError','Field Required');}

      //set message to use in captchaV2validate
      $errorMessage='loginModalCaptchaError';
      //validate captcha
      include(app_path().'/functions/inputHelpers/captchaV2validate.php');
    }
    //if NOT authorized run script to log-in
    if(!Auth::guard('member')->check()){
      //AUTH is using **passHash** for password field
      //this is set in the User.php model getAuthPassword()
      //checks 2 fields agtUname && xxAgtUname
      if (!Auth::attempt([
        'agtUname' => $uName,
        'password' => $thePswd],$rememberMe)
        &&
        !Auth::attempt([
        'xxAgtUname'=> $uName,
        'password' => $thePswd],$rememberMe)
        &&
        !Auth::viaRemember()){
          return back()
          ->withErrors(['message'=>'Error with Login Credentials'])
          ->withInput()
          ->with('loginModalError','Error with Login Credentials');
        }
    }
    //authorized member below
    $umid=Auth::guard('member')->user()->id;

    //set lastLogin
    $lastLogin=\Carbon\Carbon::now();
    propagent::where('id','=',"$umid")
    ->update([
      'lastLogin'=>$lastLogin]);
    
    //check paymentMode;
    $getAdminOptions=adminOption::first();
    $paymentMode=$getAdminOptions['paymentMode'];

    //run query
    $agentInfo=propagent::select(
      'remCreds','expireDate','accountType','agtReview','id',
      'agtFirst','agtLast','agtDesigs','agtMainPhone','agtEmail',
      'agtWebsite','agtPhoto','agtLogo','officeID','trialPswd',
      'passHash','agtWebsite')
    ->with(['theAgentMeta'=>function($q){
      $q->select('propagent_id','newRemID');
    }])
    ->where('id','=',"$umid")
    ->first();
    //if these match force a new password
    $trialPassword=$agentInfo['trialPswd'];
    $passHash=$agentInfo['passHash'];
    if(Hash::check($trialPassword,$passHash)){
      $changePswd=1;
      propagent::where('id','=',"$umid")
      ->update([
        'agtReview'=>1
      ]);
      //rerun query to include update
      $agentInfo=propagent::select(
        'remCreds','expireDate','accountType','agtReview','id',
        'agtFirst','agtLast','agtDesigs','agtMainPhone','agtEmail',
        'agtWebsite','agtPhoto','agtLogo','officeID','trialPswd',
        'passHash')
      ->with(['theAgentMeta'=>function($q){
        $q->select('propagent_id','newRemID');
      }])
      ->where('id','=',"$umid")
      ->first();
    }else{
      $changePswd=0;}

    $officeInfo=agtoffice::select(
      'officeName','officeAddress1','officeCity','officeState',
      'officeZip','officeID')
    ->where('propagent_id','=',"$umid")
    ->first();

    //counts
    include(app_path().'/flyerVariables/campaignCounts.php');

    //if agtReview=0 & accountType=1 & unsentFlyer count > 0
    //redirect to flyer landing
    if($agentInfo['agtReview']<1 && $agentInfo['accountType']=='1'
    && $unsentCount>0){
      //set id
      $id=$unsentFlyers->first()->id;
      //get secretkey
      $getSK1=propmeta::where('propflyer_id','=',"$id")
      ->select('sk1')
      ->first();
      //set secretkey
      $sk1=$getSK1['sk1'];
      //redirect to landing
      return redirect()->route('member.flyerEdit',['id'=>$sk1]);}

    //redirect to branch if only one
    if($totalCampaignCount==1){
      //get secretkey
      $getSK1=propmeta::where('propflyer_id','=',"$id")
      ->select('sk1')
      ->first();
      //set secretkey
      $sk1=$getSK1['sk1'];
      return redirect()->route('member.flyerBranch',['id'=>$sk1]);}

    include(app_path().'/accountVariables/accountInfo.php');

    return view('mdbxMember.memberIndex',[
      'umid'              => $umid,
      'agentInfo'         => $agentInfo,
      'officeInfo'        => $officeInfo,
      'paymentMode'       => $paymentMode,
      'accountInfo'       => $accountInfo,
      'activeCampaigns'   => $activeCampaigns,
      'unsentFlyers'      => $unsentFlyers,
      'completeCampaigns' => $completeCampaigns,
      'officeID'          => $officeInfo['officeID'],
      'mdbxid'            => 'createNew',
      'tempInfo'          => 'none',
      'showPre'           => 1,
      'idFly'             => null,
      'changePswd'        => $changePswd,
    ]);

  }

  public function logout(){
    auth()->guard('member')->logout();
    return redirect()->route('public.index');
  }

}
