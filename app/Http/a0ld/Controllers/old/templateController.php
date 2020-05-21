<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\qcreate;
use App\propstyle;

class templateController extends Controller
{

   public function __construct(){
      $this->middleware('auth');
   }

   public function show($id){

      //include the flyerQuery for remaining values
      include(app_path() . '/functions/flyerQuery.php');

      //set Headline if none
      if(!$xHeadline){
         $xHeadline = 'You will be able to change and add a custom header and text here. First pick a style!';
      }

      //bring them to flyer landing
      return view ('members.create.flyerLanding',
      [
         'xMlsNum'            => $xMlsNum,
         'idFly'              => $idFly,
         'id'                 => $id,
         'xTemplate'          => $xTemplate,
         'agentInfo'          => $agentInfo,
         'propInfo'           => $propInfo,
         'officeInfo'         => $officeInfo,
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
         'xb1'                => $xb1,
         'xb2'                => $xb2,
         'xb3'                => $xb3,
         'xb4'                => $xb4,
         'xb5'                => $xb5,
         'xb6'                => $xb6,
         'xb7'                => $xb7,
         'xb8'                => $xb8,
         'xIntersection'      => $xIntersection,
         'xPubRemarks'        => $xPubRemarks,
         'allCount'           => $allCount,
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
         'totalPhotos'        => $totalPhotos
      ]);
   }

   public function update ($style,$id){

      propstyle::where('propflyer_id','=',"$id")
      ->update([
         'template' => $style
      ]);

      return back();

   }

   public function save ($style,$id){

      propstyle::where('propflyer_id','=',"$id")
      ->update([
         'template_chosen' => 1,
         'template'        => $style
      ]);

      include(app_path() . '/functions/findNextPage.php');
      return \Redirect::route("$nextURL", ['id'=>$id]);

   }

}
