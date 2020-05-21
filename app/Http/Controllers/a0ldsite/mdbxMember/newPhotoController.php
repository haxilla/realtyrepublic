<?php

namespace App\Http\Controllers\mdbxMember;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\models\core\propmeta;

class newPhotoController extends Controller
{

   public function __construct()
   {
      $this->middleware('auth:web');
   }

   public function newPhotoUpload(){
      include(app_path() . '/members/newFlyer/newPhotoUpload.php');
   }

   public function newPhotoResize(){
      //Security Logic & assign idFly
      include(app_path() . '/members/newFlyer/securityCheck.php');
      //find photos that need resizing and do it
      include(app_path() . '/functions/imageControl/flyerPhotosResizeFunction.php');
      //set sk1
      $sk1=propmeta::where('propflyer_id','=',"$idFly")
      ->pluck('sk1')
      ->first();
      //error if none
      if(!$sk1){
         dd('error-line31-memberDropZoneNewPhotoController');}

      //redirect to edit
      return \Redirect::route('member.flyerEdit',[
         'id'=>$sk1,
      ]);

   }

}
