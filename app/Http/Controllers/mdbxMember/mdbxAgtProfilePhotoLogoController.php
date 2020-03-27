<?php

namespace App\Http\Controllers\mdbxMember;
use App\Http\Controllers\Controller;

use Auth;
use Illuminate\Http\Request;
use App\models\core\propagent;

class mdbxAgtProfilePhotoLogoController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:web');
   }

   public function changeAgtPhotoPost(){
      //get flyer id (if any)
      $id=request('id');
      //logged in user
      $umid=Auth::user()->id;
      //error if none
      if(!$umid){
         dd('error-line25-mdbxPhotoLogoController');}
      //get record
      $getAgent=propagent::select('accountType','officeID','agtReview')
      ->where('id','=',"$umid")
      ->first();
      //error if none
      if(!$getAgent){
         dd('error-line27-mdbxAgtProfilePhotoLogoController');}
      //check review status
      $agtReview=$getAgent['agtReview'];
      //photo upload code
      include(app_path() . '/members/profile/agtPhotoUpdate.php');

      if($id){
         return \Redirect::route("member.flyerEdit", ['id'=>$id])
         ->with('message', "Agent Photo Changed!");
      }elseif($agtReview !==1){
         return \Redirect::route("member.editAgent")
         ->with('message', "Agent Photo Changed!");
      }else{
         return \Redirect::route("member.login")
         ->with('message', "Agent Photo Changed!");
      }

   }

   public function changeAgtLogoPost(){

      $id=request('id');
      $umid=Auth::user()->id;

      $getAgent=propagent::select(
         'officeID','agtReview')
      ->where('id','=',"$umid")
      ->first();

      $officeID=$getAgent['officeID'];
      $agtReview=$getAgent['agtReview'];

      if(!$umid||!$officeID){
         dd('error-line50-mdbxPhotoLogoController');}

      include(app_path() . '/members/profile/agtLogoUpdate.php');

      if($id){
         return \Redirect::route("member.editAgent", ['id'=>$id])
         ->with('message', "Agent Logo Changed!");
      }elseif($agtReview !== 1){
         return \Redirect::route("member.editAgent")
         ->with('message', "Agent Logo Changed!");
      }else{
         return \Redirect::route("member.login")
         ->with('message', "Agent Logo Changed!");
      }
   }

   public function deleteAgtPhoto(){

      $umid=Auth::user()->id;
      $id=request('id');

      //security check
      if(!$umid){
      dd('error-line84-mdbxPhotoLogoController');}

      //only clears database
      //not currently deleting images
      propagent::where('id','=',"$umid")
      ->update([
         'agtPhoto'=>null
      ]);

      $getAgent=propagent::select('agtReview','accountType')
      ->where('id','=',"$umid")
      ->first();

      $agtReview=$getAgent['agtReview'];

      if($id){
         return \Redirect::route("member.editAgent", ['idFly'=>$id])
         ->with('message', "Agent Photo Deleted");
      }elseif($agtReview!==1){
         return \Redirect::route("member.editAgent")
         ->with('message', "Agent Photo Deleted");
      }else{
         return \Redirect::route("member.login")
         ->with('message', "Agent Photo Deleted");
      }

   }

   public function deleteAgtLogo(){
      $umid=Auth::user()->id;
      $id=request('id');

      //security check
      if(!$umid){
      dd('error-line118-mdbxPhotoLogoController');}
      //only clears database
      //not currently deleting images
      propagent::where('id','=',"$umid")
      ->update([
         'agtLogo'=>null
      ]);

      $getAgent=propagent::select('agtReview')
      ->where('id','=',"$umid")
      ->first();

      $agtReview=$getAgent['agtReview'];

      if($id){
         return \Redirect::route("member.editAgent", ['id'=>$id])
         ->with('message', "Agent Logo Deleted");
      }elseif($agtReview !== 1){
         return \Redirect::route("member.editAgent")
         ->with('message', "Agent Logo Deleted");
      }else{
         return \Redirect::route("member.login")
         ->with('message', "Agent Logo Deleted");
      }
   }
}
