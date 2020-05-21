<?php

namespace App\Http\Controllers;

use Request;
use Auth;
use Validator;
use App\propagent;
use App\propflyer;
use App\tempflyer;
use App\Helpers\customFunctions;

class omdbxNewFlyerController2 extends Controller
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
            //carry over inMLS variable
            $inMLS=$tempExists['inMLS'];
            //update if formStep is sent over
            if(request('formStep')){
               $formStep=request('formStep');
               tempflyer::where('mdbxid','=',"$mdbxid")
               ->where('propagent_id','=',"$umid")
               ->update([
                  'formStep'=>$formStep,
               ]);
            }
            //update if removing from MLS
            if($noMLS && $noMLS=='1'){
               tempflyer::where('mdbxid','=',"$mdbxid")
               ->where('propagent_id','=',"$umid")
               ->update([
                  'inMLS'        => 0,
                  'tempMlsNum'   => null
               ]);
               //inMLS=0
               $inMLS=0;
               //refresh to get update
               $tempExists=tempflyer::where('mdbxid','=',"$mdbxid")
               ->first();
            }
            //Re-declares to include changes
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

      //if in temp table
      $tempExists=tempflyer::where('mdbxid','=',"$mdbxid")
      ->where('propagent_id','=',"$umid")
      ->first();

      if($tempExists){

         //if exists keep the same
         $mdbxid=$tempExists['mdbxid'];
         $inMLS=1;

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
            'inMLS'           => 1
         ]);

         $tempInfo=tempflyer::where('mdbxid','=',"$mdbxid")
         ->where('propagent_id','=',"$umid")
         ->first();

         $ssAutosuggest=0;
      }

      return redirect()->route('mdbxCreateNew', ['mdbxid' => $mdbxid]);
      /*
      return view('members.mdbx.mdbxCreateNew',[
         'mdbxid'          => $mdbxid,
         'tempInfo'        => $tempInfo,
         'showPre'         => $showPre,
         'inMLS'           => $inMLS,
         'ssAutosuggest'   => $ssAutosuggest
      ]);
      */

   }

   public function mdbxAjaxSaveStep(Request $request){

      $umid=Auth::guard('web')->user()->id;
      $mdbxid=request('mdbxid');

      $myFunction = new customFunctions();
      $myFunction->serverValidate($request);

   }//end of ajaxSave Function


}
