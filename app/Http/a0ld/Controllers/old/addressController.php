<?php

namespace App\Http\Controllers;

use Validator;
use Request;
use Redirect;
use Auth;
use App\propflyer;
use App\propmeta;
use App\propremark;

class addressController extends Controller
{

   public function __construct()
   {
      $this->middleware('auth:web');
   }

   public static function checkAddress(){

      //runs smarty streets via ajax
      include(app_path() . '/sstr/checkRec.php');

   }

   public function showNewRecord($id){

      //if its numeric its a record
      if(is_numeric($id)){

         //safety check userID vs propagentID
         $umid=Auth::user()->id;

         $propInfo=propflyer::where('id','=',"$id")
         ->where('propagent_id','=',"$umid")
         ->first();

         //no record = error
         if(!$propInfo){
            dd('error accessing this record-line37addressController');
         }

         $propMetas=propmeta::where('propflyer_id','=',"$id")
         ->where('propagent_id','=',"$umid")
         ->first();

         $propRemarks=propremark::where('propflyer_id','=',"$id")
         ->where('propagent_id','=',"$umid")
         ->first();

         include(app_path() . '/functions/textCreationLogic.php');

         $otherFlyers=propflyer::select(
           'agtFullName','mlsDir','zipDir','xFullStreet','photoName',
           'officeID','agtPhoto','agtLogo','startDate','xListPrice',
           'xxBeds','xxBaths','xxSqft','xCity','xState','xxZip')
         ->leftJoin('propflyerstats',
           'propflyerstats.propflyer_id','=','propflyers.id')
         ->leftJoin('propphotos',
           'propphotos.propflyer_id','=','propflyers.id')
         ->leftJoin('propmetas',
           'propmetas.propflyer_id','=','propflyers.id')
         ->leftJoin('propagents',
           'propagents.id','=','propflyers.propagent_id')
         ->whereNotNull('xAgtSent')
         ->where('resized','=','500')
         ->where('def','=','1')
         ->where('orient','=','wide')
         ->orderBy('creationDate','desc')
         ->get()
         ->take(10);

         return view('members.create.newRecordForm',[
            'propInfo'        => $propInfo,
            'otherFlyers'     => $otherFlyers,
            'getMLS'          => $getMLS,
            'getListPrice'    => $getListPrice,
            'getAddress'      => $getAddress,
            'getRemarks'      => $getRemarks,
            'getHighlights'   => $getHighlights,
            'submitID'        => $submitID,
            'formID'          => $formID,
            'propRemarks'     => $propRemarks
         ]);
      }

      // non-numeric = error
      // create process to insert record manually
      dd('error displaying this record - line92addressController');

   }

   public function updateNewRecord(Request $request, $id){

      //userID
      $umid=Auth::user()->id;

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

      //hidden fields
      $fStreet          = request::input('fStreet');
      $fMlsNum          = request::input('fMlsNum');
      $fDetails         = request::input('fDetails');
      $fPrice           = request::input('fPrice');
      $fPubRemarks      = request::input('fPubRemarks');
      $fPubHighlights   = request::input('fPubHighlights');

      //Street Address
      if($fStreet==1){

         $validator = Validator::make($request::all(), [
            'xFullStreet'     => 'Required',
            'xCity'           => 'Required',
            'xState'          => 'Required',
            'xZip'            => 'Required|numeric',
            'xCountyName'     => 'Required',
         ]);

         if ($validator->passes()) {

            propflyer::where('id','=',"$id")
            ->where('propagent_id','=',"$umid")
            ->update([
               'xFullStreet'  => $xFullStreet,
               'xCity'        => $xCity,
               'xState'       => $xState,
               'xZip'         => $xZip,
               'xCountyName'  => $xCountyName
            ]);

            propmeta::where('propflyer_id','=',"$id")
            ->where('propagent_id','=',"$umid")
            ->update([
               'addressConfirmed'=>\Carbon\Carbon::now()
            ]);

            return back();

         }

         //if here validator failed
         //back to form with errors
         return back()
         ->withErrors($validator);

      }// end of if fStreet

      //mlsNum
      if($fMlsNum==1){

         $validator = Validator::make($request::all(), [
            'xMlsNum'         => 'Required|numeric',
         ]);

         //if validator passes
         if ($validator->passes()) {

            propflyer::where('id','=',"$id")
            ->where('propagent_id','=',"$umid")
            ->update([
               'xMlsNum'   => $xMlsNum,
            ]);

            propmeta::where('propflyer_id','=',"$id")
            ->where('propagent_id','=',"$umid")
            ->update([
               'mlsConfirmed' =>\Carbon\Carbon::now(),
               'mlsDir'       => $xMlsNum
            ]);

            return back();

         }

         //if here validator failed
         //back to form with errors
         return back()
         ->withErrors($validator);

      }//end of fListPrice

      //listPrice
      if($fPrice==1){

         $validator = Validator::make($request::all(), [
            'xListPrice'   => 'Required|numeric',
            'xBeds'        => 'Required|numeric',
            'xBaths'       => 'Required|numeric',
            'xSqft'        => 'Required|numeric',
            'xYrBuilt'     => 'Required|numeric|between:1500,3000',
            'xPoolPvt'     => 'Required|not_in:Select',
            'xParking'     => 'Required|not_in:Select',
         ]);

         //if validator passes
         if ($validator->passes()) {

            propflyer::where('id','=',"$id")
            ->where('propagent_id','=',"$umid")
            ->update([
               'xListPrice'   => $xListPrice,
               'xBeds'        => $xBeds,
               'xBaths'       => $xBaths,
               'xSqft'        => $xSqft,
               'xYrBuilt'     => $xYrBuilt,
               'xPoolPvt'     => $xPoolPvt,
               'xParking'     => $xParking
            ]);

            propmeta::where('propflyer_id','=',"$id")
            ->where('propagent_id','=',"$umid")
            ->update([
               'listPriceConfirmed' =>\Carbon\Carbon::now()
            ]);

            return back();

         }

         //if here validator failed
         //back to form with errors
         return redirect()->back()
         ->withInput($request::all())
         ->withErrors($validator);

      }//end of fListPrice

      if($fPubRemarks==1){

         $validator = Validator::make($request::all(), [
            'xPubRemarks'        => 'Required',
         ]);

         if ($validator->passes()) {

            propremark::where('propflyer_id','=',"$id")
            ->where('propagent_id','=',"$umid")
            ->update([
               'xPubRemarks'=>$xPubRemarks
            ]);

            propmeta::where('propflyer_id','=',"$id")
            ->where('propagent_id','=',"$umid")
            ->update([
               'remarksConfirmed'=>\Carbon\carbon::now()
            ]);

            return back();

         }//end of if Validator Passes

         //if here validator failed
         //back to form with errors
         return redirect()->back()
         ->withInput($request::all())
         ->withErrors($validator);

      }//end of if pub Remarks

      if($fPubHighlights==1){
         dd($id);
      }

   }//end of update function

   public function highlightsComplete(Request $request, $id){

      //userID
      $umid=Auth::user()->id;

      propmeta::where('propflyer_id','=',"$id")
      ->where('propagent_id','=',"$umid")
      ->update([
         'highlightsConfirmed'=>\Carbon\Carbon::now()
      ]);

      //send values and exit
      $idArray = array(
         "status"      => 'complete',
         "idFly"       => $id
      );

      echo json_encode($idArray);
      exit();

   }

}
