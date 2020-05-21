<?php

namespace App\Http\Controllers;
use App\propflyer;
use App\propagent;
use App\agtoffice;
use App\qcreate;
use App\propdeliv;
use App\propdelivnow;
use Auth;

use Illuminate\Http\Request;

class adminMemberController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function aLogin($umid){

      //code below is here for example of how to show admin info
      if(Auth::guard('admin')){
         $adminID=Auth::guard('admin')->user()->id;
      }else{
         $adminID=0;
      }

      $agentInfo = propagent::where('id','=',"$umid")
      ->first();

      $officeInfo = agtoffice::where('propagent_id','=',"$umid")
      ->first();

      //Waiting Flyers
      $waitCount=propdelivnow::select('emArea_display','xFullStreet','emRequest','qcreate.id','cid')
      ->whereNotNull('emRequest')
      ->whereNull('emStart')
      ->where('propdelivnow.propagent_id','=',"$umid")
      ->leftJoin('qcreate', 'qcreate.id', '=', 'propdelivnow.propflyer_id')
      ->get();

      $allRecords = $waitCount->map(function ($item) {
          return [
            'xFullStreet'     => $item->xFullStreet,
            'emRequest'       => $item->emRequest,
            'emArea_display'  => $item->emArea_display,
            'cid'             => $item->cid,
            'id'              => $item->id
          ];
      });

      $xFulls=$allRecords->groupBy('xFullStreet');

      //In Progress
      $progCount=propdeliv::whereNotNull('emRequest')
      ->whereNotNull('emStart')
      ->whereNull('emComplete')
      ->where('propdelivs.propagent_id','=',"$umid")
      ->get();

      //Complete Camps
      $compCount=propdeliv::whereNotNull('emRequest')
      ->whereNotNull('emStart')
      ->whereNotNull('emComplete')
      ->where('propdelivs.propagent_id','=',"$umid")
      ->where('emComplete','>',\Carbon\Carbon::now()->subDays(30))
      ->get();

      //Incomplete FLyers
      $getIncompletes = qCreate::where('qcreate.propagent_id','=',"$umid")
      ->whereNull('xApproved')
      ->orWhere('xApproved','=','0')
      ->get();

      //Recent Flyers Last 30 days
      $getRecents = propflyer::where('propflyers.propagent_id','=',"$umid")
      ->leftJoin('propflyerstats' , 'propflyers.id', '=', 'propflyerstats.propflyer_id')
      ->where('xAgtSent','>',0)
      ->where( 'xLastDeliveryDate', '>', \Carbon\Carbon::now()->subDays(30))
      ->get();

      //Recent Flyers Last 6months
      $getOlders = propflyer::where('propflyers.propagent_id','=',"$umid")
      ->leftJoin('propflyerstats' , 'propflyers.id', '=', 'propflyerstats.propflyer_id')
      ->where('xAgtSent','>',0)
      ->where( 'xLastDeliveryDate', '<', \Carbon\Carbon::now()->subDays(30))
      ->where( 'xLastDeliveryDate', '>', \Carbon\Carbon::now()->subDays(180))
      ->orderBy('xLastDeliveryDate','desc')
      ->get();

      //if incomplete mark and show
      if($getIncompletes->first()){
        $hasInc=1;
      }else{
        $hasInc=0;
      }

      //if waitingCamps mark and show
      if($waitCount->first()){
        $hasWait=1;
      }else{
        $hasWait=0;
      }

      if($progCount->first()){
        $hasProg=1;
      }else{
        $hasProg=0;
      }

      //variables below must be set to make the FROMURL.php work properly
      $officeID   =  $officeInfo->officeID;
      $agentPhoto =  $agentInfo->agtPhoto;
      $agentLogo  =  $agentInfo->agtLogo;

      include(app_path() . '/functions/fromURL.php');

      return view('members.index',
      [
         'umid'            => $umid,
         'agentInfo'       => $agentInfo,
         'officeInfo'      => $officeInfo,
         'officeID'        => $officeID,
         'agentPhoto'      => $agentPhoto,
         'agentLogo'       => $agentLogo,
         'hasInc'          => $hasInc,
         'hasWait'         => $hasWait,
         'hasProg'         => $hasProg,
         'getIncompletes'  => $getIncompletes,
         'getRecents'      => $getRecents,
         'getOlders'       => $getOlders,
         'hasInc'          => $hasInc,
         'hasWait'         => $hasWait,
         'waitCount'       => $waitCount,
         'progCount'       => $progCount,
         'compCount'       => $compCount,
         'fromURL'         => $fromURL,
         'fromURL2'        => $fromURL2,
         'fromURL3'        => $fromURL3,
         'xFulls'          => $xFulls
      ]);

   }
}
