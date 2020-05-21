<?php

namespace App\Http\Controllers\thePublic;
use App\Http\Controllers\Controller;

class errorController extends Controller
{

  public function trialError(){
    $reason=request('reason');
    $html=\View::make('mdbxPublic.render.trialError')
    ->with('reason',$reason);
    echo $html;
  }

}
