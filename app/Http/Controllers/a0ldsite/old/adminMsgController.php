<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\remailmsg;
use App\propagent;
use App\propflyer;

class adminMsgController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function showMsg(){

      $messages=remailmsg::whereNull('apprv')
      ->leftJoin('propagents',
         'remailmsg.propagent_id','=','propagents.id')
      ->get();

      return view('admin.functions.memberMsg',[
         'messages'=>$messages
      ]);

   }

   public function approveMsg($msgid,$umid,$id){

      //fetch senderName, senderEmail, senderPhone from msg
      $messages=remailmsg::where('msgid','=',"$msgid")
      ->first();

      //fetch emails of member to send message to
      $theEmails=propagent::select('agtEmail','xxAgtUname','agtFullName')
      ->where('id','=',"$umid")
      ->first();

      $address=propflyer::where('id','=',"$id")
      ->pluck('xFullStreet')
      ->first();

      $toEmail     = $theEmails['agtEmail'];
      $toName      = $theEmails['agtFullName'];
      $fromEmail   = $messages['senderEmail'];
      $fromName    = $messages['senderName'];
      $theSubject  = "RealtyEmails: $address - You received a message!";

      $data = [
         'messages' => $messages,
         'address'  => $address
      ];

      //dispatch message to agtEmail
      \Mail::send('emails.messageCenter',$data,
         function($message)
         use ($data,$toEmail,$toName,$fromEmail,$fromName,$theSubject){
            $message->to($toEmail,$toName)
            ->from($fromEmail,$fromName)
            ->subject($theSubject);
         }
      );

      //if xxAgtUname is different than agtEmail send there too
      if($theEmails['xxAgtUname'] != $theEmails['agtEmail']){

         //change To Email
         $toEmail=$theEmails['xxAgtUname'];

         //dispatch message to xxAgtUname
         \Mail::send('emails.messageCenter',$data,
            function($message)
            use ($data,$toEmail,$toName,$fromEmail,$fromName,$theSubject){
               $message->to($toEmail,$toName)
               ->from($fromEmail,$fromName)
               ->subject($theSubject);
            }
         );

      }

      //mark as approved
      remailmsg::where('msgid','=',"$msgid")
      ->update([
         'apprv'=>1
      ]);

      //return back to message center
      return back();

   }
}
