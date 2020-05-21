<?php

namespace App\Http\Controllers\mdbxAdmin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\models\admin\remailmsg;
use App\models\core\propagent;

class mdbxAdminMsgController extends Controller
{

   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function adminDeleteMsg(){
      //get msgid
      $msgid=request('msgid');
      //error if none
      if(!$msgid){
         dd('error-line19-mdbxAdminMsgController');}

      remailmsg::destroy($msgid);

      return back();
   }

   public function adminApproveMsg(){
      //get msgid
      $msgid=request('msgid');
      //error if none
      if(!$msgid){
         dd('error-line34-mdbxAdminMsgController');}

      $getMsg=remailmsg::select(
         'created_at','propflyer_id','propagent_id',
         'senderName','senderEmail','msg'
      )
      ->where('msgid','=',"$msgid")
      ->with(['theAgent'=>function($q){
         $q->select('id','agtFullName','agtFirst','agtEmail');
      }])
      ->with(['theFlyer'=>function($q){
         $q->select('id','xFullStreet');
      }])
      ->first();
      if(!$getMsg){
         dd('error-line40-mdbxAdminMsgController');}

      //set Message Variables
      $sendToID=$getMsg['propagent_id'];
      $senderName=$getMsg['senderName'];
      $senderEmail=$getMsg['senderEmail'];
      $senderMsg=$getMsg['msg'];

      //set Email Variables
      $agtEmail      = $getMsg->theAgent->agtEmail;
      $toEmail       = $agtEmail;
      $toName        = $getMsg->theAgent->agtFirst;
      $xFullStreet   = $getMsg->theFlyer->xFullStreet;
      $agtFirst      = $toName;
      $theSubject    = "RealtyEmails Message for $xFullStreet";
      $sendThis      = 'emails.members.propInfoMsg';
      $data          = [
         'senderName'      => $senderName,
         'senderEmail'     => $senderEmail,
         'senderMsg'       => $senderMsg,
         'agtFirst'        => $agtFirst,
         'xFullStreet'     => $xFullStreet,];
      //send message
      include(app_path().'/functions/email/sendEmailTemplate.php');
      //approve message
      remailmsg::where('msgid','=',"$msgid")
      ->update([
         'apprv'=>1
      ]);
      //redirect back
      return back()
      ->with(
            'message',"Message sent to $toEmail ($agtEmail) Successfully!");
   }

}
