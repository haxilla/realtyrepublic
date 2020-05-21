<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\propstyle;
use App\qcreate;

class headlineController extends Controller
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

      if($propInfo['xHeadline']){
         $xHeadline = $propInfo['xHeadline'];
      }else{
         $xHeadline = 'Enter your text here and use the dropdown to the left for a custom graphic';
      }

      include(app_path() . '/functions/flyerQuery.php');

      return view('members.create.chooseHeadline',[
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
         'officeZip'          => $officeZip
      ]);
   }

   public function store($id){

      $xHeadline     = request('xHeadline');
      $graphic_words = request('graphic_words');

      qcreate::where('id','=',"$id")
      ->update([
         'xHeadline'=>$xHeadline
      ]);

      propstyle::where('propflyer_id','=',"$id")
      ->update([
         'graphic_words' =>$graphic_words
      ]);

      return redirect()->back();
   }

   public function complete ($id){

      propstyle::where('propflyer_id','=',"$id")
      ->update([
         'headline_chosen' =>1,
      ]);

      qcreate::where('id','=',"$id")
      ->update([
         'xHeadline' => request('xHeadline')
      ]);

      include(app_path() . '/functions/findNextPage.php');
      return \Redirect::route("$nextURL", ['id'=>$id]);

   }

   public function edit($xMlsNum){

      include(app_path() . '/functions/hlGraphic.php');

   }

   public function style($id,$style){

      include(app_path() . '/functions/hlStyle.php');

      return redirect()->back();

   }

   public function jSave(){

      $xMlsNum=request('xMlsNum');
      $xHeadline=request('xHeadline');
      $graphic_words=request('graphic_words');
      $id=qcreate::where('xMlsNum','=',"$xMlsNum")
      ->pluck('id')
      ->first();

      if($graphic_words !== 'Select'){
         propstyle::where('propflyer_id','=',"$id")
         ->update([
            'graphic_words' => $graphic_words
         ]);
      }

      qcreate::where('xMlsNum','=',"$xMlsNum")
      ->update([
         'xHeadline' => $xHeadline
      ]);

   }

   public function ojSave($option,$xMlsNum){

      $id=qcreate::where('xMlsNum','=',"$xMlsNum")
      ->pluck('id')
      ->first();

      if($option !== 'Select'){
         propstyle::where('propflyer_id','=',"$id")
         ->update([
            'graphic_words' => $option
         ]);
      }
   }

   public function textSave($xMlsNum){

      $xHeadline=request('xHeadline');

      qcreate::where('xMlsNum','=',"$xMlsNum")
      ->update([
         'xHeadline' =>$xHeadline
      ]);

   }

}
