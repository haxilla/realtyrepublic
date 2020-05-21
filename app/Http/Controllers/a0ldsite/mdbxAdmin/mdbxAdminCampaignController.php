<?php

namespace App\Http\Controllers\mdbxAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\core\propdelivnow;
use App\models\core\propflyer;
use App\models\core\propstyle;

class mdbxAdminCampaignController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function deleteCamp(){
      $campID=request('campID');
      propdelivnow::destroy($campID);
      return back();
   }

   public function changeEmSubject(){
      $idFly=request('idFly');
      $emSubject=request('emSubject');
      propdelivnow::where('propflyer_id','=',"$idFly")
      ->update([
         'emSubject'=>$emSubject
      ]);

      $umid=propflyer::where('id','=',"$idFly")
      ->pluck('propagent_id')
      ->first();

      //show success email sent
      return \Redirect::route("adminFlyerCheck",[
         'propflyer_id'=>$idFly,
      ])->with('message', "Email Subject Changed");
   }

   public function addCampaignArea(){

      $idFly=request('propflyer_id');
      $campEmArea=request('campEmArea');

      $umid=propflyer::where('id','=',"$idFly")
      ->pluck('propagent_id')
      ->first();

      $template=propstyle::where('propflyer_id','=',"$idFly")
      ->pluck('template')
      ->first();

      $checkArea=propdelivnow::where('emArea','=',"$campEmArea")
      ->where('propflyer_id','=',"$idFly")
      ->first();

      if($checkArea){
         return back()
         ->with('message',"Area Already Exists!");}

      //if still here OK to add
      //get vars
      $campInfo=propdelivnow::where('propflyer_id','=',"$idFly")
      ->select('emSubject','authorized')
      ->first();
      //set vars
      $emSubject=$campInfo['emSubject'];
      $authorized=$campInfo['authorized'];

      include(app_path().'/functions/mdbx/emailAreaDisplay.php');
      include(app_path().'/functions/mdbx/emailAreaAdminCount.php');

      propdelivnow::create([
         'propflyer_id'    => $idFly,
         'propagent_id'    => $umid,
         'emSubject'       => $emSubject,
         'emArea'          => $campEmArea,
         'emArea_display'  => $emArea_display,
         'campLabel'       => $campLabel,
         'totalEmails'     => 0,
         'campCreated'     => \Carbon\Carbon::now(),
         'emRequest'       => \Carbon\Carbon::now(),
         'template'        => $template,
         'authorized'      => $authorized,
         'free'            => 1,
      ]);

      return back()
      ->with('message',"Campaign Added Successfully!");

   }

}
