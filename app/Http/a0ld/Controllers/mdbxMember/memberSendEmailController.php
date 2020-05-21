<?php

namespace App\Http\Controllers\mdbxMember;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Crypt;
use Validator;
use Request;
use Auth;

class memberSendEmailController extends Controller
{
    //authorized only
   public function __construct()
   {
      $this->middleware('auth:member');
   }

   //Send Copy
   public function emailFlyerCopy(Request $request){
      //security
      include(app_path().'/flyerVariables/existingFlyerCheck.php');
      $validator = Validator::make($request::all(), [
         'toEmail'         => 'Required|email',
         'theSubject'      => 'Required'
      ]);

      //if validator passes
      if ($validator->passes()) {

         $toEmail       = $request::input('toEmail');
         $theSubject    = $request::input('theSubject');
         $theComments   = $request::input('theComments');

         //propInfo,agentInfo,officeInfo, etc
         include(app_path() . '/queries/mdbxMainQueries.php');
         //created variables from above queries
         include(app_path() . '/flyerVariables/mdbxSetVars.php');
         //assigns fromURL depending on server
         include(app_path() . '/flyerVariables/mdbxfromURL.php');
         //count Bullets & set bullets_LH
         include(app_path() . '/flyerVariables/mdbxCountBullets.php');

         $enc = Crypt::encrypt([
            'ufid'=>$idFly,
            'umid'=>$umid,
            'cid'=>'0',
            'eid'=>'0',
            'emArea'=>'mdbxSendCopy',
            'template'=>$theTemplate,
            'linkPage'=>'mdbxSendCopy',
            'toEmail'=>$toEmail
         ]);

         //values below come from /functions/mdbx/mdbxSetVars
         $data = [
            'enc'                => $enc,
            'theComments'        => $theComments,
            'flyer_background'   => $flyer_background,
            'graphic_words'      => $graphic_words,
            'graphic_style'      => $graphic_style,
            'hlGraphic'          => $hlGraphic,
            'theTemplate'        => $theTemplate,
            'theHeadline'        => $theHeadline,
            'totalPhotos'        => $totalPhotos,
            'newRemID'           => $newRemID,
            'propInfo'           => $propInfo,
            'officeID'           => $officeID,
            'agtPhoto'           => $agtPhoto,
            'agtLogo'            => $agtLogo,
            'display'            => 'email',
            'fromURL1'           => $fromURL1,
            'fromURL2'           => $fromURL2,
            'fromURL3'           => $fromURL3,
            'zipDir'             => $zipDir,
            'mlsDir'             => $mlsDir,
            'bullets_LH'         => $bullets_LH,
         ];

         \Mail::send('emails.flyerTemplates',
         $data,
         function($message) use ($data,$toEmail,$theSubject){
            $message->to($toEmail,'realtyrepublic')
            ->subject($theSubject);
         });

         return \Redirect::route("member.flyerBranch", ['id'=>$id])
         ->with('message', "Email Sent Successfully to $toEmail");
      }

      //back to form with errors
      return back()->withInput()
      ->withErrors($validator);

   }
}
