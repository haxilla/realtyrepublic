<?php

namespace App\Http\Controllers\mdbxMember;
use App\Http\Controllers\Controller;

use App\models\core\tempflyer;
use Illuminate\Http\Request;
use Auth;


class memberNewFlyerController extends Controller
{

   public function __construct()
   {
      $this->middleware('auth:member');
   }

   public function createNewFlyer(){

      $mdbxid=request('mdbxid');
      $editMLS=request('editMLS');
      $noMLS=request('noMLS');
      $umid=Auth::guard('member')->user()->id;
      $showPre=0;

      include(app_path().'/accountVariables/accountInfo.php');

      if($editMLS=='1'){
         //if going back make editable
         $showPre=1;}

      if(!$mdbxid){
         $showPre=1;
         $mdbxid='createNew';
         $tempInfo='none';}

      if($noMLS){

         include(app_path().'/members/keygens/mdbxFlyerKeys.php');
         //copy as mdbxid
         $mdbxid=$sk1;
         //add record
         tempflyer::create([
            'mdbxid'          => $mdbxid,
            'propagent_id'    => $umid,
            'inMLS'           => 0,
         ]);
         //return view
         return \Redirect::route("member.flyerStarter",[
            'mdbxid'=>$mdbxid,
         ]);

      }

      return view('mdbxMember.fullPages.newFlyerStarter',[
         'mdbxid'             => $mdbxid,
         'showPre'            => $showPre,
         'tempInfo'           => $tempInfo,
         'accountInfo'        => $accountInfo,
         'activeCampaigns'    => $activeCampaigns,
         'completeCampaigns'  => $completeCampaigns,
      ]);

   }

   public function postNewMLS(){
      //member id
      $umid=Auth::guard('member')->user()->id;
      $mdbxid=request('mdbxid');
      $xMlsNum=request('xMlsNum');
      //must have MLS# or error
      if(!$xMlsNum){
         $data=["MLS number is required<BR> 
         If not in MLS <a href='/mdbxMember/createNewFlyer?noMLS=1'>Click Here Instead</a>"];
         return back()->with(['errors'=>$data]);}

      //process xMlsNum
      include(app_path().'/members/newFlyer/checkMlsNum.php');

      //process mdbxid
      if($mdbxid=='createNew'){
         //below generates SK1
         include(app_path().'/members/keygens/mdbxFlyerKeys.php');
         //copy as mdbxid
         $mdbxid=$sk1;
         //add record
         tempflyer::create([
            'mdbxid'          => $mdbxid,
            'propagent_id'    => $umid,
            'inMLS'           => 1,
            'tempMlsNum'      => $xMlsNum,
         ]);
         //return view
         return \Redirect::route("member.flyerStarter",[
            'mdbxid'=>$mdbxid,
         ]);

      }elseif($mdbxid){

         @include(app_path().'/members/newFlyer/checkMdbxid.php');
         return \Redirect::route("member.flyerStarter",[
            'mdbxid'=>$mdbxid,
         ]);

      }else{

         dd('error-line53-memberNewFlyerController');}

   }

   public function flyerStarter(){
      //get mdbxid
      $mdbxid=request('mdbxid');
      $showPre=request('showPre');
      include(app_path().'/accountVariables/accountInfo.php');
      //error if no mdbxid
      if(!$mdbxid){
         dd('error-line62-memberNewFlyerController');}
      //query
      $tempInfo=tempflyer::where('mdbxid','=',"$mdbxid")
      ->first();
      //view
      return view('mdbxMember.fullPages.newFlyerStarter',[
         'mdbxid'             => $mdbxid,
         'tempInfo'           => $tempInfo,
         'showPre'            => $showPre,
         'accountInfo'        => $accountInfo,
         'agentInfo'          => $agentInfo,
         'activeCampaigns'    => $activeCampaigns,
         'completeCampaigns'  => $completeCampaigns,
      ]);
   }

}
