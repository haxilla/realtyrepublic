<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class bounceController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function bounceIndexDisplay(){

      include(app_path().'/bounces/bounceIndexDisplay.php');

      return view('bounces.bounceIndexDisplay',[
         'uid'             => $uid,
         'msgCount'        => $msgCount,
         'plainmsg'        => $plainmsg,
         'htmlmsg'         => $htmlmsg,
         'imap_header'     => $imap_header,
         'imap_body'       => $imap_body,
         'imap_fetchbody'  => $imap_fetchbody,
         'msg_header'      => $msg_header,
         'fileName'        => $fileName,
         'fileSubtype'     => $fileSubtype,
      ]);

   }

   public function bounceAuto(Request $request){

      // automated bounce detection
      include(app_path().'/bounces/bounceAuto.php');

      //paginate results
      include(app_path().'/bounces/includes/paginatedSafemail.php');
      include(app_path().'/bounces/includes/paginatedReviewmail.php');
      include(app_path().'/bounces/includes/paginatedJunkmail.php');

      return view('bounces.bounceIndex',[
         'msgCount'        => $msgCount,
         'totalSafemail'   => $totalSafemail,
         'totalReviewmail' => $totalReviewmail,
         'totalJunkmail'   => $totalJunkmail,
         'safemail'        => $paginatedSafemail,
         'reviewmail'      => $paginatedReviewmail,
         'junkmail'        => $paginatedJunkmail,
      ]);

   }

   public function bounceDelete(){

      //set uid
      $uid=request('uid');
      //error if none
      if(!$uid){
         dd('error-line52-bounceController');}

      //stream
      $mbox = imap_open ("{mail.realtye-mails.com:110/pop3}INBOX",
         "members@realtye-mails.com","d4vidb0wi3!");

      imap_delete($mbox, $uid, FT_UID);
      imap_expunge($mbox);
      imap_close($mbox);

      return redirect()->route('admin.bounceAuto');

   }

}
