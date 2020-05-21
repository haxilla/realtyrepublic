<?php

namespace App\Http\Controllers\mdbxPublic;
use App\Http\Controllers\Controller;
use App\models\core\propagent;
use App\models\core\propflyer;
use App\models\core\propagentcleanup;
use Request;

class publicAgentController extends Controller
{

   public function ajaxAgentInfo(){
      //get id
      $ajid=request('ajid');
      //error if none
      if(!$ajid){
         dd('error-line14-publicAgentController');}

      $getumid=propagentcleanup::where('newRemID','=',"$ajid")
      ->where(function($q){
        $q->where('accountType','=','main')
        ->orWhere('accountType','=',null);
      })
      ->select('propagent_id')
      ->first();

      if(!$getumid){
         $umid=$ajid;
      }else{
         $umid=$getumid['propagent_id'];}

      $getflyers=propflyer::where('propagent_id','=',"$umid")
      ->select('xFullStreet','creationDate','propagent_id','id',
         'xCity','xState','xZip','xxZip','xListPrice','xBeds','xxBeds',
         'xBaths','xxBaths','xSqft','xxSqft')
      ->whereHas('theStats',function($q){
          $q->where('xLastDeliveryDate','>',\Carbon\Carbon::now()->subdays(90));
      })
      ->whereHas('thePhotos',function($q){
        $q->where('def','=','1')
          ->where('resized','=','500');
      })
      ->with(['theAgent'=>function($q){
         $q->select(
         'id','agtFullName','agtFirst','agtLast','agtPhoto','agtMainPhone',
         'startDate','agtWebsite','agtURL','agtLogo')
            ->with(['theAgentCleanup'=>function($q){
               $q->select('propagent_id','newRemID');
            }]);
         }])
      ->with(['thePhotos'=>function($q){
         $q->select('propflyer_id','photoName','def','resized',
          'width','height','orient','ratio','ord')
          ->where('resized','=','500')
          ->where(function($q){
            $q->where('def','=','1');
          });
      }])
      ->with(['theMeta'=>function($q){
        $q->select('propflyer_id','zipDir','mlsDir','sk1');
      }])
      ->with(['theOffice'=>function($q){
         $q->select('officeName','propagent_id','officeID','officeAddress1',
            'officeCity','officeState','officeZip');
      }])
      ->orderBy('creationDate','desc')
      ->take(10)
      ->get();

      return $getflyers->toJson();


   }


}
