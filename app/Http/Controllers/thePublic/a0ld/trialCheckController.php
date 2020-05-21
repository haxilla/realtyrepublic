<?php

namespace App\Http\Controllers\thePublic;
use App\Http\Controllers\Controller;
use Request;

class trialCheckController extends Controller
{

  public function trialCheck(Request $request){
    //get variables
    $theEmail=request('theEmail');
    $trialAddress=request('trialAddress');
    $fromForm=request('fromForm');
    //validate
    $validator = \Validator::make($request::all(), [
     'theEmail'       => 'bail|required|email',
     'trialAddress'   => 'bail|required|min:3',]);
    //exit if validation errors
    if ($validator->fails()){
      return response()->json(['errors'=>$validator->errors()->all()]);}

    //passed validation
    //dup test
    include(app_path().'/trialAccount/dupCheck.php');

    //if main found
    if($dupCheck){
      $data=['Account Already Exists with this Username!'];
        return response()->json(['errors'=>$data,'agtUname'=>$theEmail
      ]);}
    //if previous trial found
    if($dupImport){
      $data=['Trial Already Started with this Username!'];
        return response()->json(['errors'=>$data,'agtUname'=>$theEmail
      ]);}

    //check lists
    include(app_path().'/trialAccount/trialCheckList.php');
    //returns listName
    if($listName=='none'){
      //adds user and sets key
      include(app_path().'/trialAccount/unimportableUser.php');
      //respond/redirect with key
      return response()->json(['status'=>'unimportable','key'=>$key]);}

    //if here there was a listName Found
    dd('listFound!');

  }

  public function newAccessRequest(){

    include(app_path().'/trialAccount/unimportableForm.php');

    $html=\View::make('mdbxPublic.render.unimportable.signupForm')
    ->with('theEmail',$theEmail)
    ->with('key',$key)
    ->with('amt',0)
    ->with('purchaseDesc',null);

    echo $html;

  }

  public function newAccessSubmit(Request $request){

    //check form
    include(app_path().'/trialAccount/newAccessCheck.php');

    //if failure send error messages
    if (!$validator->passes()){
       return response()->json([
         'errors'=>$validator->errors()->all()]);}

    //validation passed - add to database here
    include(app_path().'/trialAccount/unimportableUpdate.php');

    //return success message
    return response()->json([
      'success'=>'true',
    ]);

  }

}
