<?php

namespace App\Http\Controllers;

use Request;
use Validator;
use App\propflyer;
use App\propmeta;
use App\propphoto;

class memberEmailController extends Controller
{

   public function __construct()
   {
      $this->middleware('auth');
   }

   public function showPage($id){

      $propmeta=propmeta::where('propflyer_id','=',"$id")
      ->first();

      if(!$propmeta){
         dd('flyer not found - line 21 memberEmailController');
      }

      $propInfo=propflyer::where('id','=',"$id")
      ->first();

      $zipDir=$propmeta['zipDir'];
      $mlsDir=$propmeta['mlsDir'];

      $defPhotoName=propphoto::where('propflyer_id','=',"$id")
      ->where('def','=','1')
      ->where('resized','=','500')
      ->pluck('photoName')
      ->first();

      include(app_path() . '/functions/fromURL.php');
      $defURL = "$fromURL/hqphotos/$zipDir/$mlsDir/$defPhotoName";

      return view('members.functions.emailCopy',[
         'propInfo'     => $propInfo,
         'defURL'       => $defURL,
      ]);

   }

   public function submitEmailCopy($id, Request $request){

      $validator = Validator::make($request::all(), [
         'toEmail'         => 'Required|email',
         'theSubject'      => 'Required'
      ]);

      //if validator passes
      if ($validator->passes()) {

         $toEmail       = $request::input('toEmail');
         $theSubject    = $request::input('theSubject');

         include(app_path() . '/functions/flyerQuery.php');

         $data = [
            'id'                 => $id,
            'xTemplate'          => $template,
            'xMlsNum'            => $xMlsNum,
            'idFly'              => $idFly,
            'propInfo'           => $propInfo,
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
         ];

         \Mail::send('emails.testing', $data , function($message) use ($data,$toEmail,$theSubject){
            $message->to($toEmail,'realtyrepublic')
            ->subject($theSubject);
            }
         );

         return \Redirect::route("SendCopy", ['id'=>$id])
         ->with('message', 'Email Sent Successfully');

      }

      //back to form with errors
      return back()
            ->withErrors($validator);

   }
}
