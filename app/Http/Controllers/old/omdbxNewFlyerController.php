<?php

namespace App\Http\Controllers;

use Request;
use Auth;
use Validator;
use App\propagent;
use App\propflyer;
use App\tempflyer;
use App\Helpers\customFunctions;

class omdbxNewFlyerController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:web');
   }

   public function create(){

      $umid=Auth::guard('web')->user()->id;
      $showPre=0;
      $editMLS=request('editMLS');
      $noMLS=request('noMLS');
      $inMLS=0;
      $ssAutosuggest=0;

      if($editMLS && $editMLS=='1'){
         //if going back make editable
         $showPre=1;
      }

      //check for mdbxid
      if(request('mdbxid')){
         //set variable
         $mdbxid=request('mdbxid');
         //does info exist for this mdbxid
         $tempExists=tempflyer::where('mdbxid','=',"$mdbxid")
         ->first();
         //if yes send it over
         if($tempExists){
            //update if removing from MLS
            if($noMLS && $noMLS=='1'){
               tempflyer::where('mdbxid','=',"$mdbxid")
               ->where('propagent_id','=',"$umid")
               ->update([
                  'inMLS'        => $inMLS,
                  'tempMlsNum'   => null
               ]);
               //refresh to get update
               $tempExists=tempflyer::where('mdbxid','=',"$mdbxid")
               ->first();
            }
            $tempInfo=$tempExists;
         }elseif($mdbxid =='createNew'){
            //create key
            include(app_path() . '/functions/genMdbxID.php');
            //create in temp table
            tempflyer::create([
               'mdbxid'          => $mdbxid,
               'propagent_id'    => $umid,
               'inMLS'           => $inMLS
            ]);
            //package last insert in variable
            $tempInfo=tempflyer::where('mdbxid','=',"$mdbxid")
            ->first();
         }else{
            //if mdbxid is set but not matching
            //anything valid, wipe it out
            //triggers preCreate Screen
            $mdbxid='createNew';
            $tempInfo='none';
            $showPre=1;
         }
      }else{
      //if mdbxid is not set, create new
         $mdbxid     = 'createNew';
         $tempInfo   = 'none';
         $showPre    = 1;
      }

      return view('members.mdbx.mdbxCreateNew',[
         'mdbxid'          => $mdbxid,
         'tempInfo'        => $tempInfo,
         'inMLS'           => $inMLS,
         'showPre'         => $showPre,
         'ssAutosuggest'   => $ssAutosuggest
      ]);

   }

   public function upload(){

      include(app_path() . '/functions/mdbxUploadProcess.php');

   }

   //when MLS# is posted
   public function mdbxid(){

      //member id
      $umid=Auth::guard('web')->user()->id;
      $showPre=0;
      $inMLS=1;

      //from preCreate form
      $tempMlsNum=request('xMlsNum');
      $mdbxid=request('mdbxid');

      //security error
      if(!$mdbxid){
         dd('errorline113-mdbxNewFlyerController');
      }

      //detect duplicate
      $flyerExists=propflyer::where('propagent_id','=',"$umid")
      ->where('xMlsNum','=',"$tempMlsNum")
      ->first();
      if($flyerExists){
         dd('duplicate found');
      }

      if($mdbxid=='createNew'){

         $inMLS=1;
         //create key
         include(app_path() . '/functions/genMdbxID.php');
         //create in temp table
         tempflyer::create([
            'tempMlsNum'      => $tempMlsNum,
            'mdbxid'          => $mdbxid,
            'propagent_id'    => $umid,
            'inMLS'           => $inMLS,
         ]);

         //package last insert in variable
         $tempInfo=tempflyer::where('mdbxid','=',"$mdbxid")
         ->first();

      }

      //if in temp table
      $tempExists=tempflyer::where('mdbxid','=',"$mdbxid")
      ->where('propagent_id','=',"$umid")
      ->first();

      if($tempExists){

         //if exists keep the same
         $mdbxid=$tempExists['mdbxid'];
         $ssAutosuggest=$tempExists['ssAutosuggest'];
         tempflyer::where('mdbxid','=',"$mdbxid")
         ->where('propagent_id','=',"$umid")
         ->update([
            'tempMlsNum'=> $tempMlsNum,
            'inMLS'     => $inMLS
         ]);

         //package last update in variable
         $tempInfo=tempflyer::where('mdbxid','=',"$mdbxid")
         ->first();

      }else{

         //create key
         include(app_path() . '/functions/genMdbxID.php');

         //create in temp table
         tempflyer::create([
            'tempMlsNum'      => $tempMlsNum,
            'mdbxid'          => $mdbxid,
            'propagent_id'    => $umid,
            'inMLS'           => $inMLS
         ]);

         $tempInfo=tempflyer::where('mdbxid','=',"$mdbxid")
         ->where('propagent_id','=',"$umid")
         ->first();
      }

      return view('members.mdbx.mdbxCreateNew',[
         'mdbxid'          => $mdbxid,
         'tempInfo'        => $tempInfo,
         'showPre'         => $showPre,
         'inMLS'           => $inMLS,
         'ssAutosuggest'   => $ssAutosuggest
      ]);

   }

   public function mdbxAjaxSaveStep(Request $request){

      $umid=Auth::guard('web')->user()->id;
      $mdbxid=request('mdbxid');
      $thisStep=1;

      $existing=tempflyer::where('mdbxid','=',"$mdbxid")
      ->where('propagent_id','=',"$umid")
      ->first();

      //if not there stop
      if(!$existing){
         dd($mdbxid,'Sorry we had an error - line125-mdbxnewflyerController');
      }

      if($thisStep=='1'||$thisStep=='postLinkMLS'){
         //Step 1 saved here
         //variables
         $formStep=request('formStep');
         $ssAutosuggest=request('ssAutosuggest');
         $tempFullStreet=request('xFullStreet');
         $tempUnitNum=request('xUnitNum');
         $tempCity=request('xCity');
         $tempState=request('xState');
         $tempZip=request('xZip');

         //validate
         $validator = \Validator::make($request::all(), [
            'xFullStreet'  => 'Required',
            'xCity'        => 'Required',
            'xState'       => 'Required|digits:5',
            'xZip'         => 'Required|digits:5'
         ]);

         if ($validator->passes()) {
            //eloquent save
            tempflyer::where('mdbxid','=',"$mdbxid")
            ->where('propagent_id','=',"$umid")
            ->update([
               'tempFullStreet'=>$tempFullStreet,
               'tempCity'=>$tempCity,
               'tempState'=>$tempState,
               'tempZip'=>$tempZip,
               'tempUnitNum'=>$tempUnitNum,
               'ssAutosuggest'=>$ssAutosuggest,
               'formStep'=>$formStep
            ]);

            //send values and exit
            $idArray = array(
               'status' => 'success',
            );

            echo json_encode($idArray);
            exit();
         }

         //if you're here, validator did not pass
         //send values and exit
         // ** validation failure code here ** //
         //send values and exit
            /*
            $idArray = array(
               'status' => 'failure',
            );

            echo json_encode($idArray);
            exit();
            */
         return response()->json([
            'error'=>$validator->errors()->all()
         ]);

      }//end of step 1

      if($thisStep=='2' || $thisStep=='postLinkMLS'){
         //Step 2 saved here
         //variables
         $tempIntersection=request('xIntersection');
         $tempBeds=request('xBeds');
         $tempBaths=request('xBaths');
         $tempSqft=request('xSqft');
         $tempYrBuilt=request('xYrBuilt');
         $tempPoolPvt=request('xPoolPvt');
         $tempParking=request('xParking');
         //eloquent save
         tempflyer::where('mdbxid','=',"$mdbxid")
         ->where('propagent_id','=',"$umid")
         ->update([
            'tempIntersection'=>$tempIntersection,
            'tempBeds'=>$tempBeds,
            'tempBaths'=>$tempBaths,
            'tempSqft'=>$tempSqft,
            'tempYrBuilt'=>$tempYrBuilt,
            'tempPoolPvt'=>$tempPoolPvt,
            'tempParking'=>$tempParking,
         ]);
      }//end of step 2

      return ('all good!');


   }//end of ajaxSave Function


}
