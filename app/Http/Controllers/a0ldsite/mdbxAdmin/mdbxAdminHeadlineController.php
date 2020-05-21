<?php

namespace App\Http\Controllers\mdbxAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\core\propstyle;
use App\models\core\propflyer;


class mdbxAdminHeadlineController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function saveHeadline(){

      $idFly=request('idFly');
      $theHeadline=request('theHeadline');

      //security stop
      if(!$idFly){
         dd('error-line61-mdbxAjaxController');}

      $propCheck=propflyer::where('id','=',"$idFly")
      ->first();

      if($propCheck){
         propflyer::where('id','=',"$idFly")
         ->update([
            'xHeadline'=>$theHeadline
         ]);}

      //json output
      $idArray = array(
         'status'       => 'success',
         'theHeadline'  => $theHeadline,
         'idFly'        => $idFly,);

      echo json_encode($idArray);

   }

   public function hlCaption(){
      //set vars
      $idFly=request('idFly');
      $hlCaption=request('graphic_words');
      $hlStyle=request('graphic_style');
      $hlColor=request('theColor');

      $check=propstyle::where('propflyer_id','=',"$idFly")
      ->first();

      if(!$check){
         dd('error-line65-mdbxAjaxController');}

      propstyle::where('propflyer_id','=',"$idFly")
      ->update([
         'graphic_words'=>$hlCaption,
         'graphic_style'=>$hlStyle,
      ]);

      //json output
      $idArray = array(
         'status'       => 'success',
         'idFly'        => $idFly,
         'hlCaption'    => $hlCaption,
         'hlColor'      => $hlColor,
         'hlStyle'      => $hlStyle,
      );

      echo json_encode($idArray);
   }

}
