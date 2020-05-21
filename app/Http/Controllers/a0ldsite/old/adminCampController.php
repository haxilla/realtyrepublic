<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\propdelivnow;
use App\testemail;
use App\propagent;

class adminCampController extends Controller
{
   public function __construct(){
      $this->middleware('auth:admin');
   }

   public function addTestCamp($cid){

      $campInfo=propdelivnow::where('cid','=',"$cid")
      ->first();

      $newEntry=propdelivnow::create([
         'propflyer_id'    => $campInfo['propflyer_id'],
         'propagent_id'    => $campInfo['propagent_id'],
         'emSubject'       => $campInfo['emSubject'],
         'emArea'          => 'testList',
         'emArea_display'  => 'testList',
         'campLabel'       => 'testList',
         'emRequest'       => \Carbon\Carbon::now(),
         'campCreated'     => \Carbon\Carbon::now(),
         'closingLine'     => $campInfo['closingLine'],
         'removeLink'      => $campInfo['removeLink'],
      ]);

      $newCID=$newEntry->cid;

      return \Redirect::route("admSendTestCamp", ['cid'=>$newCID]);

   }

   public function sendTestCamp($cid){

      $campInfo=propdelivnow::select(
         'cid','emSubject','delay',
         'amtEmails','startRow',
         'propagent_id','propflyer_id',
         'emSubject')
      ->where('cid','=',"$cid")
      ->first();

      //set id, display, enc for includes below to function
      $id=$campInfo['propflyer_id'];
      $display='email';

      //sets major flyer variables
      include(app_path() . '/functions/flyerQuery.php');

      //sets defaults if none found for delay/amt/startrow
      include(app_path() . '/functions/emailDefaults.php');

      //the Email list
      $theList=testemail::take($amt)
      ->skip($startRow)
      ->get();

      //redirect if finished
      if(!$theList->first()){

         //update campaign to show complete
         propdelivnow::where('cid','=',"$cid")
         ->update([
            'emComplete'=>\Carbon\Carbon::now()
         ]);

         //insert full record into propdeliv
         \DB::connection()
            ->select(\DB::raw("
               insert ignore into propdelivs
               select * from propdelivnow
               where cid=$cid
            ")
         );

         //Delete from propdelivnow
         propdelivnow::where('cid','=', "$cid")->delete();

         //notify agent of completion

         //check for next record in campaigns

         dd('All Done!');
      }

      if($startRow==0){
         //send campaign started email

         //update campaign to show start
         propdelivnow::where('cid','=',"$cid")
         ->update([
            'emStart'=>\Carbon\Carbon::now()
         ]);

      }

      //constant variables
      $fromEmail='members@realtyrepublic.com';
      $fromName=$agentName;
      $theSubject=$campInfo['emSubject'];

      //Send Email Here
      foreach($theList as $tl){

         //dynamic variables from list
         $toEmail = $tl->theEmail;
         $toName  = $tl->theName;

         $enc = Crypt::encrypt([
            'ufid'=>$id,
            'umid'=>$idMem,
            'cid'=>$cid,
            'eid'=>$tl->eid,
            'emArea'=>'testList',
            'template'=>$template,
            'toEmail'=>$toEmail,
            'linkPage'=>'adminCampController'
         ]);

         //sets $data=[] for Email Template
         include(app_path() . '/functions/emailData.php');

         //dispatch message
         \Mail::send('emails.flyerTemplates',$data,
            function($message)
            use ($data,$toEmail,$toName,$fromEmail,$fromName,$theSubject){
               $message->to($toEmail,$toName)
               ->from($fromEmail,$fromName)
               ->subject($theSubject);
            }
         );

      }

      //adjust new startRow & update
      $newStart=$startRow+$amt;

      //Update delivery table
      propdelivnow::where('cid','=',"$cid")
      ->update([
         'startRow'  => $newStart,
         'delay'     => $delay,
         'amtEmails' => $amt
      ]);

      /**
      return view('admin.mailtest.automailMeta',[
         'amt'       => $amt,
         'delay'     => $delay,
         'startRow'  => $startRow
      ]);
      **/

   }

}
