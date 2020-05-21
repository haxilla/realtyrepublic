<?php

namespace App\Http\Controllers;

use Request;
use Validator;
use Auth;
use App\propflyer;
use App\propstyle;
use App\propagent;
use App\agtoffice;
use App\propremark;

class autoSaveController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:web');
   }

   public function agtAutoSave(Request $request){

      //set variables from form
      $umid=Auth::user()->id;

      $agtFirst=$request::input('agtFirst');
      $agtLast=$request::input('agtLast');
      $agtDesigs=$request::input('agtDesigs');
      $agtMainPhone=$request::input('agtMainPhone');
      $agtWeb=$request::input('agtWeb');
      $agtEmail=$request::input('agtEmail');
      $officeName=$request::input('officeName');
      $officeAddress=$request::input('officeAddress');
      $officeCity=$request::input('officeCity');
      $officeState=$request::input('officeState');
      $officeZip=$request::input('officeZip');

      // script to convert digits only to phone format OR
      // will keep original if not at least 10 digits
      @include(app_path() . '/functions/function.usphone_format.php');

      $origPhone=$agtMainPhone;
      $agtMainPhone=usphone_format($agtMainPhone);

      //save agent
      propagent::where('id','=',"$umid")
      ->update([
         'agtFirst'        => $agtFirst,
         'agtLast'         => $agtLast,
         'agtDesigs'       => $agtDesigs,
         'origPhone'       => $origPhone,
         'agtMainPhone'    => $agtMainPhone,
         'agtWeb'          => $agtWeb,
         'agtEmail'        => $agtEmail
      ]);

      //save office
      agtoffice::where('propagent_id','=',"$umid")
      ->update([
         'officeName'      => $officeName,
         'officeAddress'   => $officeAddress,
         'officeCity'      => $officeCity,
         'officeState'     => $officeState,
         'officeAddress'   => $officeAddress,
         'officeZip'       => $officeZip,
      ]);

      //json output
      $idArray = array(
         'status'       => 'success',
         'modAgtPhone'  => $agtMainPhone
      );

      echo json_encode($idArray);

   }

   public function agtSaveClick(Request $request){

      $umid=Auth::user()->id;

      $validator = Validator::make($request::all(), [
         'agtFirst'        => 'required|alpha_dash',
         'agtLast'         => 'required|alpha_dash',
         'agtMainPhone'    => 'min:10|max:15',
         'agtEmail'        => 'required|email',
         'agtWeb'          => 'activeURL',
         'officeName'      => 'required',
         'officeAddress'   => 'required',
         'officeCity'      => 'required',
         'officeState'     => 'required',
         'officeZip'       => 'required',
      ]);

      if($validator->passes()){

         $agtFirst=$request::input('agtFirst');
         $agtLast=$request::input('agtLast');
         $agtFullName=$agtFirst.' '.$agtLast;
         $agtDesigs=$request::input('agtDesigs');
         $agtMainPhone=$request::input('agtMainPhone');
         $agtWeb=$request::input('agtWeb');
         $agtEmail=$request::input('agtEmail');
         $officeName=$request::input('officeName');
         $officeAddress=$request::input('officeAddress');
         $officeCity=$request::input('officeCity');
         $officeState=$request::input('officeState');
         $officeZip=$request::input('officeZip');

         propagent::where('id','=',"$umid")
         ->update([
            'agtFirst'           => $agtFirst,
            'agtLast'            => $agtLast,
            'agtFullName'        => $agtFullName,
            'agtDesigs'          => $agtDesigs,
            'agtMainPhone'       => $agtMainPhone,
            'agtWeb'             => $agtWeb,
            'agtEmail'           => $agtEmail,
            'trialAgtApproved'   => 1
         ]);

         agtoffice::where('propagent_id','=',"$umid")
         ->update([
            'officeName'      => $officeName,
            'officeAddress'   => $officeAddress,
            'officeCity'      => $officeCity,
            'officeState'     => $officeState,
            'officeAddress'   => $officeAddress,
            'officeZip'       => $officeZip,
         ]);

         // json output
         $idArray = array(
            'status'=> 'success',
         );

         echo json_encode($idArray);

      }else{

         return response()->json([
            'error'=>$validator->errors()->all()
         ]);

      }

   }

   public function propHighlights(Request $request, $id){

      $umid=Auth::user()->id;

      $xb1=$request::input('xb1');
      $xb2=$request::input('xb2');
      $xb3=$request::input('xb3');
      $xb4=$request::input('xb4');
      $xb5=$request::input('xb5');
      $xb6=$request::input('xb6');
      $xb7=$request::input('xb7');
      $xb8=$request::input('xb8');

      propremark::where('propflyer_id','=',"$id")
      ->where('propagent_id','=',"$umid")
      ->update([
         'xb1'=>$xb1,
         'xb2'=>$xb2,
         'xb3'=>$xb3,
         'xb4'=>$xb4,
         'xb5'=>$xb5,
         'xb6'=>$xb6,
         'xb7'=>$xb7,
         'xb8'=>$xb8,
      ]);

   }

   public function formBlocks(Request $request, $id){

      $umid=Auth::user()->id;

      $validator = Validator::make($request::all(), [
         'xListPrice'        => 'required|integer',
         'xMlsNum'           => 'nullable|numeric',
         'xFullStreet'       => 'Required',
         'xCity'             => 'Required',
         'xState'            => 'Required',
         'xZip'              => 'Required|digits:5',
         'xCountyName'       => 'Required',
         'xBeds'             => 'Required|numeric',
         'xBaths'            => 'Required|numeric',
         'xSqft'             => 'Required|numeric',
         'xYrBuilt'          => 'Required|numeric|between:1500,3000',
         'xPoolPvt'          => 'Required|not_in:Select',
         'xParking'          => 'Required|not_in:Select',
         'xPubRemarks'       => 'Required',
      ]);

      if($validator->passes()){

         //form Variables
         $xListPrice    = request::input('xListPrice');
         $xMlsNum       = request::input('xMlsNum');
         $xFullStreet   = request::input('xFullStreet');
         $xCity         = request::input('xCity');
         $xState        = request::input('xState');
         $xZip          = request::input('xZip');
         $xCountyName   = request::input('xCountyName');
         $xBeds         = request::input('xBeds');
         $xBaths        = request::input('xBaths');
         $xYrBuilt      = request::input('xYrBuilt');
         $xSqft         = request::input('xSqft');
         $xPoolPvt      = request::input('xPoolPvt');
         $xParking      = request::input('xParking');
         $xPubRemarks   = request::input('xPubRemarks');
         $xb1           = request::input('xb1');
         $xb2           = request::input('xb2');
         $xb3           = request::input('xb3');
         $xb4           = request::input('xb4');
         $xb5           = request::input('xb5');
         $xb6           = request::input('xb6');
         $xb7           = request::input('xb7');
         $xb8           = request::input('xb8');

         propflyer::where('id','=',"$id")
         ->where('propagent_id','=',"$umid")
         ->update([
            'xListPrice'   => $xListPrice,
            'xMlsNum'      => $xMlsNum,
            'xFullStreet'  => $xFullStreet,
            'xCity'        => $xCity,
            'xState'       => $xState,
            'xZip'         => $xZip,
            'xCountyName'  => $xCountyName,
            'xBeds'        => $xBeds,
            'xBaths'       => $xBaths,
            'xSqft'        => $xSqft,
            'xYrBuilt'     => $xYrBuilt,
            'xPoolPvt'     => $xPoolPvt,
            'xParking'     => $xParking
         ]);

         propremark::where('propflyer_id','=',"$id")
         ->where('propagent_id','=',"$umid")
         ->update([
            'xPubRemarks'  => $xPubRemarks,
            'xb1'          => $xb1,
            'xb2'          => $xb2,
            'xb3'          => $xb3,
            'xb4'          => $xb4,
            'xb5'          => $xb5,
            'xb6'          => $xb6,
            'xb7'          => $xb7,
            'xb8'          => $xb8,
         ]);

         // json output
         $idArray = array(
            'status'=> 'success',
         );

         echo json_encode($idArray);

      }else{

         return response()->json([
            'error'=>$validator->errors()->all()
         ]);

      }

   }

   public function jqHeadlineSave($id){

      $umid=Auth::user()->id;

      $graphic_style = request::input('graphic_style');
      $graphic_words = request::input('graphic_words');
      $xHeadline     = request::input('xHeadline');

      propstyle::where('propflyer_id','=',"$id")
      ->where('propagent_id','=',"$umid")
      ->update([
         'graphic_style'   => $graphic_style,
         'graphic_words'   => $graphic_words,
      ]);

      propflyer::where('id','=',"$id")
      ->where('propagent_id','=',"$umid")
      ->update([
         'xHeadline' => $xHeadline
      ]);

      $idArray = array(
         'graphic_style'   => $graphic_style,
         'graphic_words'   => $graphic_words,
         'xHeadline'       => $xHeadline
      );

      echo json_encode($idArray);

   }

   public function jqHeadlineClick($id){

      // think about changing headline_chosen (etc.)
      // to timestamp instead of boolean?

      $umid=Auth::user()->id;

      $graphic_style = request::input('graphic_style');
      $graphic_words = request::input('graphic_words');
      $xHeadline     = request::input('xHeadline');

      propstyle::where('propflyer_id','=',"$id")
      ->where('propagent_id','=',"$umid")
      ->update([
         'graphic_style'   => $graphic_style,
         'graphic_words'   => $graphic_words,
         'headline_chosen' => 1,
      ]);

      propflyer::where('id','=',"$id")
      ->where('propagent_id','=',"$umid")
      ->update([
         'xHeadline' => $xHeadline
      ]);

   }

}
