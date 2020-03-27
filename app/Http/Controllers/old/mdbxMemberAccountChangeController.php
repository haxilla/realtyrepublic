<?php

namespace App\Http\Controllers;

use Request;
use Hash;
use Auth;
use App\propagent;
use App\passwordReset;
use App\User;
use App\adminOption;

class mdbxMemberAccountChangeController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:web');
   }

   public function mdbxMemberPasswordChange(){

      $umid=Auth::guard('web')->user()->id;
      //from form
      $currentPassword=request('currentPassword');
      //run query
      $checkAgent=propagent::select(
         'passHash','agtUname','xxAgtUname',
         'agtFullName','agtFirst','agtFullName')
      ->where('id','=',"$umid")
      ->first();
      //variables
      $existingPassword = $checkAgent['passHash'];
      $agtUname         = $checkAgent['agtUname'];
      $agtFullName      = $checkAgent['agtFullName'];
      //error if none
      if(!$agtUname){
         $agtUname=$checkAgent['xxAgtUname'];}

      if(!Hash::check($currentPassword,$existingPassword)){

         $toEmail="realtyemails@gmail.com";
         $theSubject="Password Login Mismatch Failure";
         $data = [
            'agtUname'=>$agtUname,
            'theReason'=>'Mismatch Password in Member Login'
         ];

         \Mail::send('emails.mdbx.admin.mdbxPasswordResetFail', $data,
         function($message) use ($data,$toEmail,$theSubject){
            $message->to($toEmail,'RealtyEmails')
            ->subject($theSubject);
         });

         //show failure
         return \Redirect::route("mdbxAccountInfo")
            ->with('message', "Password Reset Failed");
      }

      // if not redirected above
      // ok to proceed
      //send token
      $token = md5(uniqid(mt_rand()));

      //insert into table
      passwordReset::create([
         'token'        => $token,
         'email'        => $agtUname,
         'propagent_id' => $umid,]);

      //begin email variables
      $adminOptions=adminOption::first();
      $emailMode=$adminOptions['emailMode'];
      if($emailMode!=='LIVE'){
         $toEmail="realtyemails@gmail.com";
         $toName='Chris Mistretta';
      }else{
         $toEmail=$agtUname;
         $toName=$agtFullName;}

      //email settings
      $theSubject='RealtyEmails Password Reset Instructions!';
      $bcc="realtyemails@gmail.com";
      //URL Logic
      //sends proper link based on url that generated it
      $currURL=Request::url();
      if( strpos($currURL, 'rosemary.test') !== false){
         $fromURL="www.rosemary.test";
      }elseif(strpos($currURL, 'realtyrepublic') !== false){
         $fromURL="www.realtyrepublic.com";
      }elseif(strpos($currURL, 'realtyemails') !== false){
         $fromURL="www.realtyemails.com";}

      //values needed inside actual email below
      $data = [
         'token'     => $token,
         'agtFirst'  => $checkAgent['agtFirst'],
         'fromURL'   => $fromURL,];

      //send email
      \Mail::send('emails.mdbx.mdbxPasswordReset', $data,
      function($message) use ($data,$toEmail,$theSubject,$agtFullName,$bcc){
         $message->to($toEmail,$agtFullName)
         ->subject($theSubject)
         ->bcc($bcc);
      });

      //show success email sent
      return \Redirect::route("mdbxAccountInfo")
      ->with('message', "Password Request Sent!");
   }

   public function mdbxMemberUsernameChange(){

      $umid=Auth::guard('web')->user()->id;
      $newUsername=request('newUsername');
      if(!$umid||!$newUsername){
         dd('error-line105-mdbxMemberAccountChangeController');}

      $checkAgent=propagent::select('agtFullName','agtFirst',
         'agtUname','xxAgtUname')
      ->where('id','=',"$umid")
      ->first();

      $checkUser=propagent::where('agtUname','=',"$newUsername")
      ->orWhere('xxAgtUname','=',"$newUsername")
      ->first();

      if($checkUser){
         //show failure
         return back()->with('message','Username Already Exists! Change request Failed');}

      if(!$checkAgent){
         dd('error-line109-mdbxMemberAccountChangeController');}

      //ok to proceed
      //send token
      $token = md5(uniqid(mt_rand()));
      $oldUsername=$checkAgent['agtUname'];
      if(!$oldUsername){
         $oldUsername=$checkAgent['xxAgtUname'];}

      //insert into table
      passwordReset::create([
         'token'=>$token,
         'email'=>$newUsername,
         'propagent_id'=>$umid,
         'newUsername'=>$newUsername,
         'oldUsername'=>$oldUsername,]);

      //begin email variables
      $toEmail=$newUsername;
      $theSubject='RealtyEmails Username Reset Instructions!';
      $agtFullName=$checkAgent['agtFullName'];
      $bcc="realtyemails@gmail.com";

      //sends proper link based on url that generated it
      $currURL=Request::url();
      if( strpos($currURL, 'rosemary.test') !== false){
         $fromURL="www.rosemary.test";
      }elseif(strpos($currURL, 'realtyrepublic') !== false){
         $fromURL="www.realtyrepublic.com";
      }elseif(strpos($currURL, 'realtyemails') !== false){
         $fromURL="www.realtyemails.com";}

      //values needed inside actual email below
      $data = [
         'token'     => $token,
         'agtFirst'  => $checkAgent['agtFirst'],
         'fromURL'   => $fromURL,];

      //send email
      \Mail::send('emails.mdbx.mdbxUsernameReset', $data,
      function($message) use ($data,$toEmail,$theSubject,$agtFullName,$bcc){
         $message->to($toEmail,$agtFullName)
         ->subject($theSubject)
         ->bcc($bcc);
      });

      //show success email sent
      return \Redirect::route("mdbxAccountInfo")
      ->with('message', "Username Change Request Sent!");
   }

   public function mdbxMemberUsernameLink(){
      //agent ID
      $umid=Auth::guard('web')->user()->id;
      //get passwordRequestLink
      $prl=request('prl');
      //if not there error
      if(!$prl||!$umid){
         dd('error-line172-mdbxMemberAccountChangeController');}
      //find match in database
      $checkPRL=passwordReset::select('newUsername','oldUsername')
      ->where('token','=',"$prl")
      ->first();
      //set username
      $newUsername=$checkPRL['newUsername'];
      $oldUsername=$checkPRL['oldUsername'];
      //if not found error
      if(!$checkPRL||!$newUsername){
         dd('error-line174-mdbxMemberAccountChangeController');}

      //redirect to page to reset password
      return view('members.mdbx.functions.mdbxMemberUsernameReset',[
         'prl'=>$prl,
         'newUsername'=>$newUsername,
         'oldUsername'=>$oldUsername,
      ]);

   }

   public function mdbxMemberUsernameChangePost(){
      //must have variables
      $umid          = Auth::guard('web')->user()->id;
      $prl           = request('prl');
      $thePassword   = request('thePassword');
      //if not there error
      if(!$prl||!$umid||!$thePassword){
         dd('error-line200-mdbxMemberAccountChangeController');}
      //find match in database
      $checkPRL=passwordReset::select('newUsername','oldUsername')
      ->where('token','=',"$prl")
      ->first();
      //set username
      $newUsername=$checkPRL['newUsername'];
      $oldUsername=$checkPRL['oldUsername'];
      //if not found error
      if(!$checkPRL||!$newUsername||!$oldUsername){
         dd('error-line208-mdbxMemberAccountChangeController');}

      $getAgent=propagent::select('passHash','agtFirst')
      ->where('id','=',"$umid")
      ->first();

      $passHash=$getAgent['passHash'];
      $agtFirst=$getAgent['agtFirst'];

      //if mismatch send back with error
      //and email admin
      if(!Hash::check($thePassword,$passHash)){
         $toEmail="realtyemails@gmail.com";
         $theSubject="Password Login Mismatch Failure";
         $data = [
            'agtUname'=>$oldUsername,
            'theReason'=>'Mismatch Password for change USERNAME line 223 mdbxMemberAccountChangeController',
         ];

         \Mail::send('emails.mdbx.admin.mdbxPasswordResetFail', $data,
         function($message) use ($data,$toEmail,$theSubject){
            $message->to($toEmail,'RealtyEmails')
            ->subject($theSubject);
         });

         //show failure
         return back()->withErrors(['Error Changing Username']);}

      //no duplicate allowed on new name
      $checkUser=propagent::select('id')
      ->where('agtUname','=',"$newUsername")
      ->orWhere('xxAgtUname','=',"$newUsername")
      ->first();

      if($checkUser){

         $toEmail="realtyemails@gmail.com";
         $theSubject="Username Already Exists";
         $data = [
            'agtUname'=>$oldUsername,
            'theReason'=>
            'Username already exists! Username NOT changed -
            line250 mdbxAccountChangeController',
         ];

         \Mail::send('emails.mdbx.admin.mdbxPasswordResetFail', $data,
         function($message) use ($data,$toEmail,$theSubject){
            $message->to($toEmail,'RealtyEmails')
            ->subject($theSubject);
         });

         //show failure
         return back()->withErrors(['Username Already Exists']);}

      //success if it made it this far
      //change & null out deprecated field
      propagent::where('id','=',"$umid")
      ->update([
         'agtUname'=>$newUsername,
         'xxAgtUname'=>null,
      ]);

      //prepare for login
      $user = User::find($umid);
      //log user in
      Auth::login($user);
      //send them email with new info
      $toEmail="realtyemails@gmail.com";
      $theSubject="RealtyEmails - Username Changed Successfully";
      $data = [
         'agtFirst'     => $agtFirst,
         'oldUsername'  => $oldUsername,
         'newUsername'  => $newUsername,
      ];

      \Mail::send('emails.mdbx.members.mdbxUsernameChangeOK', $data,
         function($message) use ($data,$toEmail,$theSubject){
         $message->to($toEmail,'RealtyEmails')
         ->subject($theSubject);
      });

      //redirect to login
      return \Redirect::route("mLogin")
      ->with('message', "Username Changed Successfully");

   }

}
