<?php

namespace App\Http\Controllers\mdbxAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\core\propstyle;

class mdbxAdminStyleController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function store($style,$id){

      $checkStyle=propstyle::select('template')
      ->where('propflyer_id','=',"$id")
      ->first();

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

   public function saveStyle(){

      $idFly=request('idFly');
      $theTemplate=request('theTemplate');

      if(!$idFly||!$theTemplate){
         dd('error-line67-mdbxAdminStyleController');}

      propstyle::where('propflyer_id','=',"$idFly")
      ->update([
         'template'=>$theTemplate,
      ]);

      //json output
      $idArray = array(
         'status'       => 'success',
         'template'     => $theTemplate
      );

      echo json_encode($idArray);
      exit();
   }

}
