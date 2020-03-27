<?php

namespace App\Http\Controllers;
use App\qcreate;
use App\propstyle;

use Illuminate\Http\Request;

class approveFlyerController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth');
   }

   public function create($id){

      $template=propstyle::where('propflyer_id','=',"$id")
      ->pluck('template')
      ->first();

      $xMlsNum=qcreate::where('id','=',"$id")
      ->pluck('xMlsNum')
      ->first();

      $propInfo=qcreate::where('xMlsNum','=',"$xMlsNum")->first();

      include(app_path() . '/functions/flyerQuery.php');

      return view('members.create.approveflyer',[
         'id'                 => $id,
         'xTemplate'          => $template,
         'xMlsNum'            => $xMlsNum,
         'idFly'              => $idFly,
         'propInfo'           => $propInfo,
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
         'fromURL'            => 'http://rosemary.dev',
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
         'photos8'            => $photos8,
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
         'officeZip'          => $officeZip
      ]);
   }

   public function complete ($id){

      propstyle::where('propflyer_id','=',"$id")
      ->update([
         'approve_chosen' => '1'
      ]);

      $xMlsNum=qcreate::where('id','=',"$id")
      ->pluck('xMlsNum')
      ->first();

      return redirect()->action(
          'deliveryController@create', ['id' => $id,'xMlsNum'=>$xMlsNum]
      );
   }
}
