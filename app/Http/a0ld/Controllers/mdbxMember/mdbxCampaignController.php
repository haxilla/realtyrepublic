<?php

namespace App\Http\Controllers\mdbxMember;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Validator;
use App\models\core\propdelivnow;
use App\models\distro\emailareas;
use App\models\core\sellerlogin;

class mdbxCampaignController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:web');
   }

   public function post(Request $request){

      //get memberID
      $umid=Auth::user()->id;
      
      //check account
      include(app_path().'/members/functions/checkAccount.php')

      $validator = Validator::make($request->all(), [
         'emSubject'    => 'required',
         'sellerEmail'  => 'nullable|email',]);

      if(!$validator->passes()){
         //back to form with errors
         return back()->withInput()->withErrors($validator);}

      //set variables
      $id            = $request->input('id');
      $idFly         = $request->input('idFly');
      $emSubject     = $request->input('emSubject');
      $area1         = $request->input('area1');
      $area2         = $request->input('area2');
      $sellerEmail   = $request->input('sellerEmail');
      $sellerNote    = $request->input('sellerNote');

      //must choose 2 areas
      if($area1 == 'Select' or $area2 == 'Select'){
         return \Redirect::back()
         ->withInput()->withErrors("Must Choose Both Areas!");}
      //2 unique areas
      if($area1==$area2){
         return \Redirect::back()
         ->withInput()->withErrors("Please Choose 2 different areas!");}

      $dup1=propdelivnow::where('propflyer_id','=',"$idFly")
      ->where('emArea','=',"$area1")
      ->pluck('emArea_display')
      ->first();
      $dup2=propdelivnow::where('propflyer_id','=',"$idFly")
      ->where('emArea','=',"$area2")
      ->pluck('emArea_display')
      ->first();

      if($dup1){return \Redirect::back()
         ->withInput()->withErrors("You already have a campaign setup for $dup1");}
      if($dup2){return \Redirect::back()
         ->withInput()->withErrors("You already have a campaign setup for $dup2");}

      //all validation passed go ahead
      //*********************************************
      //retrieves counts for each area list variable
      //must be named with App path to work
      //*********************************************
      $appPrefix='\\App\models\distro';
      $area1Model=$appPrefix . '\\' . $area1;
      $area2Model=$appPrefix . '\\' . $area2;
      //area counts
      $areaCount1=$area1Model::count();
      $areaCount2=$area2Model::count();

      //area displays1
      $areaDisplay1=emailareas::where('emArea','=',"$area1")
      ->pluck('emArea_display')
      ->first();

      //if not there - create starter
      if(!$areaDisplay1){
         include(app_path() . '/functions/mdbx/mdbxStartAreas.php');
         $areaDisplay1=emailareas::where('emArea','=',"$area1")
         ->pluck('emArea_display')
         ->first();}
      //area displays2
      $areaDisplay2=emailareas::where('emArea','=',"$area2")
      ->pluck('emArea_display')
      ->first();
      //add area1
      propdelivnow::create([
         'propflyer_id'=>$idFly,
         'propagent_id'=>$umid,
         'emArea'=>$area1,
         'campLabel'=>'area1',
         'emRequest'=>Carbon::now(),
         'emSubject'=>$emSubject,
         'emArea_display'=>$areaDisplay1,
         'totalEmails'=>$areaCount1,]);
      //add area2
      propdelivnow::create([
         'propflyer_id'=>$idFly,
         'propagent_id'=>$umid,
         'emArea'=>$area2,
         'campLabel'=>'area2',
         'emRequest'=>Carbon::now(),
         'emSubject'=>$emSubject,
         'emArea_display'=>$areaDisplay2,
         'totalEmails'=>$areaCount2,]);

      //if seller message - create record
      if($sellerEmail){
         sellerlogin::create([
            'xSellerEmail'=>$sellerEmail,
            'xSellerNote'=>$sellerNote
         ]);}


      //send back with success message
      return \Redirect::route("member.flyerBranch", ['id'=>$id])
        ->with('message', "Campaigns Added Successfully!");

   }
}
