<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\qcreate;
use App\bbfirstimport;
use App\bbupdate;
use App\propstyle;
use Validator;
use Auth;

class importController extends Controller
{

   public function __construct()
   {
      $this->middleware('auth:user');
   }

   public function remoteInsert(){

      //retrieve user input
      $xMlsNum=request('xMlsNum');
      $sysID=request('sysID');
      $umid=Auth::user()->id;

      $checkQ=qcreate::where('xMlsNum','=',"$xMlsNum")
      ->where('propagent_id','=',"$umid")
      ->first();

      if($checkQ){

         //json output //array()
         $idArray = array(
            'status'      => 'Duplicate',
            'xMlsNum'     => $xMlsNum,
            'sk1'         => $checkQ->sk1,
            'id'          => $checkQ->id
         );

         return json_encode($idArray);

      }

      $getImports=qcreate::
      select('xFullStreet',
               'xUnitNum',
               'xUnitDesig',
               'xCity',
               'xState',
               'xZip',
               'xCountyName',
               'dpv',
               'sk1',
               'bbSysID'
            )
      ->where('sysID',"$sysID")
      ->first();

      $bbSysID=$getImports['bbSysID'];

      //create ids for export
      qcreate::where('sysID','=',"$sysID")
      ->update([
         'xMlsNum'   => $xMlsNum,
         'zipDir'    => $getImports->xZip,
         'mlsDir'    => $xMlsNum
      ]);

      //does a record already exist with this MLS#?
      $bbfirstimport=bbfirstimport::where('ixMlsNum','=',"$xMlsNum")
      ->first();

      //   ***   if so find and delete   ***
      if($bbfirstimport){
         $bbDelete = bbfirstimport::find($bbfirstimport['ixMlsNum']);
         $bbDelete->delete();
      }

      //does a record already exist with this sysID?
      $bbSysImport=bbfirstimport::where('ibbSysID','=',"$bbSysID")
      ->pluck('ibbSysID')
      ->first();

      //   ***   if so find and delete   ***
      if($bbSysImport){
         $bbDelete = bbfirstimport::where('ibbSysID','=',"$bbSysImport");
         $bbDelete->delete();
      }

      //Create Record at remote host
      bbfirstimport::create([
         'ibbSysID'     => $getImports->bbSysID,
         'ixMlsNum'     => $xMlsNum,
         'isk1'         => $getImports->sk1,
         'im'           => Auth::user()->id,
         'idpv'         => $getImports->dpv,
         'ixCounty'     => $getImports->xCountyName,
         'ixZip'        => $getImports->xZip,
         'ixState'      => $getImports->xState,
         'ixCity'       => $getImports->xCity,
         'ixUnitNum'    => $getImports->xUnitNum,
         'ixUnitDesig'  => $getImports->xUnitDesig,
         'ixFullStreet' => $getImports->xFullStreet
      ]);

      //Create remote log Entry
      bbupdate::create([
         'sysID'        => $getImports->bbSysID,
         'statusCode'   => 'ok',
         'adminStep'    => 0,
         'statusText'   => 'Record inserted - Ready!',
         'friendlyText' => 'Please Wait...',
         'newKey'       => $getImports->sk1
      ]);

      //json output //array()
      $idArray = array(
         'status'      => 'importReady',
         'xMlsNum'     => $xMlsNum,
         'sk1'         => $getImports->sk1
      );

      echo json_encode($idArray);

   }

   //Check Progress
   public function checkProgress($xMlsNum){

      $sk1=qcreate::where('xMlsNum','=',"$xMlsNum")
      ->pluck('sk1')
      ->first();

      //security check
      // ********************************************
      // if locBBsysID != remBBsysID

      //get local
      $locBBsysID=qcreate::where('sk1','=',"$sk1")
      ->pluck('bbSysID')
      ->first();

      //get remote
      $remBBsysID=bbupdate::where('newKey','=',"$sk1")
      ->pluck('sysID')
      ->first();

      include(app_path() . '/bbimp/checkProgress.php');

   }

   //Start Import
   public function startImport($sk1){

      include(app_path() . '/bbimp/startImport.php');

   }

   //Start Photo Import
   public function startPhotoDL($sk1){

      include(app_path() . '/bbimp/startPhotoDL.php');

   }

   public function checkPhotoDL($sk1){

      include(app_path() . '/bbimp/checkPhotoDL.php');

   }

   public function complete($xMlsNum){

      $id=qcreate::where('xMlsNum','=',"$xMlsNum")
      ->pluck('id')
      ->first();

      $idMem=qcreate::where('id','=',"$id")
      ->pluck('propagent_id')
      ->first();

      $getStyle  = propstyle::where('propflyer_id','=',"$id")->first();
      $xTemplate = $getStyle['template'];

      //if no style put in some basics
      if(!$getStyle){

         //Create Entry
         propstyle::create([
            'propflyer_id'       => $id,
            'propagent_id'       => $idMem,
            'flyer_background'   => 'cccccc',
            'headline_bar_bg'    => '333333',
            'headline_bar_text'  => 'ffffff',
            'headline_text'      => '333333',
            'graphic_words'      => 'greatbuy',
            'graphic_textcolor'  => 'ffffff',
            'graphic_style'      => 'ul',
            'roundedtop'         => 'roundedtop-600px_cccccc.gif',
            'accentbars'         => '333333',
            'template'           => 's1pc'
         ]);

         //rerun query if inserted
         $getStyle=propstyle::where('propflyer_id','=',"$id")->first();

      }//end if statement

      //include the flyerQuery for remaining values
      include(app_path() . '/functions/flyerQuery.php');

      //set Headline if none
      if(!$xHeadline){
         $xHeadline = 'You will be able to change and add a custom header and text here. First pick a style!';
      }

      //bring to flyer landing
      return view ('members.flyerLanding',
      [
         'xMlsNum'            => $xMlsNum,
         'idFly'              => $id,
         'id'                 => $id,
         'totalPhotos'        => $totalPhotos,
         'allCount'           => $allCount,
         'xTemplate'          => $xTemplate,
         'propInfo'           => $propInfo,
         'flyerInfo'          => $propInfo,
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
         'xb1'                => $xb1,
         'xb2'                => $xb2,
         'xb3'                => $xb3,
         'xb4'                => $xb4,
         'xb5'                => $xb5,
         'xb6'                => $xb6,
         'xb7'                => $xb7,
         'xb8'                => $xb8,
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

   } //end function
}//end controller class



