<?php

namespace App\Http\Controllers;

use Request;
use Auth;
use App\propremark;
use App\propflyer;
use App\propstyle;
use App\propmeta;
use App\propphoto;
use App\propflyerstat;
use Illuminate\Support\Facades\Crypt;

class flyerdashController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:web');
   }

   public function showDash($id){

      $umid=Auth::user()->id;

      $thisFlyer=propflyer::where('id','=',"$id")
      ->where('propagent_id','=',"$umid")
      ->first();

      if(!$thisFlyer){
         dd('error processing this flyer! Line30-flyerDashController');
      }

      //includes
      include(app_path() . '/functions/flyerQuery.php');
      include(app_path() . '/functions/newFlyerLogic.php');
      include(app_path() . '/queries/otherFlyers.php');

      $propmeta=propmeta::select(['zipDir','mlsDir'])
      ->where('propflyer_id','=',"$id")
      ->where('propagent_id','=',"$umid")
      ->first();

      $xAgtSent=propflyerstat::where('propflyer_id','=',"$id")
      ->where('propagent_id','=',"$umid")
      ->pluck('xAgtSent')
      ->first();

      $propPhotos=propphoto::where('propflyer_id','=',"$id")
      ->where('propagent_id','=',"$umid")
      ->where('resized','=','500')
      ->get();

      $propRemarks=propremark::where('propflyer_id','=',"$id")
      ->where('propagent_id','=',"$umid")
      ->first();

      $photoName=propphoto::where('propflyer_id','=',"$id")
      ->where('def','=','1')
      ->where('resized','=','500')
      ->pluck('photoName')
      ->first();

      $zipDir=$propmeta['zipDir'];
      $mlsDir=$propmeta['mlsDir'];

      $enc = Crypt::encrypt([
         'ufid'      => $id,
         'umid'      => $idMem,
         'cid'       => '0',
         'eid'       => '0',
         'emArea'    => '0',
         'template'  => $theTemplate,
         'linkPage'  => 'flyerDash',
         'toEmail'   => 'Screen View'
      ]);

      return view('members.flyerDash',[
         'propRemarks'        => $propRemarks,
         'propPhotos'         => $propPhotos,
         'bulletCount'        => $bulletCount,
         'bullets_LH'         => $bullets_LH,
         'enc'                => $enc,
         'otherFlyers'        => $otherFlyers,
         'thisFlyer'          => $thisFlyer,
         'zipDir'             => $zipDir,
         'mlsDir'             => $mlsDir,
         'photoName'          => $photoName,
         'theTemplate'        => $theTemplate,
         'xAgtSent'           => $xAgtSent,
         'id'                 => $id,
         'templateChosen'     => $templateChosen,
         'colorsChosen'       => $colorsChosen,
         'headlineChosen'     => $headlineChosen,
         'showHL'             => $showHL,
         'showTemplate'       => $showTemplate,
         'showColors'         => $showColors,
         'xMlsNum'            => $xMlsNum,
         'idFly'              => $idFly,
         'propInfo'           => $propInfo,
         'xHeadline'          => $xHeadline,
         'flyer_background'   => $flyer_background,
         'headline_text'      => $headline_text,
         'roundedtop'         => $roundedtop,
         'graphic_words'      => $graphic_words,
         'graphic_textcolor'  => $graphic_textcolor,
         'graphic_style'      => $graphic_style,
         'hlGraphic'          => $hlGraphic,
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
         'defPhotoID'         => $defPhotoID,
         'allPhotos'          => $allPhotos,
         'allCount'           => $allCount,
         'totalPhotos'        => $totalPhotos,
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
         'photo2id'           => $photo2id,
         'photo3id'           => $photo3id,
         'photo4id'           => $photo4id,
         'photo5id'           => $photo5id,
         'photo6id'           => $photo6id,
         'photo7id'           => $photo7id,
         'photo8id'           => $photo8id,
         'photo9id'           => $photo9id,
         'photo10id'          => $photo10id,
         'photos8'            => $photos8,
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
         'agentInfo'          => $agentInfo,
         'officeInfo'         => $officeInfo,
         'display'            => 'screen'
      ]);

   }

}
