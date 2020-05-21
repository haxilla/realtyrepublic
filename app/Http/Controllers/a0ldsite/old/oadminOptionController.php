<?php

namespace App\Http\Controllers;

use Request;
use Auth;
use App\adminOption;
use App\propagent;
use App\agtoffice;

class oadminOptionController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function show(){

      $showPanel=request('showPanel');
      $agentID=request('agentID');

      if(!$showPanel){
         $showPanel='modes';
      }
      //not used but just working example of getting admin ID//
      $adminID = Auth::guard('admin')->user()->id;

      //set variables
      $adminOptions=adminOption::first();
      $emailMode=$adminOptions['emailMode'];
      $agentLoginMode=$adminOptions['agentLoginMode'];
      $paymentMode=$adminOptions['paymentMode'];

      //show view
      return view('admin.adminOptions',[
         'emailMode'       => $emailMode,
         'agentLoginMode'  => $agentLoginMode,
         'paymentMode'     => $paymentMode,
         'showPanel'       => $showPanel,
         'agentID'         => $agentID,
      ]);
   }

   public function post(){
      $emailMode=request('emailMode');
      $agentLoginMode=request('agentLoginMode');
      $paymentMode=request('paymentMode');

      //update modes if value other then Change is set
      if($emailMode !== 'Change'){
         adminOption::where('adminID','=','1')
         ->update([
            'emailMode'=>$emailMode
         ]);
      }
      if($agentLoginMode !== 'Change'){
         adminOption::where('adminID','=','1')
         ->update([
            'agentLoginMode'=>$agentLoginMode
         ]);
      }
      if($paymentMode !== 'Change'){
         adminOption::where('adminID','=','1')
         ->update([
            'paymentMode'=>$paymentMode
         ]);
      }
      return back();
   }

   public function addAgentPost(Request $request){

      $agentID       = request('agentID');
      $agtFirst      = request('agtFirst');
      $agtLast       = request('agtLast');
      $agtEmail      = request('agtEmail');
      $agtDesigs     = request('agtDesigs');
      $agtWeb        = request('agtWeb');
      $agtMainPhone  = request('agtMainPhone');
      $officeName    = request('officeName');
      $officeAddress = request('officeAddress');
      $officeCity    = request('officeCity');
      $officeState   = request('officeState');
      $officeZip     = request('officeZip');
      $agtUname      = request('agtUname');
      $password      = request('password');
      $areaList      = request('areaList');

      if(!$agtUname && !$areaList){
         dd('You must add to area list or add username/password');}

      //no commas allowed
      $searchString=',';
      // if found back with message
      // change to error since message looks like success
      if(strpos($agtFirst, $searchString) !== false
      ||strpos($agtLast, $searchString) !== false ){
         return \Redirect::route("mdbxEditAgent")
         ->with('message', "NO COMMAS ALLOWED IN FIRST OR LAST NAME");
      }

       //validate
      $validator = \Validator::make($request::all(), [
         'agtFirst'        => 'min:3|required',
         'agtLast'         => 'min:3|required',
         'agtEmail'        => 'email|required',
         'agtUname'        => 'email|nullable',
         'password'        => 'min:7|nullable',
         'agtMainPhone'    => 'max:15|required',
         'officeName'      => 'min:3|required',
         'officeAddress'   => 'min:3|required',
         'officeCity'      => 'min:3|required',
         'officeState'     => 'size:2|required',
         'officeZip'       => 'digits:5|required',
         'agtWeb'          => 'nullable|url',
      ]);

      if ($validator->passes()){
         // theEmail Variable is needed for trialChecks.php include
         // trialChecks will return a listname if found
         // and return none if not
         if($agtUname){
            $theEmail=$agtUname;
         }else{
            $theEmail=$agtEmail;}

         //checkDups
         $dup=propagent::where('agtUname','=',"$theEmail")
         ->orWhere('xxAgtUname','=',"$theEmail")
         ->orWhere('agtEmail','=',"$theEmail")
         ->first();

         //check theEmail for existing records in distribution
         //set default
         $listName='none';
         include(app_path().'/functions/trialCheckAZ.php');

         //if its found, update dont add
         if($listName!=='none'){
            //get eidx
            $eidx=$theList['eidx'];
            //get model by $areaList set in form
            $appPrefix = 'App';
            $theList=$appPrefix.'\\'.$areaList;
            //update
            $theList::where('eidx','=',"$eidx")
            ->update([
               'agtFirst'        => $agtFirst,
               'agtLast'         => $agtLast,
               'agtMainPhone'    => $agtMainPhone,
               'agtWeb'          => $agtWeb,
               'agtEmail'        => $agtEmail,
               'officeName'      => $officeName,
               'officeAddress1'   => $officeAddress,
               'officeCity'      => $officeCity,
               'officeState'     => $officeState,
               'officeZip'       => $officeZip,
            ]);

            if(!$agtUname){
               //set it to eidx
               $agentID=$eidx;
               //redirect otherwise ok to continue
               return \Redirect::route("addAgentReturn",[
                  'showPanel'=>'addAgent',
                  'agentID'=>$agentID,
               ]);
            }

         }

         //if no umid, create record
         if(!$agentID && $agtUname){
            //if agtUname provided but no agentID -
            //add to propagents
            //generate password
            $passHash=bcrypt($password);
            //add agent
            $new=propagent::create([
               'agtFirst'        => $agtFirst,
               'agtLast'         => $agtLast,
               'agtDesigs'       => $agtDesigs,
               'agtMainPhone'    => $agtMainPhone,
               'agtWeb'          => $agtWeb,
               'agtEmail'        => $agtEmail,
               'agtUname'        => $agtU name,
               'password'        => $agtPswd,
               'passHash'        => $passHash,]);
            //get new agentID
            $agentID=$new->id;
            //add office
            agtoffice::create([
               'officeName'      => $officeName,
               'officeAddress'   => $officeAddress,
               'officeCity'      => $officeCity,
               'officeState'     => $officeState,
               'officeZip'       => $officeZip,
               'propagent_id'    => $agentID,]);
         }elseif($agentID && $agtUname){
            //encrypt
            $passHash=bcrypt($password);
            //update agent/office
            propagent::where('id','=',"$agentID")
            ->update([
               'agtFirst'        => $agtFirst,
               'agtLast'         => $agtLast,
               'agtDesigs'       => $agtDesigs,
               'agtEmail'        => $agtEmail,
               'agtMainPhone'    => $agtMainPhone,
               'agtWeb'          => $agtWeb,
               'agtUname'        => $agtUname,
               'password'        => $password,
               'passHash'        => $passHash,
            ]);
            agtoffice::where('propagent_id','=',"$agentID")
            ->update([
               'officeName'       => $officeName,
               'officeAddress1'   => $officeAddress,
               'officeCity'       => $officeCity,
               'officeState'      => $officeState,
               'officeZip'        => $officeZip,
               'propagent_id'    => $agentID,
            ]);
         }

         //get info
         $agentInfo=propagent::where('id','=',"$agentID")
         ->first();
         $officeInfo=agtoffice::where('propagent_id','=',"$agentID")
         ->first();

         //if area list is set add to distro test
         if($areaList){
            //get model by $listName set in form
            $appPrefix = 'App';
            $theList=$appPrefix.'\\'.$areaList;
            //add to distribution list
            $new=$theList::create([
               'agtEmail'           => $theEmail,
               'agtFirst'           => $agtFirst,
               'agtLast'            => $agtLast,
               'officeName'         => $officeName,
               'officeAddress1'     => $officeAddress,
               'officeCity'         => $officeCity,
               'officeState'        => $officeState,
               'officeZip'          => $officeZip,
               'agtMainPhone'       => $agtMainPhone,]);

            //set variables
            $newID=$new->id;
            $eidx=$areaList.$newID.'mx';
            //get info to use if no propagent record
            $agentInfo2=$theList::where('agtEmail','=',"$theEmail")
            ->first();
            $officeInfo2=$theList::where('agtEmail','=',"$theEmail")
            ->first();
            //if no agent id
            //its just a distro list addition
            //no acccount associated yet
            if(!$agentID){
               $agentID=$eidx;
               $agentInfo=$agentInfo2;
               $officeInfo=$officeInfo2;
               //update with new eidx
               $theList::where('id','=',"$newID")
               ->update([
                  'eidx'=>$eidx,
               ]);
            }else{
               $theList::where('id','=',"$newID")
               ->update([
                  'eidx'=>$eidx,
                  'propagent_id'=>$agentID,
               ]);
            }
         }

         return \Redirect::route("addAgentReturn",[
            'showPanel'=>'addAgent',
            'agentID'=>$agentID,
         ]);
      }

      //if you're here validation did not pass
      //back to form with errors
      return back()
      ->withErrors($validator);

   }

   public function return(){
      //this serves as a redirect to use GET instead of POST
      //after a submission
      $showPanel='addAgent';
      $agentID=request('agentID');
      if(!$agentID){
         dd('error-line298-adminOptionController');}

      $agentInfo=propagent::where('id','=',"$agentID")
      ->first();
      $officeInfo=agtoffice::where('propagent_id','=',"$agentID")
      ->first();


      if(!$agentInfo){

         //below variables needed to run trial check script
         $listName='none';
         $eidx=$agentID;
         $theEmail='xnonex';

         include(app_path().'/functions/trialCheckAZ.php');

         if($listName==="none"){
            dd('error-line310-adminOptionController');}

         //set variable
         $appPrefix = 'App';
         //set model
         $theList=$appPrefix.'\\'.$listName;
         //get info
         $agentInfo=$theList::where('eidx','=',"$agentID")
         ->first();
         $officeInfo=$theList::where('eidx','=',"$agentID")
         ->first();
      }

      //return to view
      return view('admin.adminOptions',[
         'showPanel'    => 'addAgent',
         'agentID'      => $agentID,
         'agentInfo'    => $agentInfo,
         'officeInfo'   => $officeInfo
      ]);

   }

}
