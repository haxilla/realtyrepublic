<?php

namespace App\Http\Controllers\admin\old;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\models\core\propflyer;
use App\models\core\propagent;
use App\models\core\propmeta;

class adminClickSynchController_v1 extends Controller
{

   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function synchStart(){
      include(app_path().'/synch/resets/synchStart.php');
   }
   public function synchProgress(){
      include(app_path().'/synch/resets/synchProgress/synchProgress.php');
   }
   public function resetAgent(){
      //agents
      include(app_path().'/synch/resets/agent/resetAgent.php');
   }
   public function resetOffice(){
      //agtOffice
      include(app_path().'/synch/resets/agent/resetAgtOffice.php');
   }
   public function resetFlyer(){
      //Flyer has Archives,Mapping,Meta,Remarks,Stat
      include(app_path().'/synch/resets/flyer/resetFlyer.php');
   }
   public function resetFlyerMeta(){
      //Flyer has Archives,Mapping,Meta,Remarks,Stat
      include(app_path().'/synch/resets/flyer/resetFlyerMeta.php');
   }
   public function resetFlyerMapping(){
      //Flyer has Archives,Mapping,Meta,Remarks,Stat
      include(app_path().'/synch/resets/flyer/resetFlyerMapping.php');
   }
   public function resetFlyerStat(){
      //Flyer has Archives,Mapping,Meta,Remarks,Stat
      include(app_path().'/synch/resets/flyer/resetFlyerStat.php');
   }
   public function resetFlyerRemarks(){
      //Flyer has Archives,Mapping,Meta,Remarks,Stat
      include(app_path().'/synch/resets/flyer/resetFlyerRemarks.php');
   }
   public function resetStyle(){
      //Flyer has Archives,Mapping,Meta,Remarks,Stat
      include(app_path().'/synch/resets/style/resetStyle.php');
   }
   public function resetPhoto(){
      //Has Archive table
      include(app_path().'/synch/resets/photo/resetPhoto.php');
   }
   public function resetDeliv(){
      //Has Archive table
      include(app_path().'/synch/resets/deliv/resetDeliv.php');
   }
   public function resetDelivNow(){
      //No Archive table
      include(app_path().'/synch/resets/delivnow/resetDelivNow.php');
   }
   public function resetOrder(){
      //No Archive table
      include(app_path().'/synch/resets/order/resetOrder.php');
   }
   public function resetEmailRemoval(){
      //No Archive table
      include(app_path().'/synch/resets/emailRemoval/resetEmailRemoval.php');
   }
   public function updateEtrack2018(){
      //No Archive table
      include(app_path().'/synch/resets/etrack/etrack2018.php');
   }



}
