<?php

namespace App\Http\Controllers\mdbxPublic;
use App\Http\Controllers\Controller;

use Request;
use Validator;
use App\models\core\propagent;
use App\models\core\propflyer;
use App\models\core\propmapping;
use App\models\core\propmeta;
use App\models\admin\adminOption;
use Illuminate\Support\Facades\Crypt;

class omdbxTrialCheckController extends Controller
{
    public function trialCheck(Request $request){
      //email form value
      $theEmail=request::input('theEmail');
      //required field and must be an email to pass
      $validator = Validator::make($request::all(), [
         'theEmail'   => 'Required|email',
      ]);
      //if passes code ok
      if ($validator->passes()) {

         //dup trial check
         $dupcheck=propagent::select('id')
         ->where('agtUname','=',"$theEmail")
         ->orWhere('xxAgtUname','=',"$theEmail")
         ->orWhere('trialUname','=',"$theEmail")
         ->first();

         //if record is found redirect
         //to dup page with info
         if($dupcheck){
            return \Redirect::route('public.index',['dup'=>1,'theEmail'=>$theEmail])
            ->withErrors([
              'message'=> 'You already have an account! Please log-in or reset password'
            ]);
         }

        //variable required - $theEmail -
        include(app_path() . '/functions/mdbxTrial/trialCheck.php');

        //if result from trialCheck is none - redirect
        if($listName=='none'){

          $key = Crypt::encrypt([
            'theEmail'  => $theEmail,
            'amt'       => 0,
          ]);

          //redirect to --NOT ON ANY DISTRO LISTS--
          return \Redirect::route("public.newTrialRequest",[
            'key'=>$key,
          ]);}

        //**********************************************//
        // ** if all OK with trial checks continue!  ** //
        //**********************************************//

        //set autoDate
        $autoTrialDate=\Carbon\Carbon::now();
        $accountType=1;
        $cbpDate=null;
        $cbpAmt=0;
        //get variables
        include(app_path().'/functions/mdbxTrial/theListVariables.php');
        //create account
        include(app_path().'/functions/mdbxTrial/createNewAccount.php');
        //send Welcome Email
        //Variables needed
        $toEmail=$theEmail;
        $toName=$agtFirst;
        $theSubject="Welcome! Your RealtyEmails Account Info";
        $sendThis="emails.mdbx.mdbxNewAccount";
        $data = [
          'agtFirst'    => $agtFirst,
          'theEmail'    => $theEmail,
          'agtPswd'     => $agtPswd,
        ];
        include(app_path().'/functions/email/sendEmailTemplate.php');
        //redirect
        return \Redirect::route('public.index')->with([
          'message'=> 'Trial Account Created!'
        ]);
      }

      //if out here validation failure
      return back()
      ->withErrors($validator);
    }
}
