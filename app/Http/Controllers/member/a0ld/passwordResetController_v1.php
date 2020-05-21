<?php

namespace App\Http\Controllers\member\a0ld;
use App\Http\Controllers\Controller;
use Request;
use Auth;

class passwordResetController_v1 extends Controller
{

  public function formSubmit(Request $request){

    //include
    include(app_path().'/members/functions/passwordReset.php');

    if($validationError){
      return response()
      ->json([
        'errors'          => $validator->errors()->all(),
        'resetFailCount'  => $resetFailCount,
      ]);
    }

    include(app_path().'/members/functions/passwordResetCheck.php');

    return response()
    ->json([
      'status'        => 'success',
      'resetRequest'  => $agtPswdReset,
    ]);


  }

}
