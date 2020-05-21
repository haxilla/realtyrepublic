<?php

namespace App\Http\Controllers\mdbxMember;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use App\models\core\propphoto;
use App\models\core\propmeta;

class omdbxFlyerPhotoController1 extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:web');
   }

   public function photoFunctions(){

      include(app_path().'/functions/flyerVariables/existingFlyerCheck.php');

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

      include(app_path().'/functions/flyerVariables/mdbxfromURL.php');

      return view('mdbxMember.fullPages.mdbxPhotoFunctions',[
         'allPhotos'    => $allPhotos,
         'zipDir'       => $zipDir,
         'mlsDir'       => $mlsDir,
         'id'           => $id,
      ]);

   }

   public function addFlyerPhotos(){

      include(app_path().'/functions/flyerVariables/existingFlyerCheck.php');
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
      include(app_path().'/functions/imageControl/addFlyerPhotos.php');
   }

   public function resizeFlyerPhotos(){
      //security check
      include(app_path().'/functions/flyerVariables/existingFlyerCheck.php');
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
      $umid    = Auth::guard('web')->user()->id;
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
         //delete file from server
         @unlink($filename);
         //delete database record
         propphoto::destroy($the->photoID);}

      return back()->with('message','Photo Deleted!');
      /*
      //have to find all matching sizes
      $propPhoto=propphoto::select('photoName')
      ->where('photoID','=',"$photoID")
      ->where('propagent_id','=',"$umid")
      ->where('propflyer_id','=',"$idFly")
      ->first();
      //error if none
      if(!$propPhoto['photoName']){
         dd('error-line122-mdbxFlyerPhotoController');}

      $photoName=$propPhoto['photoName'];
      // removes prefix (first 6 characters)
      // to get original photoname
      $oPhotoName=substr($photoName,6);

      $propMetas=propmeta::select('zipDir','mlsDir')
      ->where('propflyer_id','=',"$idFly")
      ->where('propagent_id','=',"$umid")
      ->first();

      $zipDir=$propMetas['zipDir'];
      $mlsDir=$propMetas['mlsDir'];

      if(!$zipDir||!$mlsDir){
         dd('error-line163-mdbxPhotoController');}

      $filename="hqphotos/$zipDir/$mlsDir/$photoName";
      $ofilename="hqphotos/$zipDir/$mlsDir/$oPhotoName";

      if(file_exists($filename)){
         unlink($filename);
      }
      if(file_exists($ofilename)){
         unlink($ofilename);
      }

      propphoto::where('photoID','=',"$photoID")
      ->where('propflyer_id','=',"$idFly")
      ->where('propagent_id','=',"$umid")
      ->delete();

      propphoto::where('photoName','=',"$oPhotoName")
      ->where('propflyer_id','=',"$idFly")
      ->where('propagent_id','=',"$umid")
      ->delete();

      return \Redirect::route("mdbxPhotoFunctions", ['idFly'=>$idFly])
      ->with('message', "Photo Deleted!");
      */

   }
}
