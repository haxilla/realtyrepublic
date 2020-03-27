<?php

namespace App\Http\Controllers\mdbxMember;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use App\models\core\propagent;
use App\models\core\propphoto;
use App\models\core\propmeta;

class mdbxFlyerPhotoController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:member');
   }

   public function photoFunctions(){

      include(app_path().'/flyerVariables/existingFlyerCheck.php');
      include(app_path().'/accountVariables/accountInfo.php');

      $getPhotos=propphoto::select('photoID','photoName','orient','ord','propflyer_id')
      ->where('propflyer_id','=',"$idFly")
      ->where('propagent_id','=',"$umid")
      ->where('resized','=','500')
      ->orderBy('ord');

      $allPhotos  = clone $getPhotos;
      $defPhoto   = clone $getPhotos;

      $allPhotos=$allPhotos
      ->get();

      $defPhoto=$defPhoto->where('def','=','1')
      ->first();

      $getMetas=propmeta::select('zipDir','mlsDir')
      ->where('propflyer_id','=',"$idFly")
      ->where('propagent_id','=',"$umid")
      ->first();

      $defPhotoName=$defPhoto['photoName'];
      $zipDir=$getMetas['zipDir'];
      $mlsDir=$getMetas['mlsDir'];

      include(app_path().'/flyerVariables/mdbxfromURL.php');

      return view('mdbxMember.fullPages.mdbxPhotoFunctions',[
         'accountInfo'           => $accountInfo,
         'activeCampaigns'       => $activeCampaigns,
         'completeCampaigns'     => $completeCampaigns,
         'allPhotos'             => $allPhotos,
         'zipDir'                => $zipDir,
         'mlsDir'                => $mlsDir,
         'id'                    => $id,
      ]);

   }

   public function addFlyerPhotos(){

      include(app_path().'/flyerVariables/existingFlyerCheck.php');
      //query
      $propMetas=propmeta::select('zipDir','mlsDir')
      ->where('propflyer_id','=',"$idFly")
      ->where('propagent_id','=',"$umid")
      ->first();
      //set vars
      $zipDir=$propMetas['zipDir'];
      $mlsDir=$propMetas['mlsDir'];
      //error if none
      if(!$zipDir||!$mlsDir){
         dd('line70-error-mdbxPhotoController');}
      //vars above needed or include wont run
      include(app_path().'/members/functions/addFlyerPhotos.php');
   }

   public function resizeFlyerPhotos(){
      //security check
      include(app_path().'/flyerVariables/existingFlyerCheck.php');
      //resize function
      include(app_path().'/functions/imageControl/flyerPhotosResizeFunction.php');
      //redirect
      return \Redirect::route("member.photoFunctions", ['id'=>$id])
      ->with('message', "Photos Added");
   }

   public function flyerPhotoSortOrder(){
      $i = 1;
      foreach ($_POST['item'] as $value) {

         if($i==1){
            $def=1;
         }else{
            $def=0;
         }

         propphoto::where('photoID','=',"$value")
         ->update([
            'ord' => $i,
            'def' => $def
         ]);

         //increment
         $i++;
      }
   }

   public function deleteFlyerPhoto(){
      //getPhotoID
      $photoID = request('photoID');
      $umid    = Auth::guard('member')->user()->id;
      if(!$photoID||!$umid){
         dd('error-line111-mdbxPhotoController');}

      //query for oldFileName
      $thePhoto=propphoto::select('oldFileName','photoID','photoName')
      ->where('photoID','=',"$photoID")
      ->where('propagent_id','=',"$umid")
      ->first();
      //error if none
      if(!$thePhoto){
         dd('error-line119-mdbxFlyerPhotoController.php');}

      $theOldFileName=$thePhoto['oldFileName'];

      $oldFileNames=propphoto::select('photoID','photoName','propflyer_id')
      ->where('oldFileName','=',"$theOldFileName")
      ->with(['theMeta'=>function($q){
         $q->select('propflyer_id','zipDir','mlsDir');
      }])
      ->get();

      //loop & delete all
      foreach($oldFileNames as $the){
         //set dirs
         $zipDir=$the->theMeta->zipDir;
         $mlsDir=$the->theMeta->mlsDir;
         //error if none
         if(!$zipDir||!$mlsDir){
            dd('error-line137-mdbxFlyerPhotoController');}

         //build filename
         $filename="hqphotos/$zipDir/$mlsDir/$the->photoName";
         $oFilename="hqphotos/$zipDir/$mlsDir/original/$the->photoName";
         //delete file from server
         @unlink($filename);               
         @unlink($oFilename);

         //delete database record
         propphoto::destroy($the->photoID);}

      return back()->with('message','Photo Deleted!');

   }
}
