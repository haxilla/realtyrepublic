<?php

namespace App\Http\Controllers;
use Auth;
use App\propstyle;

use Illuminate\Http\Request;

class mmStyleController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:web');
   }

   public function chooseStyle($style,$id){
      $umid=Auth::user()->id;

      $checkStyle=propstyle::select('template')
      ->where('propagent_id','=',"$umid")
      ->where('propflyer_id','=',"$id")
      ->first();

      if(!$checkStyle){
         dd('errorline25-mmStyleController');
      }

      //if unsupported value
      if($style=='1'){
         $newTemplate='s1pc';
      }elseif($style=='2'){
         $newTemplate='s2pb';
      }elseif($style=='3'){
         $newTemplate='s3pt';
      }elseif($style=='4'){
         $newTemplate='s4sp';
      }elseif($style=='5'){
         $newTemplate='s5pt';
      }else{

         //json output
         $idArray = array(
            'status'       => 'fail',
            'template'     => 'error',
         );

         echo json_encode($idArray);
         exit();

      }

      propstyle::where('propflyer_id','=',"$id")
      ->where('propagent_id','=',"$umid")
      ->update([
         'template_chosen' => '1',
         'template'        => $newTemplate
      ]);

      //json output
      $idArray = array(
         'status'       => 'success',
         'template'     => $newTemplate
      );

      echo json_encode($idArray);
      exit();

   }

   public function changeStyle($template,$id){

      //must exist and belong to logged in user
      $umid=Auth::user()->id;

      $checkStyle=propstyle::select('template')
      ->where('propagent_id','=',"$umid")
      ->where('propflyer_id','=',"$id")
      ->first();

      //if no style Create Entry
      if(!$checkStyle){
         dd('error line 29 mmStyleController');
      }

      if($template=='1'){
         $newTemplate='s1pc';
      }elseif($template=='2'){
         $newTemplate='s2pb';
      }elseif($template=='3'){
         $newTemplate='s3pt';
      }elseif($template=='4'){
         $newTemplate='s4sp';
      }elseif($template=='5'){
         $newTemplate='s5pt';
      }else{
         dd('error line 41 mmStyleController');
      }

      propstyle::where('propflyer_id','=',"$id")
      ->update([
         'template'=>$newTemplate
      ]);

      return redirect()->back();
   }
}
