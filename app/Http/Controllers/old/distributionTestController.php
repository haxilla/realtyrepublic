<?php

namespace App\Http\Controllers;

use Request;
use App\propdeliv;
use App\propflyer;
use App\remailmsg;
use App\testemail;
use Validator;

class distributionTestController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function showList(){

      $messages=remailmsg::whereNull('apprv')
      ->get();

      $testEmails=testEmail::get();

      return view('admin.mailtest.emailTestList',[
         'messages'     => $messages,
         'testEmails'   => $testEmails
      ]);

   }

   public function postTestEmail(Request $request){

      $validator = Validator::make($request::all(), [
         'theEmail'      => 'Required|email'
      ]);

      if ($validator->passes()) {

         $theEmail=$request::input('theEmail');
         $theName=$request::input('theName');

         testEmail::create([
            'theEmail'  => $theEmail,
            'theName'   => $theName
         ]);

         return \Redirect::route("adminTestEmail")
         ->with('message', "Email Added Successfully!");

      }

      //if you're here validation did not pass
      //back to form with errors
      return back()
      ->withErrors($validator);

   }

   public function startTestList(){

      $messages=remailmsg::whereNull('apprv')
      ->get();

      //populate a list of recently sent flyers to test
      $testList=propdeliv::select('propflyer_id','xFullStreet','emComplete')
      ->leftJoin('propflyers',
      'propflyers.id','=','propdelivs.propflyer_id')
      ->whereNotNull('emComplete')
      ->where('emComplete','>', \Carbon\Carbon::now()->subDays(30))
      ->orderBy('emComplete','desc')
      ->take(15)
      ->get();

      return view('admin.mailtest.startTestList',[
         'messages'=>$messages,
         'testList'=>$testList
      ]);

   }

   public function distributionTest($id,$startRow,$delay,$amt){

      //send to list
      $testList=testemail::take($amt)
      ->skip($startRow)
      ->get();

      //redirect if finished
      if(!$testList->first()){
         dd('All Done!');
      }

      //constant variables
      $fromEmail='testing@realtyemails.com';
      $fromName='testing';
      $theSubject='Email Test';

      $address=propflyer::where('id','=',"$id")
      ->pluck('xFullStreet')
      ->first();

      //data
      $data = [
         'address'  => $address
      ];

      foreach($testList as $tl){

         $toEmail = $tl->theEmail;
         $toName  = $tl->theName;

         //dispatch message
         \Mail::send('emails.testMessage',$data,
            function($message)
            use ($data,$toEmail,$toName,$fromEmail,$fromName,$theSubject){
               $message->to($toEmail,$toName)
               ->from($fromEmail,$fromName)
               ->subject($theSubject);
            }
         );
      }

      $startRow++;
      return view('admin.mailtest.autoMailMeta',[
         'id'        => $id,
         'startRow'  => $startRow,
         'delay'     => $delay,
         'amt'       => $amt
      ]);

   }
}
