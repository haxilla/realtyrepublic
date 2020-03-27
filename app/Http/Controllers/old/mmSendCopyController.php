<?php

namespace App\Http\Controllers;
use Request;
use Validator;
use Illuminate\Support\Facades\Crypt;

class mmSendCopyController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:web');
   }

   public function mmSendCopy ($id, Request $request){

      $validator = Validator::make($request::all(), [
         'toEmail'         => 'Required|email',
         'theSubject'      => 'Required'
      ]);

      //if validator passes
      if ($validator->passes()) {

         $toEmail       = $request::input('toEmail');
         $theSubject    = $request::input('theSubject');

         //get flyer values
         include(app_path() . '/functions/flyerQuery.php');

         $enc = Crypt::encrypt([
            'ufid'=>$id,
            'umid'=>$idMem,
            'cid'=>'mmSendCopy-Member',
            'eid'=>'0',
            'emArea'=>'0',
            'template'=>$template,
            'toEmail'=>$toEmail
         ]);

         //values below come from /functions/flyerQuery.php
         $data = [
            'id'                 => $id,
            'idFly'              => $idFly,
            'enc'                => $enc,
            'xTemplate'          => $template,
            'xMlsNum'            => $xMlsNum,
            'propInfo'           => $propInfo,
            'agentInfo'          => $agentInfo,
            'officeInfo'         => $officeInfo,
            'xBeds'              => $xBeds,
            'xBaths'             => $xBaths,
            'xSqft'              => $xSqft,
            'xYrBuilt'           => $xYrBuilt,
            'xParking'           => $xParking,
            'xPoolPvt'           => $xPoolPvt,
            'xPubRemarks'        => $xPubRemarks,
            'xIntersection'      => $xIntersection,
            'xHeadline'          => $xHeadline,
            'flyer_background'   => $flyer_background,
            'headline_text'      => $headline_text,
            'roundedtop'         => $roundedtop,
            'graphic_words'      => $graphic_words,
            'graphic_textcolor'  => $graphic_textcolor,
            'graphic_style'      => $graphic_style,
            'hlGraphic'          => $hlGraphic,
            'template'           => $template,
            'headline_bar_bg'    => $headline_bar_bg,
            'headline_bar_text'  => $headline_bar_text,
            'accentbars'         => $accentbars,
            'fromURL'            => $fromURL,
            'fromURL2'           => $fromURL2,
            'fromURL3'           => $fromURL3,
            'xHeadline'          => $xHeadline,
            'zipDir'             => $zipDir,
            'mlsDir'             => $mlsDir,
            'defPhotoName'       => $defPhotoName,
            'allPhotos'          => $allPhotos,
            'allCount'           => $allCount,
            'photo2name'         => $photo2name,
            'photo3name'         => $photo3name,
            'photo4name'         => $photo4name,
            'photo5name'         => $photo5name,
            'photo6name'         => $photo6name,
            'photo7name'         => $photo7name,
            'photo8name'         => $photo8name,
            'photo9name'         => $photo9name,
            'photo10name'        => $photo10name,
            'photo1orient'       => $photo1orient,
            'photo2orient'       => $photo2orient,
            'photo3orient'       => $photo3orient,
            'photo4orient'       => $photo4orient,
            'photo5orient'       => $photo5orient,
            'photo6orient'       => $photo6orient,
            'photo7orient'       => $photo7orient,
            'photo8orient'       => $photo8orient,
            'photo9orient'       => $photo9orient,
            'photo10orient'      => $photo10orient,
            'photos8'            => $photos8,
            'totalPhotos'        => $totalPhotos,
            'xb1'                => $xb1,
            'xb2'                => $xb2,
            'xb3'                => $xb3,
            'xb4'                => $xb4,
            'xb5'                => $xb5,
            'xb6'                => $xb6,
            'xb7'                => $xb7,
            'xb8'                => $xb8,
            'agentName'          => $agentName,
            'agtMainPhone'       => $agtMainPhone,
            'agentPhoto'         => $agentPhoto,
            'agentLogo'          => $agentLogo,
            'officeID'           => $officeID,
            'officeName'         => $officeName,
            'officeAddress'      => $officeAddress,
            'officeCity'         => $officeCity,
            'officeState'        => $officeState,
            'officeZip'          => $officeZip,
            'display'            => 'email'
         ];

         \Mail::send('emails.flyerTemplates', $data , function($message) use ($data,$toEmail,$theSubject){
            $message->to($toEmail,'realtyrepublic')
            ->subject($theSubject);
            }
         );


         return \Redirect::route("flyerDash", ['id'=>$id])
         ->with('message', "Email Sent Successfully to $toEmail");
      }

      //back to form with errors
      return back()
      ->withErrors($validator);

   }
}
