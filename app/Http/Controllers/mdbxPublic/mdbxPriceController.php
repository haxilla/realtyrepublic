<?php

namespace App\Http\Controllers\mdbxPublic;
use App\Http\Controllers\Controller;

use App\models\distro\aznaz;
use App\models\distro\azphxmetro;
use App\models\distro\azphxne;
use App\models\distro\azphxse;
use App\models\distro\azphxwv;
use App\models\distro\azsaz;

class mdbxPriceController extends Controller
{

  //Master List
  public function pricing(){
    return view('mdbxPublic.fullPages.pricing');
  }


  //**********************************//
  //           ARIZONA                //
  //**********************************//
  public function azpricing(){
    $dup      = request('dup');
    $theEmail = request('theEmail');

    return view('mdbxPublic.fullPages.azprice',
    [
      'dup'         =>$dup,
      'theEmail'    =>$theEmail
    ]);
 }
   //**********************************//
   //           NEVADA                 //
   //**********************************//
   public static function nvpricing (){
      //  this is so if it is redirected back
      //  as duplicate it forces a login to
      //  to existing account
      $dup=request('dup');
      $theEmail=request('theEmail');

      return view('mdbxPublic.fullPages.nvprice',[
        'dup'=>$dup,
        'theEmail'=>$theEmail,
      ]);
   }

}
