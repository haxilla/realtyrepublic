<?php

namespace App\Http\Controllers\member;
use App\Http\Controllers\Controller;

use App\models\core\propagent;
use Request;
use Validator;
use Auth;


class memberNewFlyerController extends Controller
{

   public function __construct()
   {
      $this->middleware('auth:member');
   }

   public function createNewFlyer(Request $request){
      //get umid
      $umid=Auth::guard('member')->user()->id;
      //get mlsNum
      $xMlsNum=request('xMlsNum');
      //validate
      $validator = Validator::make($request::all(), [
         'xMlsNum' => 'bail|required|digits_between:5,15',]);

      //if fails return back
      if ($validator->fails()){
         return response()->json([
            'errors'=>$validator->errors()->all(),
         ]);}

      //query for agent
      $getAgent=propagent::where('id','=',$umid)
      ->select('agtBoard')
      ->first();
      //get board
      $agtBoard=$getAgent['agtBoard'];

      //set importability
      $importable=0;
      //check board
      if($agtBoard=='GLVAR'){
         $importable=1;}

      if($importable==1){
         //if GLVAR
         if($agtBoard=='GLVAR'){
            include(app_path().'/members/imports/glvar_mlsNumber.php');}
            
      }

      //send response
      return response()->json([
         'importable'   => $importable,
         'agtBoard'     => $agtBoard,
      ]);

   }


}
