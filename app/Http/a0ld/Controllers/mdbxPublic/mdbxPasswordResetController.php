<?php

namespace App\Http\Controllers\mdbxPublic;
use App\Http\Controllers\Controller;

use App\models\core\User;
use App\models\core\propagent;
use App\models\resets\passwordReset;
use App\models\admin\adminOption;
use Validator;
use Request;
use Auth;

class mdbxPasswordResetController extends Controller
{
    public function mdbxPasswordResetPost(Request $request){

      //get value of agtUname field
      $agtUname=request('agtUname');
      $currURL=Request::url();
      //validate captcha
      $validator = Validator::make($request::all(), [
         'g-recaptcha-response'  => 'required',
         'agtUname'              => 'required|email',
      ]);
      //if fails return back
      if ($validator->fails()) {
        return back()
        ->withErrors($validator)
        ->withInput()
        ->with('passwordResetModalError','Field Required');}

      //set message to use in captchaV2validate
      $errorMessage='passwordResetCaptchaError';
      //validate captcha
      include(app_path().'/functions/inputHelpers/captchaV2validate.php');
      
      //set URL
      if( strpos($currURL, 'rosemary.test') !== false){
         $fromURL="www.rosemary.test";
      }elseif(strpos($currURL, 'realtyrepublic') !== false){
         $fromURL="www.realtyrepublic.com";
      }elseif(strpos($currURL, 'realtyemails')){
         $fromURL="www.realtyemails.com";}

      //check agtUname
      $checkAgent=propagent::select('id','agtUname','agtFirst','agtFullName')
      ->where('agtUname','=',"$agtUname")
      ->orWhere('xxAgtUname','=',"$agtUname")
      ->first();

      //if none error
      if(!$checkAgent){
         //send admin error notice
         //set email
         $toEmail="realtyemails@gmail.com";
         //set subject
         $theSubject="Password Reset Failure";
         //set data
         $data = [
            'agtUname'=>$agtUname,
            'theReason'=>'Username Not Found'
         ];
         //send email
         \Mail::send('emails.mdbx.admin.mdbxPasswordResetFail', $data,
            function($message) use ($data,$toEmail,$theSubject){
               $message->to($toEmail,'RealtyEmails')
               ->subject($theSubject);
            }
         );
         //redirect & show failure
         return \Redirect::route("public.index")
         ->withErrors(['message1'=>'Username Not Found!'])
         ->with('passwordResetModalError','Invalid Username')
         ->withInput();}

      // ** if not redirected continue below ** 

      // set umid
      $umid=$checkAgent['id'];
      //generate unique string
      $token = md5(uniqid(mt_rand()));
      //insert into table
      passwordReset::create([
         'token'        => $token,
         'email'        => $agtUname,
         'propagent_id' => $umid,
      ]);

      $data = [
         'token'     => $token,
         'agtFirst'  => $checkAgent['agtFirst'],
         'fromURL'   => $fromURL,
      ];
      //set toEmail & toName
      $toEmail = $checkAgent['agtUname'];
      $toName  = $checkAgent['agtFullName'];
      //check mode & overwrite toEmail & toNameif test mode
      include(app_path().'/functions/adminOptions/liveOrTestMode.php');
      //set subject & bcc
      $theSubject='RealtyEmails Password Reset Instructions!';
      $bcc="realtyemails@gmail.com";
      //send email
      \Mail::send('emails.mdbx.mdbxPasswordReset', $data,
         function($message) use ($data,$toEmail,$toName,$theSubject,$bcc){
            $message->to($toEmail,$toName)
            ->subject($theSubject)
            ->bcc($bcc);
         }
      );

      //show success email sent
      return \Redirect::route("public.index")
      ->with('passwordChangeSent', 'Success');

    }

    public function mdbxPasswordResetLink(){
      //prl=passwordResetLink
      $prl=request('prl');

      if(!$prl){
         dd('error-line62-mdbxPasswordResetController');}

      $findReset=passwordReset::select('email')
      ->where('token','=',"$prl")
      ->first();

      if(!$findReset){

         $toEmail="realtyemails@gmail.com";
         $theSubject="Invalid PRL - Password Reset Failure";
         $data = [
            'agtUname'=>$prl,
            'theReason'=>'INVALID PRL - Line98-mdbxPasswordResetController'
         ];

         \Mail::send('emails.mdbx.admin.mdbxPasswordResetFail', $data,
            function($message) use ($data,$toEmail,$theSubject){
               $message->to($toEmail,'RealtyEmails')
               ->subject($theSubject);
            }
         );

         //show failure
         return \Redirect::route("public.index")
         ->with('message', "Password Request Failed");
      }

      //redirect to page to reset password
      return view('mdbxMember.fullPages.mdbxPasswordReset',[
         'prl'=>$prl,
      ]);

    }

    public function mdbxPasswordChangePost(request $request){

      $prl=request('prl');

      if(!$prl){
         $toEmail="realtyemails@gmail.com";
         $theSubject="Invalid PRL - Password Reset Failure";
         $data = [
            'agtUname'=>$prl,
            'theReason'=>'INVALID PRL - Line129-mdbxPasswordResetController'
         ];

         \Mail::send('emails.mdbx.admin.mdbxPasswordResetFail', $data,
            function($message) use ($data,$toEmail,$theSubject){
               $message->to($toEmail,'RealtyEmails')
               ->subject($theSubject);
            }
         );

         //show failure
         return \Redirect::route("public.index")
         ->with('message', "Password Request Failed");
      }

      $checkPRL=passwordReset::select('email')
      ->where('token','=',"$prl")
      ->first();

      $resetEmail=$checkPRL['email'];

      if(!$resetEmail){

         $toEmail="realtyemails@gmail.com";
         $theSubject="Invalid EMAIL - Password Reset Failure";
         $data = [
            'agtUname'=>$prl,
            'theReason'=>'NO EMAIL - Line156-mdbxPasswordResetController'
         ];

         \Mail::send('emails.mdbx.admin.mdbxPasswordResetFail', $data,
            function($message) use ($data,$toEmail,$theSubject){
               $message->to($toEmail,'RealtyEmails')
               ->subject($theSubject);
            }
         );

         //show failure
         return \Redirect::route("public.index")
         ->with('message', "Password Request Failed");
      }

      $checkUmid=propagent::select('id')
      ->where('agtUname','=',"$resetEmail")
      ->orWhere('xxAgtUname','=',"$resetEmail")
      ->first();

      $umid=$checkUmid['id'];

      if(!$umid){
         $toEmail="realtyemails@gmail.com";
         $theSubject="Invalid UMID - Password Reset Failure";
         $data = [
            'agtUname'=>$prl,
            'theReason'=>'INVALID UMID - Line183-mdbxPasswordResetController'
         ];

         \Mail::send('emails.mdbx.admin.mdbxPasswordResetFail', $data,
            function($message) use ($data,$toEmail,$theSubject){
               $message->to($toEmail,'RealtyEmails')
               ->subject($theSubject);
            }
         );
         //show failure
         return \Redirect::route("public.index")
         ->with('message', "Password Request Failed");
      }

      $validator = Validator::make($request::all(), [
         'newPassword'  => 'Required|confirmed|min:7',
      ]);

      //if validator passes
      if ($validator->passes()) {

         $newPassword=request('newPassword');
         $newPassword=bcrypt($newPassword);

         propagent::where('id','=',"$umid")
         ->update([
            'passHash'=>$newPassword,
            'lastLogin'=>\Carbon\Carbon::now(),
         ]);

         passwordReset::where('token','=',"$prl")
         ->delete();

         //prepare for login
         $user = User::find($umid);

         //log user in
         Auth::login($user);

         //update password
         propagent::where('id','=',"$umid")
         ->update([
            'passHash'=>$newPassword
         ]);

         //delete reset link
         passwordReset::where('token','=',"$prl")
         ->delete();

         //direct to mLogin Route
         return \Redirect::route("member.login")
         ->with('message', "Password Changed!");

      }

      //back to form with errors
      return back()
      ->withErrors($validator);

    }
}
