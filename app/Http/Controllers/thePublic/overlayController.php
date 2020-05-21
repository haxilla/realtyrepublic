<?php

namespace App\Http\Controllers\thePublic;
use App\Http\Controllers\Controller;

class overlayController extends Controller
{


  public function agentWall(){
    //get var
    $ajid=request('ajid');
    //error if none
    if(!$ajid){
      dd('error-line14-thePublic/overlayController');}

    //query
    include(app_path().'/members/queries/agentWall.php');

    $html=\View::make('mdbxPublic.render.agentWall',[
      'getFlyers'     => $getFlyers,
      'umid'          => $umid,
      'ajid'          => $ajid,
      'agtPhoto'      => $agtPhoto,
      'agtFullName'   => $agtFullName,
      'agtFirst'      => $agtFirst,
      'officeName'    => $officeName,
      'officeAddress' => $officeAddress,
      'officeCSZ'     => $officeCSZ,
      'officeID'      => $officeID,
      'umid'          => $umid,
      'agtPhoto'      => $agtPhoto,
      'agtLogo'       => $agtLogo,
      'agtURL'        => $agtURL,
      'agtWebsite'    => $agtWebsite,
      'agtMainPhone'  => $agtMainPhone,
    ])->render();

    echo $html;

  }

  public function joinNow(){
    $html=\View::make('mdbxPublic.render.joinNow');
    echo $html;
  }

  public function emailUs(){
    $html=\View::make('mdbxPublic.render.emailUs');
    echo $html;
  }

  public function pubSubscribe(){
    $html=\View::make('mdbxPublic.render.pubSubscribe');
    echo $html;
  }

  public function privacyPolicy(){
    $html=\View::make('mdbxPublic.render.privacyPolicy');
    echo $html;
  }

}
