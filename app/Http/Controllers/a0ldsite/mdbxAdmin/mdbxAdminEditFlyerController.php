<?php

namespace App\Http\Controllers\mdbxAdmin;

use Request;
use App\Http\Controllers\Controller;
use App\models\core\propflyer;
use App\models\core\propremark;
use App\models\core\propmapping;

class mdbxAdminEditFlyerController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function editDetailsPost(request $request){
      $idFly=request('idFly');
      $umid=propflyer::where('id','=',"$idFly")
      ->pluck('propagent_id')
      ->first();

      if(!$idFly||!$umid){
         dd('error-line65-mdbxEditController');}

      $xListPrice    = request('xListPrice');
      $xMlsNum       = request('xMlsNum');
      $xIntersection = request('xIntersection');
      $xFullStreet   = request('xFullStreet');
      $xUnitNum      = request('xUnitNum');
      $xCity         = request('xCity');
      $xState        = request('xState');
      $xZip          = request('xZip');
      $xBeds         = request('xBeds');
      $xBaths        = request('xBaths');
      $xSqft         = request('xSqft');
      $xYrBuilt      = request('xYrBuilt');
      $xPoolPvt      = request('xPoolPvt');
      $xParking      = request('xParking');
      $xb1           = request('xb1');
      $xb2           = request('xb2');
      $xb3           = request('xb3');
      $xb4           = request('xb4');
      $xb5           = request('xb5');
      $xb6           = request('xb6');
      $xb7           = request('xb7');
      $xb8           = request('xb8');
      $xPubRemarks   = request('xPubRemarks');

      //validate
      $validator = \Validator::make($request::all(), [
         'xMlsNum'         => 'nullable|numeric|min:3',
         'xFullStreet'     => 'Required|min:5',
         'xCity'           => 'Required|min:3',
         'xState'          => 'Required|size:2',
         'xZip'            => 'nullable|digits:5',
         'xUnitNum'        => 'nullable|alpha_dash',
         'xListPrice'      => 'Required|numeric|min:3',
         'xIntersection'   => 'Required|min:3',
         'xBeds'           => 'Required|numeric',
         'xBaths'          => 'Required|numeric',
         'xSqft'           => 'Required|numeric',
         'xYrBuilt'        => 'Required|numeric|between:1500,2200',
         'xPoolPvt'        => 'Required',
         'xParking'        => 'Required',
         'xb1'             => 'nullable|max:27',
         'xb2'             => 'nullable|max:27',
         'xb3'             => 'nullable|max:27',
         'xb4'             => 'nullable|max:27',
         'xb5'             => 'nullable|max:27',
         'xb6'             => 'nullable|max:27',
         'xb7'             => 'nullable|max:27',
         'xb8'             => 'nullable|max:27',
      ]);

      if ($validator->passes()){

         propflyer::where('id','=',"$idFly")
         ->where('propagent_id','=',"$umid")
         ->update([
            'xMlsNum'         => $xMlsNum,
            'xFullStreet'     => $xFullStreet,
            'xCity'           => $xCity,
            'xState'          => $xState,
            'xZip'            => $xZip,
            'xUnitNum'        => $xUnitNum,
            'xListPrice'      => $xListPrice,
            'xBeds'           => $xBeds,
            'xBaths'          => $xBaths,
            'xSqft'           => $xSqft,
            'xYrBuilt'        => $xYrBuilt,
            'xPoolPvt'        => $xPoolPvt,
            'xParking'        => $xParking,
         ]);

         propremark::where('propflyer_id','=',"$idFly")
         ->where('propagent_id','=',"$umid")
         ->update([
            'xb1'             => $xb1,
            'xb2'             => $xb2,
            'xb3'             => $xb3,
            'xb4'             => $xb4,
            'xb5'             => $xb5,
            'xb6'             => $xb6,
            'xb7'             => $xb7,
            'xb8'             => $xb8,
            'xPubRemarks'     => $xPubRemarks
         ]);

         propmapping::where('propflyer_id','=',"$idFly")
         ->where('propagent_id','=',"$umid")
         ->update([
            'xIntersection' =>$xIntersection
         ]);

         return back()
         ->with('message', "Changes Saved!");

      }

      //if you're here validation did not pass
      //back to form with errors
      return back()
      ->withErrors($validator);

   }
}
