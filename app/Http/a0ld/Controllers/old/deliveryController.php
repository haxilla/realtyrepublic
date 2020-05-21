<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\qcreate;
use App\propstyle;
use App\propdelivnow;
use Carbon\Carbon;
use App\propflyerstat;
use App\propmapping;
use App\propmeta;
use App\propremark;
use App\emailareas;
use App\azphxmetro;
use Auth;

class deliveryController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth');
   }

   public function create ($id){

      $xMlsNum=qcreate::where('id','=',"$id")
      ->pluck('xMlsNum')
      ->first();

      return view('members.create.chooseDelivery',[
         'id'=> $id,
         'xMlsNum'=>$xMlsNum
      ]);
   }

   public function store ($id){

      $area1=request('area1');
      $area2=request('area2');
      $emSubject=request('emSubject');
      $sellerEmail=request('sellerEmail');
      $sellerNote=request('sellerNote');
      $xSellerSendOK=0;
      $getCampInfo=qcreate::where('id','=',"$id")
      ->leftJoin('propdelivnow', 'qcreate.id', '=', 'propdelivnow.propflyer_id')
      ->get();

      $xFullStreet   = $getCampInfo[0]['xFullStreet'];
      $xCity         = $getCampInfo[0]['xCity'];
      $xZip          = $getCampInfo[0]['xZip'];

      if($sellerEmail){
         $xSellerSendOK=1;
      }

      $dup1=propdelivnow::where('propflyer_id','=',"$id")
      ->where('emArea','=',"$area1")
      ->pluck('cid')
      ->first();

      $dup2=propdelivnow::where('propflyer_id','=',"$id")
      ->where('emArea','=',"$area2")
      ->pluck('cid')
      ->first();

      //validation

      //no area1 dups
      if($dup1){
         return \Redirect::back()->withErrors("This flyer is already in  the queue for $area1");
      }

      //no area2 dups
      if($dup2){
         return \Redirect::back()->withErrors("This flyer is already in  the queue for $area2");
      }

      //must choose 2 areas
      if($area1 == 'Select' or $area2 == 'Select'){
         return \Redirect::back()->withErrors("Must Choose Both Areas!");
      }

      //2 unique areas
      if($area1==$area2){
         return \Redirect::back()->withErrors("Please Choose 2 different areas!");
      }

      $areaDisplay1=emailareas::where('emArea','=',"$area1")
      ->pluck('emArea_display')
      ->first();

      $areaDisplay2=emailareas::where('emArea','=',"$area2")
      ->pluck('emArea_display')
      ->first();

      //retrieves counts for each area list variable
      //must be named with App path to work
      $appPrefix='\\App';
      $area1Model=$appPrefix . '\\' . $area1;
      $area2Model=$appPrefix . '\\' . $area2;

      $areaCount1=$area1Model::count();
      $areaCount2=$area2Model::count();

      //mark delivery_chosen as complete
      propstyle::where('propflyer_id','=',"$id")
      ->update([
         'delivery_chosen'=>'1'
      ]);

      qcreate::where('id','=',"$id")
      ->update([
         'xApproved'       =>'1',
         'xEmailSubject'   =>$emSubject,
         'xSellerEmail'    =>$sellerEmail,
         'xSellerNote'     =>$sellerNote,
         'xSellerSendOK'   =>$xSellerSendOK
      ]);

      //move to final view
      $template=propstyle::where('propflyer_id','=',"$id")
      ->pluck('template')
      ->first();

      //EXISTING QUEUE RECORD TO MOVE
      $moveQ=qcreate::where('id','=',"$id")
      ->get();

      //SET VARIABLES TO TRANSFER
      $xMlsNum       = $moveQ->first()->xMlsNum;
      $xHeadline     = $moveQ->first()->xHeadline;
      $googlat       = $moveQ->first()->googLat;
      $googlng       = $moveQ->first()->googLng;
      $xIntersection = $moveQ->first()->xIntersection;
      $xPubRemarks   = $moveQ->first()->xPubRemarks;
      $xb1           = $moveQ->first()->xb1;
      $xb2           = $moveQ->first()->xb2;
      $xb3           = $moveQ->first()->xb3;
      $xb4           = $moveQ->first()->xb4;
      $xb5           = $moveQ->first()->xb5;
      $xb6           = $moveQ->first()->xb6;
      $xb7           = $moveQ->first()->xb7;
      $xb8           = $moveQ->first()->xb8;
      $zipDir        = $moveQ->first()->zipDir;
      $mlsDir        = $moveQ->first()->mlsDir;
      $bbSysID       = $moveQ->first()->bbSysID;
      $sysID         = $moveQ->first()->sysID;
      $sk1           = $moveQ->first()->sk1;

      //AGENT ID = CURRENTLY LOGGED IN ID
      $umid=Auth::user()->id;

      //PROPFLYER
      propflyer::where('id','=',"$id")
      ->update([
         'xHeadline' => $xHeadline
      ]);

      //PROPFLYERSTATS - xAgtSent
      $checkstat=propflyerstat::where('propflyer_id','=',"$id")
      ->get()
      ->first();

      if($checkstat){

         $sentAmt=$checkstat['xAgtSent'];

         $sentAmt++;

         propflyerstat::where('propflyer_id','=',"$id")
         ->where('propagent_id','=',"$umid")
         ->update([
            'xAgtSent' => "$sentAmt",
         ]);

      }else{

         propflyerstat::create([
            'propflyer_id' => "$id",
            'propagent_id' => "$umid",
            'xAgtSent'     => 1
         ]);

      }

      //PROP MAPPING - googLat - googLng
      $checkMap=propmapping::where('propflyer_id','=',"$id")
      ->where('propagent_id','=',"$umid")
      ->first();

      if(!$checkMap){
         propmapping::create([
            'propflyer_id'    => $id,
            'propagent_id'    => $umid,
            'googlat'         => $googlat,
            'googlng'         => $googlng,
            'xIntersection'   => $xIntersection
         ]);
      }

      //PROPREMARKS
      $checkRemarks=propremark::where('propflyer_id','=',"$id")
      ->where('propagent_id','=',"$umid")
      ->first();

      if(!$checkRemarks){

         propremark::create([
            'propflyer_id' => $id,
            'propagent_id' => $umid,
            'xPubRemarks'  => $xPubRemarks,
            'xb1'          => $xb1,
            'xb2'          => $xb2,
            'xb3'          => $xb3,
            'xb4'          => $xb4,
            'xb5'          => $xb5,
            'xb6'          => $xb6,
            'xb7'          => $xb7,
            'xb8'          => $xb8
         ]);

      }

      //PROPMETAS
      $checkMeta=propmeta::where('propflyer_id','=',"$id")
      ->where('propagent_id','=',"$umid")
      ->first();

      $sysID=qcreate::where('id','=',"$id")
      ->first()
      ->sysID;

      //if the ID doesnt exist in meta OK to create
      if(!$checkMeta){

         $checkSys=propmeta::where('sysID','=',"$sysID")
         ->first();

         //if sysID does NOT exist OK to add
         if(!$checkSys){

            propmeta::create([
               'propflyer_id' => $id,
               'propagent_id' => $umid,
               'zipDir'       => $zipDir,
               'mlsDir'       => $mlsDir,
               'sysID'        => $sysID,
               'bbSysID'      => $bbSysID,
               'sk1'          => $sk1
            ]);

         //if it DOES exist change & update
         }else{

            $newSysID='x'.$sysID.'x';

            qcreate::where('id','=',"$id")
            ->update([
               'sysID'=>$newSysID
            ]);

            propmeta::create([
               'propflyer_id' => $id,
               'propagent_id' => $umid,
               'zipDir'       => $zipDir,
               'mlsDir'       => $mlsDir,
               'sysID'        => $newSysID,
               'bbSysID'      => $bbSysID,
               'sk1'          => $sk1
            ]);
         }

      //if propflyer_id already exists just update
      }else{

         propmeta::where('propflyer_id','=',"$id")
         ->where('propagent_id','=',"$umid")
         ->update([
            'zipDir'    => $zipDir,
            'mlsDir'    => $mlsDir,
            'sysID'     => $sysID,
            'bbSysID'   => $bbSysID,
            'sk1'       => $sk1
         ]);
      }

      //add area1
      propdelivnow::create([
         'propflyer_id'=>$id,
         'propagent_id'=>Auth::user()->id,
         'emArea'=>$area1,
         'campLabel'=>'area1',
         'emRequest'=>Carbon::now(),
         'emSubject'=>$emSubject,
         'emArea_display'=>$areaDisplay1,
         'totalEmails'=>$areaCount1
      ]);

      //add area2
      propdelivnow::create([
         'propflyer_id'=>$id,
         'propagent_id'=>Auth::user()->id,
         'emArea'=>$area2,
         'campLabel'=>'area2',
         'emRequest'=>Carbon::now(),
         'emSubject'=>$emSubject,
         'emArea_display'=>$areaDisplay2,
         'totalEmails'=>$areaCount2
      ]);

      include(app_path() . '/functions/flyerQuery.php');

      return \Redirect::route('campadded', ['id'=>$id]);
   }

   public function complete ($id){

      $template=propstyle::where('propflyer_id','=',"$id")
      ->pluck('template')
      ->first();

      $xMlsNum=qcreate::where('id','=',"$id")
      ->pluck('xMlsNum')
      ->first();

      $propInfo=qcreate::where('xMlsNum','=',"$xMlsNum")->first();
      $campInfo=propdelivnow::where('propflyer_id','=',"$id")->get();

      include(app_path() . '/functions/flyerQuery.php');

      return view('members.create.campadded',[
         'id'                 => $id,
         'xTemplate'          => $template,
         'xMlsNum'            => $xMlsNum,
         'idFly'              => $idFly,
         'propInfo'           => $propInfo,
         'campInfo'           => $campInfo,
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
         'fromURL'            => 'http://rosemary.dev',
         'xHeadline'          => $xHeadline,
         'zipDir'             => $zipDir,
         'mlsDir'             => $mlsDir,
         'defPhotoName'       => $defPhotoName,
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
}
