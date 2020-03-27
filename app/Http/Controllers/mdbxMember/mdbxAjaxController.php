<?php

namespace App\Http\Controllers\mdbxMember;
use App\Http\Controllers\Controller;

use Auth;
use Request;
use App\models\core\propflyer;
use App\models\core\propstyle;
use App\models\core\tempflyer;

class mdbxAjaxController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:member');
   }

   public function chooseFlyerStyle(){
      //security check
      include(app_path().'/flyerVariables/existingFlyerCheck.php');
      //get template
      $theTemplate=request('theTemplate');
      //security stop
      if(!$theTemplate){
         dd('error-line19-mdbxAjaxController');}

      $propCheck=propflyer::select('id')
      ->where('id','=',"$idFly")
      ->where('propagent_id','=',"$umid")
      ->with(['thePhotos'=>function($q){
         $q->select('propflyer_id')
            ->where('resized','=','500');
      }])
      ->first();
      if(!$propCheck){
         dd('error-line37-mdbxAjaxController');}

      //get photocount
      $photoCount=$propCheck->thePhotos->count();
      //to disallow saving as template that doesnt work with photoCount
      @include(app_path.'/flyerVariables/photoCountCheck.php');
      //update propstyle
      propstyle::where('propflyer_id','=',"$idFly")
      ->where('propagent_id','=',"$umid")
      ->update([
         'template'=>$theTemplate,
         'template_chosen'=>1
      ]);

      //json output
      $idArray = array(
         'status'       => 'success',
         'template'     => $theTemplate,
      );

      echo json_encode($idArray);
   }

   public function chooseFlyerHeadline(){
      //security check
      include(app_path().'/flyerVariables/existingFlyerCheck.php');

      $propCheck=propflyer::where('id','=',"$idFly")
      ->where('propagent_id','=',"$umid")
      ->first();
      if(!$propCheck){
         dd('error-line58-mdbxAjaxController');}

      propstyle::where('propflyer_id','=',"$idFly")
      ->where('propagent_id','=',"$umid")
      ->update([
         'headline_chosen'=>1,
      ]);

      //json output
      $idArray = array(
         'status'             => 'success',
         'headline_chosen'    => 1,
      );

      echo json_encode($idArray);
   }

   public function chooseFlyerColor(){
      //security check
      include(app_path().'/flyerVariables/existingFlyerCheck.php');

      $propCheck=propflyer::where('id','=',"$idFly")
      ->where('propagent_id','=',"$umid")
      ->first();
      if(!$propCheck){
         dd('error-line32-mdbxAjaxController');}

      propstyle::where('propflyer_id','=',"$idFly")
      ->where('propagent_id','=',"$umid")
      ->update([
         'colors_chosen'=>1
      ]);

      //json output
      $idArray = array(
         'status'          => 'success',
         'colors_chosen'   => 1,
      );

      echo json_encode($idArray);
      exit();
   }

   public function chooseVirtualTour(Request $request){
      //security
      include(app_path().'/flyerVariables/existingFlyerCheck.php');
      //set variables
      $xVirtualTour=request('xVirtualTour');
      //validate as URL
      $validator = \Validator::make($request::all(), [
         'xVirtualTour' => 'nullable|url',
      ]);
      //if it fails notify user
      if(!$validator->passes()){
         //json output
         $idArray = array(
            'status'          => 'fail',
            'reason'          => 'badLink',
            'xVirtualTour'    => $xVirtualTour,
         );
         echo json_encode($idArray);
         exit();
      }

      //save to database
      propflyer::where('id','=',"$idFly")
      ->update([
         'xVirtualTour' => $xVirtualTour,
      ]);

      propstyle::where('propflyer_id','=',"$idFly")
      ->update([
         'virtualTour_chosen'=>1
      ]);

      //json output
      $idArray = array(
         'status'             => 'success',
         'reason'             => 'virtualTour',
         'virtualTourLink'    => $xVirtualTour,
      );

      echo json_encode($idArray);
      exit();
   }

   public function chooseMlsLink(Request $request){
      //security
      include(app_path().'/flyerVariables/existingFlyerCheck.php');
      //set variables
      $xMlsLink=request('xMlsLink');
      //validate as URL
      $validator = \Validator::make($request::all(), [
         'xMlsLink' => 'nullable|url',
      ]);
      //if it fails notify user
      if(!$validator->passes()){
         //json output
         $idArray = array(
            'status'          => 'fail',
            'reason'          => 'badLink',
            'xMlsLink'        => $xMlsLink,
         );
         echo json_encode($idArray);
         exit();
      }

      //save to database
      propflyer::where('id','=',"$idFly")
      ->update([
         'xMlsLink' => $xMlsLink,
      ]);

      propstyle::where('propflyer_id','=',"$idFly")
      ->update([
         'mlsLink_chosen'=>1
      ]);

      //json output
      $idArray = array(
         'status'             => 'success',
         'reason'             => 'virtualTour',
         'xMlsLink'           => $xMlsLink,
      );

      echo json_encode($idArray);
      exit();
   }

   public function mdbxHLCaption(){
      //security
      include(app_path().'/flyerVariables/existingFlyerCheck.php');
      //set variables
      $hlCaption=request('graphic_words');
      $hlStyle=request('graphic_style');
      $hlColor=request('theColor');

      $check=propstyle::where('propflyer_id','=',"$idFly")
      ->where('propagent_id','=',"$umid")
      ->first();

      if(!$check){
         dd('error-line65-mdbxAjaxController');}

      propstyle::where('propflyer_id','=',"$idFly")
      ->where('propagent_id','=',"$umid")
      ->update([
         'graphic_words'=>$hlCaption,
         'graphic_style'=>$hlStyle,
      ]);

      //json output
      $idArray = array(
         'status'       => 'success',
         'hlCaption'    => $hlCaption,
         'hlColor'      => $hlColor,
         'hlStyle'      => $hlStyle,
      );

      echo json_encode($idArray);

   }

   public function autoSaveHeadline(){
      //takes id from url & returns idFly
      include(app_path().'/flyerVariables/existingFlyerCheck.php');
      //get Headline from url
      $theHeadline=request('theHeadline');
      //check it exist
      $propCheck=propflyer::where('id','=',"$idFly")
      ->where('propagent_id','=',"$umid")
      ->first();
      //if none, error
      if(!$propCheck){
         dd('error-line101-mdbxAjaxController');}
      //update
      propflyer::where('propagent_id','=',"$umid")
      ->where('id','=',"$idFly")
      ->update([
         'xHeadline'=>$theHeadline
      ]);
      //json output
      $idArray = array(
         'status'       => 'success',
         'theHeadline'  => $theHeadline,
         'idFly'        => $idFly,
      );

      echo json_encode($idArray);
   }

}
