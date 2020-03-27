<?php

namespace App\Http\Controllers;

use Request;
use Validator;
use App\Mail\testing;
use App\propflyer;
use App\propstyle;
use App\propphoto;
use App\propmeta;
use App\propdeliv;
use App\propdelivnow;
use Illuminate\Support\Facades\Crypt;

class adminEmailController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:admin');
   }


   public function admSendEmailForm($id){

      $propmeta=propmeta::where('propflyer_id','=',"$id")
      ->first();

      $defTemplate=propstyle::where('propflyer_id','=',"$id")
      ->pluck('template')
      ->first();

      //check for email subject
      $emSubjectNow=propdelivnow::where('propflyer_id','=',"$id")
      ->orderBy('emRequest','desc')
      ->first();
      $emSubjectArch=propdeliv::where('propflyer_id','=',"$id")
      ->orderBy('emRequest','desc')
      ->first();

      if($emSubjectNow){
         $xEmailSubject=$emSubjectNow->emSubject;
      }elseif($emSubjectArch){
         $xEmailSubject=$emSubjectArch->emSubject;
      }else{
         $xEmailSubject=null;
      }

      if(!$propmeta){

         $propInfo=qcreate::where('id','=',"$id")
         ->first();

         $zipDir=$propInfo->zipDir;
         $mlsDir=$propInfo->mlsDir;

      }else{

         $propInfo=propflyer::where('id','=',"$id")
         ->first();

         $zipDir=$propmeta->zipDir;
         $mlsDir=$propmeta->mlsDir;
      }

      $defPhotoName=propphoto::where('propflyer_id','=',"$id")
      ->where('resized','=','500')
      ->where('def','=','1')
      ->pluck('photoName')
      ->first();

      if(!$zipDir || !$mlsDir || !$defPhotoName){
         dd('error line 47 adminEmailController');
      }

      include(app_path() . '/functions/fromURL.php');

      $defURL = "$fromURL/hqphotos/$zipDir/$mlsDir/$defPhotoName";

      return view('admin.functions.sendEmailForm',[

         'propInfo'        => $propInfo,
         'defURL'          => $defURL,
         'xFullStreet'     => $propInfo->xFullStreet,
         'id'              => $id,
         'idMem'           => $propInfo->propagent_id,
         'xEmailSubject'   => $xEmailSubject,
         'defTemplate'     => $defTemplate

      ]);

   }

   public function admSubmitEmailCopy($id, Request $request){

      $validator = Validator::make($request::all(), [
         'toEmail'         => 'Required|email',
         'theSubject'      => 'Required'
      ]);

      //if validator passes
      if ($validator->passes()) {

         $toEmail       = $request::input('toEmail');
         $theSubject    = $request::input('theSubject');
         $theTemplate   = $request::input('theTemplate');

         include(app_path() . '/functions/flyerQuery.php');

         //override default template if admin chose one
         if($theTemplate !=='Select'){
            $template=$theTemplate;
         }

         $enc = Crypt::encrypt([
            'ufid'=>$id,
            'umid'=>$idMem,
            'cid'=>'adminTest',
            'eid'=>'0',
            'emArea'=>'0',
            'template'=>$template,
            'toEmail'=>$toEmail
         ]);

         $data = [
            'id'                 => $id,
            'xTemplate'          => $template,
            'enc'                => $enc,
            'xMlsNum'            => $xMlsNum,
            'idFly'              => $idFly,
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
         ];

         \Mail::send('emails.flyerTemplates', $data , function($message) use ($data,$toEmail,$theSubject){
            $message->to($toEmail,'realtyrepublic')
            ->subject($theSubject);
            }
         );

         return \Redirect::route("adminSendCopy", ['id'=>$id])
         ->with('message', 'Email Sent Successfully');

      }

      //back to form with errors
      return back()
         ->withErrors($validator);

   }

   public function adminEmailTest($id){

      //\Mail::to('realtyemails2@gmail.com')
      //->send(new testing()); //original working

      include(app_path() . '/functions/flyerQuery.php');

      $data = [
         'id'                 => $id,
         'xTemplate'          => $template,
         'xMlsNum'            => $xMlsNum,
         'idFly'              => $idFly,
         'xBeds'              => $xBeds,
         'xBaths'             => $xBaths,
         'xSqft'              => $xSqft,
         'xYrBuilt'           => $xYrBuilt,
         'xPoolPvt'           => $xPoolPvt,
         'xParking'           => $xParking,
         'xZip'               => $xZip,
         'propInfo'           => $propInfo,
         'agentInfo'          => $agentInfo,
         'officeInfo'         => $officeInfo,
         'xHeadline'          => $xHeadline,
         'xIntersection'      => $xIntersection,
         'xPubRemarks'        => $xPubRemarks,
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
      ];

      \Mail::send('emails.testing', $data , function($message) use ($data){
         $message->to('realtyemails2@gmail.com', 'RealtyEmails')
         ->subject('check this one out ok?');
         }
      );

   }
}

