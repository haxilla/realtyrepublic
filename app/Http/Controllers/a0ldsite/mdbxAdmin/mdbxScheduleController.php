<?php

namespace App\Http\Controllers\mdbxAdmin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\models\core\propdeliv;
use App\models\core\propflyer;
use App\models\core\propdelivnow;

class mdbxScheduleController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function show(){
      $camps=request('camps');

      if($camps==='lastComplete'){

         $theDate=\Carbon\Carbon::now()->subDays(1);

         $campDesc='Last Complete';
         $allCampsGroup=propdeliv::select('propflyer_id','propagent_id',
            'emRequest','emComplete','campLabel')
         ->with(['theFlyer'=>function($q){
            $q->select('id','propagent_id','xFullStreet');
         }])
         ->with(['theAgent'=>function($q){
            $q->select('id','agtFullName');
         }])
         ->with(['theMeta'=>function($q){
            $q->select('propflyer_id','sk1');
         }])
         ->orderBy('emComplete','desc')
         ->where('emComplete','>',$theDate)
         ->get();

      }elseif($camps==='Unauthorized'){

         $campDesc='Unauthorized';
         $allCampsGroup=propdelivnow::select('propflyer_id','propagent_id',
            'emRequest','emArea')
         ->with(['theAgent'=>function($q){
            $q->select('id','agtFullName');
         }])
         ->with(['theFlyer'=>function($q){
            $q->select('id','propagent_id','xFullStreet');
         }])
         ->whereNotNull('emRequest')
         ->where('emRequest','<=',\Carbon\Carbon::now())
         ->whereNull('authorized')
         ->groupBy('propflyer_id')
         ->orderBy('emRequest')
         ->get();

      }elseif($camps==='Authorized'){

         $campDesc='Authorized';
         $allCampsGroup=propdelivnow::select('propflyer_id','propagent_id',
            'emArea','campLabel','emRequest')
         ->whereNotNull('emRequest')
         ->whereNull('emComplete')
         ->with(['theFlyer'=>function($q){
            $q->select('id','xFullStreet');
         }])
         ->with(['theAgent'=>function($q){
            $q->select('id','agtFullName');
         }])
         ->orderBy('campLabel')
         ->orderBy('emRequest')
         ->get();

      }else{
         dd('error-line49-mdbxScheduleController');
      }

      return view('mdbxAdmin.fullPages.mdbxShowSchedule',[
         'campDesc'        => $campDesc,
         'allCampsGroup'   => $allCampsGroup,
      ]);
   }
}
