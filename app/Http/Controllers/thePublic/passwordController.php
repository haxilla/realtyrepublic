<?php

namespace App\Http\Controllers\thePublic;
use App\Http\Controllers\Controller;

use App\models\core\User;
use App\models\core\propagent;
use App\models\resets\passwordReset;
use App\models\admin\adminOption;
use Validator;
use Request;
use Auth;

class passwordController extends Controller
{

   public function passwordRequest(Request $request){

      //get value of agtUname field
      $agtUname=request('agtUname');

      //validate captcha
      $validator = Validator::make($request::all(), [
         'g-recaptcha-response'  => 'required',
         'agtUname'              => 'required|email',]);

      //if fails return back
      if ($validator->fails()) {
        return back()
        ->withErrors($validator)
        ->withInput()
        ->with('passwordResetModalError','Field Required');}

      //validate captcha
      include(app_path().'/functions/inputHelpers/captchaV2validate.php');

      //v2 captcha
      if($success==false){
         //set message to use in captchaV2validate
         $errorMessage='passwordResetCaptchaError';
         //Redirect with error
         return redirect()->back()
         ->with("$errorMessage",'Sorry Invalid Request')
         ->withInput()
         ->withErrors(['captcha'=>'Sorry we had an issue with your request!']);}

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
            'theReason'=>'Username Not Found',];

         //send email
         \Mail::send('emails.admin.passwordResetFail', $data,
            function($message) use ($data,$toEmail,$theSubject){
               $message->to($toEmail,'RealtyEmails')
               ->subject($theSubject);
            });

         //redirect & show failure
         return \Redirect::route("public.index")
         ->withErrors(['message1'=>'Username Not Found!'])
         ->with('passwordResetModalError','Invalid Username')
         ->withInput();}

      // ** if not redirected continue below **
      include(app_path().'/functions/fromURL.php');

      // set umid
      $umid=$checkAgent['id'];

      //check agents
      $agentExists=propagent::where('id','=',$umid)
      ->select('id')
      ->first();

      //error if none
      if(!$agentExists){
         dd('error-line92-passwordController');}

      //generate unique string
      $prl = md5(uniqid(mt_rand()));

      //insert into table (prl=password reset link)
      passwordReset::create([
         'prl'             => $prl,
         'passwordRequest' => 1,
         'email'           => $agtUname,
         'propagent_id'    => $umid,]);

      //data
      $data = [
         'prl'       => $prl,
         'agtFirst'  => $checkAgent['agtFirst'],
         'fromURL'   => $fromURL,];

      //set toEmail & toName
      $toEmail = $checkAgent['agtUname'];
      $toName  = $checkAgent['agtFullName'];

      //check mode & overwrite toEmail & toNameif test mode
      include(app_path().'/functions/adminOptions/liveOrTestMode.php');

      //set subject & bcc
      $theSubject='RealtyEmails Password Reset Instructions!';
      $bcc="realtyemails@gmail.com";

      //send email
      \Mail::send('emails.members.passwordResetLink', $data,
         function($message) use ($data,$toEmail,$toName,$theSubject,$bcc){
            $message->to($toEmail,$toName)
            ->subject($theSubject)
            ->bcc($bcc);
         });

      //show success email sent
      return \Redirect::route("public.index")
      ->with('passwordChangeSent', 'Success');

   }//end of function

   public function passwordResetLink(){

      //prl=passwordResetLink
      $prl=request('prl');

      //sent now time
      $now=\Carbon\Carbon::now();

      //error if none
      if(!$prl){
         //set error
         $errors=['Please try clicking the link that was sent to your email<BR>or try resending it by using the form below'];
         //show failure
         return \Redirect::route("public.index")
            ->with('passwordRequestFailed', "1")
            ->withErrors($errors);}

      //find record
      $findReset=passwordReset::select('email','created_at',
         'propagent_id','clicked'
      )->where('prl','=',"$prl")
      ->first();

      //check if used
      $clicked=$findReset['clicked'];

      //error if none OR if used
      if(!$findReset||$clicked=='1'){

         //variables
         $toEmail="realtyemails@gmail.com";
         $theSubject="Password Reset Failure";

         if($clicked=='1'){
            $theReason='You have already used this link<BR>Please request a new one';
         }else{
            $theReason='The Link You clicked was Invalid<BR>Please try again';}

         //set email contents
         $theReasonAdmin=$theReason.' - Line 157-passwordController';
         $data = [
            'agtUname'  => $prl,
            'theReason' => $theReasonAdmin,];

         //send mail
         \Mail::send('emails.admin.passwordResetFail', $data,
            function($message) use ($data,$toEmail,$theSubject){
               $message->to($toEmail,'RealtyEmails')
               ->subject($theSubject);
            });

         //set errors
         $errors=["$theReason"];

         //show failure
         return \Redirect::route("public.index")
         ->with('passwordRequestFailed', "$theReason")
         ->withErrors($errors);}

      //determine expiration
      $created=$findReset['created_at'];
      $expires=$created->addDays(1);

      //if expired redirect
      if($expires->lessThan($now)){
         // ** UNFINISHED CODE ** //
         //redirect back with link to resend new code
         dd('expired');}

      //set umid
      $umid=$findReset['propagent_id'];

      //check agent
      $agentExists=propagent::where('id','=',$umid)
      ->first();

      //error if none
      if(!$agentExists){
         dd('error-line169-passwordController');}

      //if not expired set click
      passwordReset::where('prl','=',$prl)
      ->update([
         'clicked'   =>1,
         'clickDate' =>$now,]);

      //delete all non-clicked records
      $deletedRows = passwordReset::where('propagent_id','=',$umid)
      ->whereNotNull('passwordRequest')
      ->whereNull('clicked')
      ->delete();

      //redirect to Reset Password Form
      return \Redirect::route("public.passwordResetForm",['prl'=>$prl]);

   }//end of function

   public function passwordResetForm(){
      //check for PRL in session
      $prl=request('prl');

      if(!$prl){
         //set errors
         $errors=['Unable to Process Password Change<BR>Please Try Again.'];

         //show failure
         return \Redirect::route("public.index")
         ->with('passwordRequestFailed', "No Valid PRL")
         ->withErrors($errors);}

      //check PRL
      $validPRL=passwordReset::where('prl','=',$prl)
      ->select('propagent_id','clickDate')
      ->where('clicked','=','1')
      ->whereNull('passwordChanged')
      ->first();

      //determine expiration
      $now=\Carbon\Carbon::now();
      $clickDate=$validPRL['clickDate'];
      $expireDate=$clickDate->addDays(1);

      //set expired value
      if($expireDate->lessThan($now)){
         $expired=1;
      }else{
         $expired=null;}

      //set umid
      $umid=$validPRL['propagent_id'];

      //check umid
      $agentInfo=propagent::where('id','=',$umid)
      ->first();

      //error if no valid PRL
      if(!$validPRL || !$agentInfo || $expired=='1'){
         
         //set error
         if($expired=='1'){
            $errors=['Your Request Has Expired<BR>Please Try Again'];
         }elseif(!$agentInfo){
            $errors=['Unable to Validate Agent Account<BR>Please Try Again'];
         }else{
            $errors=['Unable to Validate Password Change<BR>Please Try Again'];}

         //redirect with error
         return \Redirect::route("public.index")
         ->with('passwordRequestFailed', "1")
         ->withErrors($errors);}

      //redirect to page to reset password
      return view('mdbxPublic.fullPages.passwordChangeRequest',[
         'prl'         =>  $prl,
         'agentInfo'   =>  $agentInfo
      ]);

      
   } //end of function

   public function passwordChange(request $request){

      //get prl
      $prl=request('prl');

      //error if none
      if(!$prl){

         //variables
         $toEmail="realtyemails@gmail.com";
         $theSubject="Invalid PRL - Password Reset Failure";
         $errors=['Error Processing Password Request<BR>Please Try Again.'];
         $data = [
            'agtUname'=>'NO PRL PROVIDED',
            'theReason'=>'MISSING PRL - Line301-passwordController'];

         //send mail to admin
         \Mail::send('emails,admin.passwordResetFail', $data,
            function($message) use ($data,$toEmail,$theSubject){
               $message->to($toEmail,'RealtyEmails')
               ->subject($theSubject);
            });

         //show failure
         return \Redirect::route("public.index")
         ->with('passwordRequestFailed', "1")
         ->withErrors($errors);}

      //check for record
      $validPRL=passwordReset::select('clickDate','propagent_id')
      ->where('prl','=',"$prl")
      ->where('clicked','=','1')
      ->whereNull('passwordChangeDate')
      ->first();

      //error if none
      if(!$validPRL){

         $toEmail="realtyemails@gmail.com";
         $theSubject="Invalid PRL - Password Form Submit";
         $errors=['Error Processing Password Form<br>Please Try Again.'];
         $data = [
            'agtUname'=>$prl,
            'theReason'=>'INVALID PRL - Line331-passwordController',];

         \Mail::send('emails.admin.mdbxPasswordResetFail', $data,
            function($message) use ($data,$toEmail,$theSubject){
               $message->to($toEmail,'RealtyEmails')
               ->subject($theSubject);
            });

         //show failure
         return \Redirect::route("public.index")
         ->withErrors($errors)
         ->with('passwordRequesFailed', "$theSubject");}      

      //set umid
      $umid=$validPRL['propagent_id'];

      //check agent
      $validAgent=propagent::where('id','=',$umid)
      ->select('agtUname','xxAgtUname','id')
      ->first();

      //error if none
      if(!$validAgent){

         //set variables
         $toEmail="realtyemails@gmail.com";
         $theSubject="Invalid UMID - Password Reset Failure";
         $errors=['Error Processing Password Form<br>Please Try Again.'];
         $data = [
            'agtUname'=>$prl,
            'theReason'=>'INVALID UMID - Line359-passwordController',];

         //send admin error email
         \Mail::send('emails.mdbx.admin.mdbxPasswordResetFail', $data,
            function($message) use ($data,$toEmail,$theSubject){
               $message->to($toEmail,'RealtyEmails')
               ->subject($theSubject);
            });

         //show failure
         return \Redirect::route("public.index")
         ->withErrors($errors)
         ->with('passwordRequestFailed', "1");}

      //validate
      $validator = Validator::make($request::all(), [
         'newPassword'  => 'Required|confirmed|min:7',
      ]);

      //if validator passes
      if ($validator->fails()) {
         //back to form with errors
         return back()
         ->withErrors($validator);}

      $newPassword=request('newPassword');
      $newPassword=bcrypt($newPassword);

      propagent::where('id','=',"$umid")
      ->update([
         'passHash'=>$newPassword,
         'lastLogin'=>\Carbon\Carbon::now(),
      ]);

      passwordReset::where('prl','=',"$prl")
      ->update([
         'passwordChanged'    => 1,
         'passwordChangeDate' => \Carbon\Carbon::now(),
      ]);

      //prepare for login
      $user = User::find($umid);

      //log user in
      Auth::login($user);

      //update password
      propagent::where('id','=',"$umid")
      ->update([
         'passHash'=>$newPassword
      ]);
      //Send Email Notice to Agent
      

      //direct to Login Route
      return \Redirect::route("member.login")
      ->with('message', "Password Changed Successfully!");

   }//end of function

}//end of class
