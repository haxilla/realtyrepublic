<?php

namespace App\Http\Controllers\thePublic\a0ld;
use App\Http\Controllers\Controller;

class overlayController_v1 extends Controller
{

  public function populateOverlay(){

    //set html
    $populate=request('populate');

    //Pay per Flyer Plan
    if($populate=='payPerPlan'){
      $html=\View::make('mdbxPublic.partials.payPerFull')
      ->render();}

    //Unlimited Flyer Plan
    if($populate=='unlimitedPlan'){
      $html=\View::make('mdbxPublic.partials.unlimitedFull')
      ->render();}

    //show
    echo $html;
    //exit
    exit();

  }

}
