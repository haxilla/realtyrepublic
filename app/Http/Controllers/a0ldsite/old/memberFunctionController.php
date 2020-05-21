<?php

namespace App\Http\Controllers;

use Request;
use App\propflyer;
use App\propagent;
use App\propflyerstat;
use App\propmeta;
use App\propmapping;
use App\propremark;
use App\propphoto;
use App\propstyle;
use App\qcreate;
use App\bbfirstimport;
use App\bbupdate;
use App\propdelivnow;
use App\agtoffice;
use App\emailareas;
use Auth;
use Redirect;
use Validator;

class memberFunctionController extends Controller
{

   public function __construct()
   {
      $this->middleware('auth:web');
   }


   public function qDeleteConf($id){

      //this function runs through
      //an ajax call route and
      //returns values to a modal

      $getData=qcreate::where('id','=',"$id")
      ->first();

      $getPhoto=propphoto::where('propflyer_id','=',"$id")
      ->where('def','=','1')
      ->where('resized','=','500')
      ->first();

      $xFullStreet   = $getData['xFullStreet'];
      $xCity         = $getData['xCity'];
      $xState        = $getData['xState'];
      $xZip          = $getData['xZip'];
      $zipDir        = $getData['zipDir'];
      $mlsDir        = $getData['mlsDir'];
      $defPhotoName  = $getPhoto['photoName'];

      // need to check for existence of said photo
      // and create proper URL before defining def URL
      include(app_path() . '/functions/fromURL.php');
      $defURL = "$fromURL/hqphotos/$zipDir/$mlsDir/$defPhotoName";

      //json output
      $idArray = array(
         'xFullStreet'  => $xFullStreet,
         'xCity'        => $xCity,
         'xState'       => $xState,
         'xZip'         => $xZip,
         'id'           => $id,
         'defPhotoURL'  => $defURL
      );

      echo json_encode($idArray);

   }

   public function qDelete($id){

      $umid=Auth::user()->id;
      //deletes wont work unless done by primary key
      //match record to fetch id

      $checkQ=qcreate::where('id','=',"$id")
      ->where('propagent_id','=',"$umid")
      ->first();

      if(!$checkQ){
         dd('error deleting this flyer! Line 82 memberFunctionController');
      }

      $zipDir=$checkQ['zipDir'];
      $mlsDir=$checkQ['mlsDir'];

      //propflyer *****************************************
      $hasFlyer=propflyer::
      where('id','=',"$id")
      ->where('propagent_id','=',"$umid")
      ->first();

      if($hasFlyer){
         $theFlyer = propflyer::find($id);
         $theFlyer->delete();
      }

      //propmeta *****************************************
      $hasMeta=propmeta::where('propflyer_id','=',"$id")
      ->first();

      if($hasMeta){
         $theMeta = propmeta::find($id);
         $theMeta->delete();
      }

      //propstyle ****************************************
      $hasStyle=propstyle::where('propflyer_id','=',"$id")
      ->first();

      if($hasStyle){
         $theStyle = propstyle::find($id);
         $theStyle->delete();
      }

      //propmapping ******************************************
      $hasMapping=propmapping::where('propflyer_id','=',"$id")
      ->first();

      if($hasMapping){
         $theMapping = propmapping::find($id);
         $theMapping->delete();
      }

      //propremarks ******************************************
      $hasRemarks=propremark::where('propflyer_id','=',"$id")
      ->first();

      if($hasRemarks){
         $theRemark = propremark::find($id);
         $theRemark->delete();
      }

      //propflyerstats ***************************************
      $hasStats=propflyerstat::where('propflyer_id','=',"$id")
      ->first();

      if($hasStats){
         $theStat = propstat::find($id);
         $theStat->delete();
      }

      //propphotos *******************************************
      $hasPhotos=propphoto::where('propflyer_id','=',"$id")
      ->get();

      if($hasPhotos->first()){

         foreach($hasPhotos as $hp){

            $filePath="hqphotos/$zipDir/$mlsDir/$hp->photoName";

            if(file_exists($filePath)){

               //delete file
               unlink($filePath);

               //delete from database
               $thePhoto = propphoto::find($hp->photoID);
               $thePhoto->delete();

            }else{

               //delete from database
               $thePhoto = propphoto::find($hp->photoID);
               $thePhoto->delete();

            }
         }
      }

      $theQ = qcreate::find($id);
      $theQ->delete();

      return redirect()->back();

   }

   public function qResume($id){

      include(app_path() . '/functions/findNextPage.php');

      if($nextURL=='preImport'){
         return \Redirect::route("$nextURL", ['xMlsNum'=>$xMlsNum]);
      }else{
         return \Redirect::route("$nextURL", ['id'=>$id]);
      }

   }

   public function qEdit($id){

      $template=propstyle::where('propflyer_id','=',"$id")
      ->pluck('template')
      ->first();

      $xMlsNum=qcreate::where('id','=',"$id")
      ->pluck('xMlsNum')
      ->first();

      $propInfo=qcreate::where('xMlsNum','=',"$xMlsNum")
      ->first();

      $campInfo=propdelivnow::where('propflyer_id','=',"$id")
      ->get();

      $theStep=propstyle::where('propflyer_id','=',"$id")
      ->pluck('delivery_chosen')
      ->first();

      include(app_path() . '/functions/flyerQuery.php');

      return view('members.create.qEdit',[
         'id'                 => $id,
         'xTemplate'          => $template,
         'theStep'            => $theStep,
         'xMlsNum'            => $xMlsNum,
         'idFly'              => $idFly,
         'agentInfo'          => $agentInfo,
         'officeInfo'         => $officeInfo,
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
         'fromURL'            => $fromURL,
         'fromURL2'           => $fromURL2,
         'fromURL3'           => $fromURL3,
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

   public function qUpload($id){

      include(app_path() . '/functions/dzupload.php');

   }

   public function qDeleteCamp($cid,$id){

      $theCamp = propdelivnow::find($cid);
      $theCamp->delete();
      $umid=Auth::user()->id;

      $checkR=propdelivnow::where('propflyer_id','=',"$id")
      ->where('propagent_id','=',"$umid")
      ->first();

      if(!$checkR){

         propstyle::where('propflyer_id','=',"$id")
         ->update([
            'delivery_chosen' => 0,
         ]);

         qcreate::where('id','=',"$id")
         ->update([
            'xApproved'       => null,
            'xEmailSubject'   => null
         ]);

      }

      return back();
   }

   public function allPhotos($id){

      $check1=qcreate::where('id','=',"$id")
      ->first();

      $check2=propflyerstat::where('propflyer_id','=',"$id")
      ->first();

      if($check2){

         dd('public');

      }elseif($check1){

         $details=qcreate::where('id','=',"$id")
         ->get();

         $highlights = $details;
         $mappings   = $details;

         $agtID         = $details->first()->propagent_id;
         $zipDir        = $details->first()->zipDir;
         $mlsDir        = $details->first()->mlsDir;
         $xFullStreet   = $details->first()->xFullStreet;
         $xCity         = $details->first()->xCity;
         $xState        = $details->first()->xState;
         $xxBeds        = $details->first()->xxBeds;
         $xxBaths       = $details->first()->xxBaths;
         $xxSqft        = $details->first()->xxSqft;
         $xListPrice    = $details->first()->xListPrice;
         $theHeadline   = $details->first()->xHeadline;
         $intersection  = $details->first()->xIntersection;


         foreach($mappings as $map){

            if($map->googlat){

               $googlat=$map->googlat;
               $googlng=$map->googlng;

            }else{

               include('includes/functions/getSEO.php');

            }
         }

         $agents=propagent::where('id','=',"$agtID")
         ->get();

         $offices = agtoffice::select('officeName')
          ->where("propagent_id","=","$agtID")
          ->get();

         $agtName    = $agents->first()->agtFullName;
         $officeName = $offices->first()->officeName;
         $fbURL      = "http://www.realtyrepublic.com/propinfo/$id";

         $defPhoto = propphoto::select('photoName')
            ->where('resized','=','500')
            ->where('propflyer_id','=',"$id")
            ->where('def','=','1')
            ->get();

         $defPhotoFB=$defPhoto->first()->photoName;
         $twitText=urlEncode("$xFullStreet - $xCity, $xState
            - $xxBeds Beds / $xxBaths Baths $xxSqft sqft - $"
            .number_format($xListPrice));

         $photos = propphoto::select('photoName')
         ->where('resized','=','500')
         ->where('propflyer_id','=',"$id")
         ->orderby('def','desc')
         ->get();

         $newHeadline=str_replace('<br>', ' ', $theHeadline);

         return view('members.loginPropDetails',[
            'details'      => $details,
            'id'           => $id,
            'agtName'      => $agtName,
            'agents'       => $agents,
            'fbURL'        => $fbURL,
            'zipDir'       => $zipDir,
            'mlsDir'       => $mlsDir,
            'defPhotoFB'   => $defPhotoFB,
            'twitText'     => $twitText,
            'photos'       => $photos,
            'newHeadline'  => $newHeadline,
            'highlights'   => $highlights,
            'mappings'     => $mappings,
            'intersection' => $intersection,
            'googlat'      => $googlat,
            'googlng'      => $googlng,
            'officeName'   => $officeName
         ]);

      }else{

         dd('does not exist - line 428 memfunction_controller');

      }

   }

   public function addCampaigns($id){

      $details=propflyer::where('id','=',"$id")
      ->first();

      $getDirs=propmeta::select('mlsDir','zipDir')
      ->where('propflyer_id','=',"$id")
      ->first();

      $defPhotoName=propphoto::where('propflyer_id','=',"$id")
      ->where('def','=','1')
      ->pluck('photoName')
      ->first();

      $umid          = $details['propagent_id'];
      $xFullStreet   = $details['xFullStreet'];

      $zipDir  = $getDirs['zipDir'];
      $mlsDir  = $getDirs['mlsDir'];

      $src  = 'http://www.realtyemails.com/hqphotos/'.$zipDir.'/'.$mlsDir.'/'.$defPhotoName;
      $src2 = 'http://www.realtyrepublic.com/hqphotos/'.$zipDir.'/'.$mlsDir.'/'.$defPhotoName;

      if (@getimagesize($src)) {
         $fromURL='http://www.RealtyEmails.com';
      }elseif(@getimagesize($src2)){
         $fromURL='http://www.RealtyRepublic.com';
      }else{
         $fromURL='http://www.rosemary.dev';
      }

      $defPhotoURL="$fromURL/hqphotos/$zipDir/$mlsDir/$defPhotoName";

      $otherCamps=propdelivnow::where('propflyer_id','=',"$id")
      ->get();

      if($otherCamps->first()){
         $others=1;
      }else{
         $others=0;
      }

      return view('members.create.addCampaigns',[
         'id'           =>$id,
         'umid'         =>$umid,
         'defPhotoURL'  =>$defPhotoURL,
         'xFullStreet'  =>$xFullStreet,
         'otherCamps'   =>$otherCamps,
         'others'       =>$others
      ]);

   }

   public function postCampaigns($id){

      $area1     = request('area1');
      $area2     = request('area2');
      $umid      = Auth::user()->id;

      $checkDup1=propdelivnow::where('propflyer_id','=',"$id")
         ->where('emArea','=',"$area1")
         ->pluck('emArea_display')
         ->first();

      $checkDup2=propdelivnow::where('propflyer_id','=',"$id")
         ->where('emArea','=',"$area2")
         ->pluck('emArea_display')
         ->first();

      if($area1=='Select' or $area2=='Select'){
         return Redirect::back()
         ->withErrors(['Please select BOTH areas!']);
      }

      if($area1==$area2){
         return Redirect::back()
         ->withErrors(['Please Choose 2 DIFFERENT Areas']);
      }

      if($checkDup1 or $checkDup2){
         if($checkDup1){
            return Redirect::back()
            ->withErrors(["You already have a campaign in $checkDup1"]);
         }

         if($checkDup2){
            return Redirect::back()
            ->withErrors(["You already have a campaign in $checkDup2 "]);
         }
      }

      //if they arent redirected by any of the above code add
      //get camplabel
      $campCount=propdelivnow::where('propflyer_id','=',"$id")
      ->where('propagent_id','=',"$umid")
      ->count();

      $campNum1=$campCount+1;
      $campNum2=$campCount+2;
      $camplabel1='area'."$campNum1";
      $camplabel2='area'."$campNum2";

      //retrieves counts for each area list variable
      //must be named with App path to work
      $appPrefix='\\App';
      $area1Model=$appPrefix . '\\' . $area1;
      $area2Model=$appPrefix . '\\' . $area2;

      $areaCount1=$area1Model::count();
      $areaCount2=$area2Model::count();

      //get display name
      $emDisplay1=emailareas::where('emArea','=',"$area1")
      ->pluck('emArea_display')
      ->first();

      $emDisplay2=emailareas::where('emArea','=',"$area2")
      ->pluck('emArea_display')
      ->first();

      $now = \Carbon\Carbon::now();
      $emSubject=qcreate::where('id','=',"$id")
      ->pluck('xEmailSubject')
      ->first();

      propdelivnow::create([
         'propflyer_id'    => $id,
         'propagent_id'    => $umid,
         'emArea'          => $area1,
         'emArea_display'  => $emDisplay1,
         'camplabel'       => $camplabel1,
         'emRequest'       => $now,
         'totalEmails'     => $areaCount1,
         'emSubject'       => $emSubject
      ]);

      propdelivnow::create([
         'propflyer_id'    => $id,
         'propagent_id'    => $umid,
         'emArea'          => $area2,
         'emArea_display'  => $emDisplay2,
         'camplabel'       => $camplabel2,
         'emRequest'       => $now,
         'totalEmails'     => $areaCount2,
         'emSubject'       => $emSubject
      ]);

   }

   public function editSubject($id){

      $emSubject=qcreate::where('id','=',"$id")
      ->pluck('xEmailSubject')
      ->first();

      $xFullStreet=qcreate::where('id','=',"$id")
      ->pluck('xFullStreet')
      ->first();

      return view('members.functions.editSubject',[
         'emSubject'       =>$emSubject,
         'id'              =>$id,
         'xFullStreet'     =>$xFullStreet
      ]);

   }

   public function editSubjectForm($id){

      $emSubject     = request('emSubject');

      propdelivnow::where('propflyer_id','=',"$id")
      ->update([
         'emSubject' => $emSubject
      ]);

      qcreate::where('id','=',"$id")
      ->update([
         'xEmailSubject' => $emSubject
      ]);

      return \Redirect::route("qEdit", ['id'=>$id])->with('message', 'Email Subject Saved!');

   }

   public function editFlyerText($id){

      $qFlyer=qcreate::where('id','=',"$id")
      ->first();

      return view('members.functions.editText',[
         'qFlyer' => $qFlyer
      ]);

   }

   //validate and save input
   public function storeText($id, Request $request) {

      $validator = Validator::make($request::all(), [
         'xIntersection'   => 'Required',
         'xListPrice'      => 'Required|Numeric',
         'xFullStreet'     => 'Required',
         'xCity'           => 'Required',
         'xState'          => 'Required|size:2|string',
         'xZip'            => 'Required|Numeric|digits:5|',
         'xBeds'           => 'Required|Numeric',
         'xBaths'          => 'Required|Numeric',
         'xSqft'           => 'Required|Numeric',
         'xYrBuilt'        => 'Required|Numeric|digits:4'
      ]);


      //if validator passes
      if ($validator->passes()) {

         //check tables
         $qFlyer=qcreate::where('id','=',"$id")
         ->first();

         $pFlyer=propremark::where('propflyer_id','=',"$id")
         ->first();

         $xIntersection = $request::input('xIntersection');
         $xListPrice    = $request::input('xListPrice');
         $xFullStreet   = $request::input('xFullStreet');
         $xCity         = $request::input('xCity');
         $xState        = $request::input('xState');
         $xZip          = $request::input('xZip');
         $xBeds         = $request::input('xBeds');
         $xBaths        = $request::input('xBaths');
         $xSqft         = $request::input('xSqft');
         $xYrBuilt      = $request::input('xYrBuilt');
         $xMlsNum       = $request::input('xMlsNum');
         $xPoolPvt      = $request::input('xPoolPvt');
         $xParking      = $request::input('xParking');
         $xb1           = $request::input('xb1');
         $xb2           = $request::input('xb2');
         $xb3           = $request::input('xb3');
         $xb4           = $request::input('xb4');
         $xb5           = $request::input('xb5');
         $xb6           = $request::input('xb6');
         $xb7           = $request::input('xb7');
         $xb8           = $request::input('xb8');
         $xPubRemarks   = $request::input('xPubRemarks');

         if($qFlyer){

            qcreate::where('id','=',"$id")
            ->update([
               'xIntersection'   => $xIntersection,
               'xListPrice'      => $xListPrice,
               'xFullStreet'     => $xFullStreet,
               'xCity'           => $xCity,
               'xState'          => $xState,
               'xZip'            => $xZip,
               'xBeds'           => $xBeds,
               'xBaths'          => $xBaths,
               'xSqft'           => $xSqft,
               'xYrBuilt'        => $xYrBuilt,
               'xMlsNum'         => $xMlsNum,
               'xPoolPvt'        => $xPoolPvt,
               'xParking'        => $xParking,
               'xb1'             => $xb1,
               'xb2'             => $xb2,
               'xb3'             => $xb3,
               'xb4'             => $xb4,
               'xb5'             => $xb5,
               'xb6'             => $xb6,
               'xb7'             => $xb7,
               'xb8'             => $xb8,
               'xPubRemarks'     => $xPubRemarks
            ]);

            propflyer::where('id','=',"$id")
            ->update([
               'xFullStreet'  => $xFullStreet,
               'xListPrice'   => $xListPrice,
               'xCity'        => $xCity,
               'xState'       => $xState,
               'xZip'         => $xZip,
               'xMlsNum'      => $xMlsNum,
               'xBeds'        => $xBeds,
               'xBaths'       => $xBaths,
               'xSqft'        => $xSqft,
               'xYrBuilt'     => $xYrBuilt,
               'xParking'     => $xParking,
               'xPoolPvt'     => $xPoolPvt
            ]);

         }

         if($pFlyer){
            propflyer::where('id','=',"$id")
            ->update([
               'xFullStreet'  => $xFullStreet,
               'xListPrice'   => $xListPrice,
               'xCity'        => $xCity,
               'xState'       => $xState,
               'xZip'         => $xZip,
               'xMlsNum'      => $xMlsNum,
               'xBeds'        => $xBeds,
               'xBaths'       => $xBaths,
               'xSqft'        => $xSqft,
               'xYrBuilt'     => $xYrBuilt,
               'xParking'     => $xParking,
               'xPoolPvt'     => $xPoolPvt
            ]);

            propmapping::where('propflyer_id','=',"$id")
            ->update([
               'xIntersection'   => $xIntersection,
            ]);

            propremark::where('propflyer_id','=',"$id")
            ->update([
               'xb1'         => $xb1,
               'xb2'         => $xb2,
               'xb3'         => $xb3,
               'xb4'         => $xb4,
               'xb5'         => $xb5,
               'xb6'         => $xb6,
               'xb7'         => $xb7,
               'xb8'         => $xb8,
               'xPubRemarks' => $xPubRemarks
            ]);
         }

         return \Redirect::route("qEdit", ['id'=>$id])->with('message', 'Info Saved');

      }// end of if validator passes

      //back to form with errors
      return back()
            ->withErrors($validator);

   }

   public function addTour($id){

    $qFlyer=qcreate::where('id','=',"$id")
    ->first();

    if($qFlyer){

      $xFullStreet=$qFlyer['xFullStreet'];
      $xVirtualTour=$qFlyer['xVirtualTour'];

    }

    $pFlyer=propflyer::where('id','=',"$id")
    ->first();

    if($pFlyer){
      $xFullStreet=$pFlyer['xFullStreet'];
      $xVirtualTour=$pFlyer['xVirtualTour'];
    }

    return view('members.functions.addTour',[
      'id'            =>$id,
      'xFullStreet'   =>$xFullStreet,
      'xVirtualTour'  =>$xVirtualTour
    ]);

  }

  public function postVirtualTour($id, Request $request){

    $xVirtualTour = $request::input('xVirtualTour');

    if (strpos($xVirtualTour,'http://') !== false |
        strpos($xVirtualTour, 'https://') !== false) {

        //if it validates update
        propflyer::where('id','=',"$id")
        ->update([
          'xVirtualTour'=>$xVirtualTour
        ]);

        //check qcreate table
        $qFlyer=qcreate::where('id','=',"$id")
        ->first();

        //if there, update
        if($qFlyer){
          qcreate::where('id','=',"$id")
          ->update([
            'xVirtTour'=>$xVirtualTour
          ]);
        }

        //if it doesnt contain http redirect with error
        return \Redirect::route("qEdit", ['id'=>$id])
        ->with('message','Virtual Tour Link Saved!');

    }else{

        //if it doesnt contain http redirect with error
        return \Redirect::route("virtualTour", ['id'=>$id])
        ->with('message','Please make sure your link begins with http:// or https://');

    }

  }

  public function addMlsLink($id){

    $qFlyer=qcreate::where('id','=',"$id")
    ->first();

    if($qFlyer){

      $xFullStreet=$qFlyer['xFullStreet'];
      $xMlsLink=$qFlyer['xMlsLink'];

    }

    $pFlyer=propflyer::where('id','=',"$id")
    ->first();

    if($pFlyer){
      $xFullStreet=$pFlyer['xFullStreet'];
      $xMlsLink=$pFlyer['xMlsLink'];
    }

    return view('members.functions.addMlsLink',[
      'id'            => $id,
      'xFullStreet'   => $xFullStreet,
      'xMlsLink'      => $xMlsLink
    ]);

  }

  public function postMlsLink($id, Request $request){

    $xMlsLink = $request::input('xMlsLink');

    if (strpos($xMlsLink,'http://') !== false |
        strpos($xMlsLink, 'https://') !== false) {

      //if it validates update
      propflyer::where('id','=',"$id")
      ->update([
       'xMlsLink'=>$xMlsLink
      ]);

      //check qcreate table
      $qFlyer=qcreate::where('id','=',"$id")
      ->first();

      //if there, update
      if($qFlyer){
       qcreate::where('id','=',"$id")
       ->update([
         'xMlsLink'=>$xMlsLink
       ]);
      }

      //if it doesnt contain http redirect with error
      return \Redirect::route("qEdit", ['id'=>$id])
      ->with('message','MLS Link Saved!');

    }else{

        //if it doesnt contain http redirect with error
        return \Redirect::route("mlsLink", ['id'=>$id])
        ->with('message','Please make sure your link begins with http:// or https://');

    }

  }

   public function editAgent($umid,$ufid){

      $agentInfo=propagent::where('id','=',"$umid")
      ->first();

      $officeInfo=agtoffice::where('propagent_id','=',"$umid")
      ->first();

      $offices=agtoffice::where('propagent_id','=',"$umid")
      ->first();

      $agentPhoto       = $agentInfo['agtPhoto'];
      $agentName        = $agentInfo['agtFullName'];
      $officeID         = $offices['officeID'];
      $officeName       = $offices['officeName'];
      $officeAddress    = $offices['officeAddress'];
      $officeCity       = $offices['officeCity'];
      $officeState      = $offices['officeState'];
      $officeZip        = $offices['officeZip'];
      $agtMainPhone     = $agentInfo['agtMainPhone'];
      $agentLogo        = $agentInfo['agtLogo'];

      $src1="http://www.realtyemails.com/HQoffice/$officeID/$agentPhoto";
      $src2="http://www.realtyrepublic.com/HQoffice/$officeID/$agentPhoto";
      $src3="http://www.realtyemails.com/HQoffice/$officeID/logos/$agentLogo";
      $src4="http://www.realtyrepublic.com/HQoffice/$officeID/logos/$agentLogo";

      if (@getimagesize($src1)) {
         $fromURL2='http://www.RealtyEmails.com';
      }elseif(@getimagesize($src2)){
         $fromURL2='http://www.RealtyRepublic.com';
      }else{
         $fromURL2='http://www.rosemary.test';
      }

      if (@getimagesize($src3)) {
         $fromURL3='http://www.RealtyEmails.com';
      }elseif(@getimagesize($src4)){
         $fromURL3='http://www.RealtyRepublic.com';
      }else{
         $fromURL3='http://www.rosemary.test';
      }

      return view('members.functions.editAgent',[

         'agentInfo'       => $agentInfo,
         'officeID'        => $officeID,
         'officeInfo'      => $officeInfo,
         'agentPhoto'      => $agentPhoto,
         'agentName'       => $agentName,
         'officeName'      => $officeName,
         'officeAddress'   => $officeAddress,
         'officeCity'      => $officeCity,
         'officeState'     => $officeState,
         'officeZip'       => $officeZip,
         'agtMainPhone'    => $agtMainPhone,
         'agentLogo'       => $agentLogo,
         'fromURL2'        => $fromURL2,
         'fromURL3'        => $fromURL3,
         'ufid'            => $ufid

      ]);

   }

   public function postAgentInfo($id, Request $request){

      $validator = Validator::make($request::all(), [
         'agtFirst'        => 'Required',
         'agtLast'         => 'Required',
         'agtMainPhone'    => 'Required',
         'agtEmail'        => 'Required',
         'agtBoard'        => 'Required',
         'officeID'        => 'Required',
         'officeName'      => 'Required',
         'officeAddress'   => 'Required',
         'officeCity'      => 'Required',
         'officeState'     => 'Required|size:2',
         'officeZip'       => 'Required'
      ]);

      if ($validator->passes()) {

         $agtFirst      = $request::input('agtFirst');
         $agtLast       = $request::input('agtLast');
         $agtDesigs     = $request::input('agtDesigs');
         $agtMainPhone  = $request::input('agtMainPhone');
         $agtPhone2     = $request::input('agtPhone2');
         $agtWeb        = $request::input('agtWeb');
         $agtEmail      = $request::input('agtEmail');
         $agtBoard      = $request::input('agtBoard');
         $agtMLSID      = $request::input('agtMLSID');
         $officeID      = $request::input('officeID');
         $officeName    = $request::input('officeName');
         $officeAddress = $request::input('officeAddress');
         $officeCity    = $request::input('officeCity');
         $officeState   = $request::input('officeState');
         $officeZip     = $request::input('officeZip');
         $ufid          = $request::input('ufid');

         propagent::where('id','=',"$id")
         ->update([

            'agtFirst'        => $agtFirst,
            'agtLast'         => $agtLast,
            'agtDesigs'       => $agtDesigs,
            'agtMainPhone'    => $agtMainPhone,
            'agtPhone2'       => $agtPhone2,
            'agtWeb'          => $agtWeb,
            'agtEmail'        => $agtEmail,
            'agtBoard'        => $agtBoard,
            'agtMLSID'        => $agtMLSID,

         ]);

         agtoffice::where('propagent_id','=',"$id")
         ->update([

            'officeID'        => $officeID,
            'officeName'      => $officeName,
            'officeAddress'   => $officeAddress,
            'officeCity'      => $officeCity,
            'officeState'     => $officeState,
            'officeZip'       => $officeZip

         ]);

         //if it doesnt contain http redirect with error
         return \Redirect::route("qEdit", ['id'=>$ufid])
         ->with('message','Agent Information Saved!');

      }else{

         //back to form with errors
         return back()
               ->withErrors($validator);

      }
   }

   public function mEditAgent(){

      $umid=Auth::guard('web')->user()->id;

      $agentInfo=propagent::where('id','=',"$umid")
      ->first();

      $officeInfo=agtoffice::where('propagent_id','=',"$umid")
      ->first();

      $officeID   =  $officeInfo->officeID;
      $agentPhoto =  $agentInfo->agtPhoto;
      $agentLogo  =  $agentInfo->agtLogo;

      include(app_path() . '/functions/fromURL.php');

      return view('members.functions.mEditAgent',[

         'agentInfo'       => $agentInfo,
         'officeInfo'      => $officeInfo,
         'fromURL'         => $fromURL,
         'fromURL2'        => $fromURL2,
         'fromURL3'        => $fromURL3

      ]);
   }

   public function mPostAgentInfo(Request $request){

      $validator = Validator::make($request::all(), [
         'agtFirst'        => 'Required',
         'agtLast'         => 'Required',
         'agtMainPhone'    => 'Required',
         'agtEmail'        => 'Required',
         'agtBoard'        => 'Required',
         'officeID'        => 'Required',
         'officeName'      => 'Required',
         'officeAddress'   => 'Required',
         'officeCity'      => 'Required',
         'officeState'     => 'Required|size:2',
         'officeZip'       => 'Required'
      ]);

      if ($validator->passes()) {

         $agtFirst      = $request::input('agtFirst');
         $agtLast       = $request::input('agtLast');
         $agtDesigs     = $request::input('agtDesigs');
         $agtMainPhone  = $request::input('agtMainPhone');
         $agtPhone2     = $request::input('agtPhone2');
         $agtWeb        = $request::input('agtWeb');
         $agtEmail      = $request::input('agtEmail');
         $agtBoard      = $request::input('agtBoard');
         $agtMLSID      = $request::input('agtMLSID');
         $officeID      = $request::input('officeID');
         $officeName    = $request::input('officeName');
         $officeAddress = $request::input('officeAddress');
         $officeCity    = $request::input('officeCity');
         $officeState   = $request::input('officeState');
         $officeZip     = $request::input('officeZip');

         $umid=Auth::guard('web')->user()->id;

         propagent::where('id','=',"$umid")
         ->update([

            'agtFirst'        => $agtFirst,
            'agtLast'         => $agtLast,
            'agtDesigs'       => $agtDesigs,
            'agtMainPhone'    => $agtMainPhone,
            'agtPhone2'       => $agtPhone2,
            'agtWeb'          => $agtWeb,
            'agtEmail'        => $agtEmail,
            'agtBoard'        => $agtBoard,
            'agtMLSID'        => $agtMLSID,

         ]);

         agtoffice::where('propagent_id','=',"$umid")
         ->update([

            'officeID'        => $officeID,
            'officeName'      => $officeName,
            'officeAddress'   => $officeAddress,
            'officeCity'      => $officeCity,
            'officeState'     => $officeState,
            'officeZip'       => $officeZip

         ]);

         //if it doesnt contain http redirect with error
         return \Redirect::route("mLogin")
         ->with('message','Agent Information Saved!');

      }else{

         //back to form with errors
         return back()
               ->withErrors($validator);

      }
   }

   public function changeAgtPhoto($id,$ufid){

      $currentPhoto=propagent::where('id','=',"$id")
      ->pluck('agtPhoto')
      ->first();

      $officeID=propagent::where('id','=',"$id")
      ->pluck('officeID')
      ->first();

      $src1="http://www.realtyemails.com/hqoffice/$officeID/$currentPhoto";
      $src2="http://www.realtyrepublic.com/hqoffice/$officeID/$currentPhoto";

      if (@getimagesize($src1)) {
         $fromURL='http://www.RealtyEmails.com';
      }elseif(@getimagesize($src2)){
         $fromURL='http://www.RealtyRepublic.com';
      }else{
         $fromURL='http://www.rosemary.test';
      }

      return view('members.functions.addAgtPhoto',[

         'fromURL'   => $fromURL,
         'id'        => $id,
         'officeID'  => $officeID,
         'agtPhoto'  => $currentPhoto,
         'ufid'      => $ufid

      ]);

   }

   public function mChangeAgtPhoto($id){

      $currentPhoto=propagent::where('id','=',"$id")
      ->pluck('agtPhoto')
      ->first();

      $officeID=propagent::where('id','=',"$id")
      ->pluck('officeID')
      ->first();

      $agentPhoto = Auth::user()->agtPhoto;

      include(app_path() . '/functions/fromURL.php');

      return view('members.functions.mAddAgtPhoto',[

         'fromURL'   => $fromURL,
         'fromURL2'  => $fromURL2,
         'id'        => $id,
         'officeID'  => $officeID,
         'agtPhoto'  => $currentPhoto

      ]);

   }

   public function postAgtPhoto($id,$ufid){

      $officeID=propagent::where('id','=',"$id")
      ->pluck('officeID')
      ->first();

      $currentPhoto=propagent::where('id','=',"$id")
      ->pluck('agtPhoto')
      ->first();

      include(app_path() . '/functions/postAgtPhoto.php');

      if($uploadmsg !=='ok'){
         return back()
         ->with('message',"$uploadmsg");
      }

      if($uploadmsg2 !== 0){
         return back()
         ->with('message',"$uploadmsg2");
      }

      if($currentPhoto){

         $filePath="hqoffice/$officeID/$currentPhoto";

         if(file_exists($filePath)){
            //delete file
            unlink($filePath);
         }

      }


      propagent::where('id','=',"$id")
      ->update([
         'agtPhoto'=>$newFileName
      ]);

      return \Redirect::route("qEdit", ['id'=>$ufid])
      ->with('message','Agent Photo Saved!');

   }

    public function mPostAgtPhoto($id){

      $officeID=propagent::where('id','=',"$id")
      ->pluck('officeID')
      ->first();

      $currentPhoto=propagent::where('id','=',"$id")
      ->pluck('agtPhoto')
      ->first();

      include(app_path() . '/functions/postAgtPhoto.php');
      include(app_path() . '/functions/fromURL.php');

      if($uploadmsg !=='ok'){
         return back()
         ->with('message',"$uploadmsg");
      }

      if($uploadmsg2 !== 0){
         return back()
         ->with('message',"$uploadmsg2");
      }

      if($currentPhoto){

         $filePath="hqoffice/$officeID/$currentPhoto";

         if(file_exists($filePath)){
            //delete file
            unlink($filePath);
         }
      }

      propagent::where('id','=',"$id")
      ->update([
         'agtPhoto'=>$newFileName
      ]);

      return \Redirect::route("mLogin")
      ->with('message','Agent Photo Saved!');

   }

   public function mDeleteAgtPhoto($id){

      $officeID=propagent::where('id','=',"$id")
      ->pluck('officeID')
      ->first();

      $currentPhoto=propagent::where('id','=',"$id")
      ->pluck('agtPhoto')
      ->first();

      $filePath="hqoffice/$officeID/$currentPhoto";

      if(file_exists($filePath)){
         //delete file
         unlink($filePath);
      }

      propagent::where('id','=',"$id")
      ->update([
         'agtPhoto'=>null
      ]);

      return back()
      ->with('message','Agent Photo Deleted!');

   }

   public function changeAgtLogo($id,$ufid){

      $currentLogo=propagent::where('id','=',"$id")
      ->pluck('agtLogo')
      ->first();

      $officeID=propagent::where('id','=',"$id")
      ->pluck('officeID')
      ->first();

      $src1="http://www.realtyemails.com/HQoffice/$officeID/logos/$currentLogo";
      $src2="http://www.realtyrepublic.com/HQoffice/$officeID/logos/$currentLogo";

      if (@getimagesize($src1)) {
         $fromURL='http://www.RealtyEmails.com';
      }elseif(@getimagesize($src2)){
         $fromURL='http://www.RealtyRepublic.com';
      }else{
         $fromURL='http://www.rosemary.test';
      }

      return view('members.functions.addAgtLogo',[

         'fromURL'   => $fromURL,
         'id'        => $id,
         'officeID'  => $officeID,
         'agtLogo'   => $currentLogo,
         'ufid'      => $ufid

      ]);

   }

   public function mChangeAgtLogo($id){

      $currentLogo=propagent::where('id','=',"$id")
      ->pluck('agtLogo')
      ->first();

      $officeID=propagent::where('id','=',"$id")
      ->pluck('officeID')
      ->first();

      $src1="http://www.realtyemails.com/HQoffice/$officeID/logos/$currentLogo";
      $src2="http://www.realtyrepublic.com/HQoffice/$officeID/logos/$currentLogo";

      if (@getimagesize($src1)) {
         $fromURL='http://www.RealtyEmails.com';
      }elseif(@getimagesize($src2)){
         $fromURL='http://www.RealtyRepublic.com';
      }else{
         $fromURL='http://www.rosemary.test';
      }

      return view('members.functions.mAddAgtLogo',[

         'fromURL'   => $fromURL,
         'id'        => $id,
         'officeID'  => $officeID,
         'agtLogo'   => $currentLogo,

      ]);

   }

   public function postAgtLogo($id,$ufid){

      $officeID=propagent::where('id','=',"$id")
      ->pluck('officeID')
      ->first();

      $currentLogo=propagent::where('id','=',"$id")
      ->pluck('agtLogo')
      ->first();

      include(app_path() . '/functions/postAgtLogo.php');

      if($uploadmsg !=='ok'){
         return back()
         ->with('message',"$uploadmsg");
      }

      if($uploadmsg2 !== 0){
         return back()
         ->with('message',"$uploadmsg2");
      }

      if($currentLogo){

         $filePath="hqoffice/$officeID/logos/$currentLogo";

         if(file_exists($filePath)){
            //delete file
            unlink($filePath);
         }

      }

      propagent::where('id','=',"$id")
      ->update([
         'agtLogo'=>$newFileName
      ]);

      return \Redirect::route("qEdit", ['id'=>$ufid])
      ->with('message','Agent Logo Saved!');

   }

   public function mPostAgtLogo($id){

      $officeID=propagent::where('id','=',"$id")
      ->pluck('officeID')
      ->first();

      $currentLogo=propagent::where('id','=',"$id")
      ->pluck('agtLogo')
      ->first();

      include(app_path() . '/functions/postAgtLogo.php');

      if($uploadmsg !=='ok'){
         return back()
         ->with('message',"$uploadmsg");
      }

      if($uploadmsg2 !== 0){
         return back()
         ->with('message',"$uploadmsg2");
      }

      if($currentLogo){
         $filePath="hqoffice/$officeID/logos/$currentLogo";
         if(file_exists($filePath)){
            //delete file
            unlink($filePath);
         }
      }

      propagent::where('id','=',"$id")
      ->update([
         'agtLogo'=>$newFileName
      ]);

      return \Redirect::route("mLogin")
      ->with('message','Agent Logo Saved!');

   }

   public function deleteAgtLogo($id,$ufid){

      $officeID=propagent::where('id','=',"$id")
      ->pluck('officeID')
      ->first();

      $currentLogo=propagent::where('id','=',"$id")
      ->pluck('agtLogo')
      ->first();

      $filePath="hqoffice/$officeID/logos/$currentLogo";

      if(file_exists($filePath)){
         //delete file
         unlink($filePath);
      }

      propagent::where('id','=',"$id")
      ->update([
         'agtLogo'=>null
      ]);

      return back()
      ->with('message','Agent Logo Deleted!');

   }

   public function mDeleteAgtLogo($id){

      $officeID=propagent::where('id','=',"$id")
      ->pluck('officeID')
      ->first();

      $currentLogo=propagent::where('id','=',"$id")
      ->pluck('agtLogo')
      ->first();

      $filePath="hqoffice/$officeID/logos/$currentLogo";

      if(file_exists($filePath)){
         //delete file
         unlink($filePath);
      }

      propagent::where('id','=',"$id")
      ->update([
         'agtLogo'=>null
      ]);

      return back()
      ->with('message','Agent Logo Deleted!');

   }

}


