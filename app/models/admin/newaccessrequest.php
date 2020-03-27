<?php

namespace App\models\admin;

class newaccessrequest extends \App\Model
{
    public static function newTrialRequest(){
      $newTrialRequest=newaccessrequest::where('adminApprove','=','0')
      ->get();

      return $newTrialRequest;
    }

    public static function trialApproved(){

      $trialApproved=newaccessrequest::where('adminApprove','=','1')
      ->orderBy('adminApproveDate','desc')
      ->take(10)
      ->get();

      return $trialApproved;

    }

    public static function newAccessInfo(){

      $umid=\Auth::guard('web')->user()->id;

      $newAccessInfo=static::where('umid','=',"$umid")
      ->first();

      return $newAccessInfo;
    }

}
