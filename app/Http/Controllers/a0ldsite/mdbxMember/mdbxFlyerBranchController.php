<?php

namespace App\Http\Controllers\mdbxMember;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\models\core\propphoto;
use App\models\core\agtoffice;
use App\models\core\propmeta;
use App\models\core\propagent;
use App\models\core\propremark;
use App\models\core\propflyer;
use App\models\core\propmapping;
use App\models\core\propflyerstat;
use App\models\core\propdeliv;
use App\models\core\propdelivnow;
use App\models\core\propstyle;
use App\models\delete\propphotodelete;
use App\models\delete\propflyerstatdelete;
use App\models\delete\propremarkdelete;
use App\models\delete\propmappingdelete;
use App\models\delete\propmetadelete;
use App\models\delete\propstyledelete;
use App\models\delete\propflyerdelete;
use Auth;

class mdbxFlyerBranchController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:member');
   }

   public function edit(){
      //add security check check
      include(app_path().'/flyerVariables/existingFlyerCheck.php');
      //accountVariables
      include(app_path().'/accountVariables/accountInfo.php');
      //propInfo,agentInfo,officeInfo, etc
      include(app_path() . '/queries/mdbxMainQueries.php');
      //created variables from above queries
      include(app_path() . '/flyerVariables/mdbxSetVars.php');
      //finding fromURL from variables set at above queries
      include(app_path() . '/flyerVariables/mdbxfromURL.php');
      //count Bullets
      include(app_path() . '/flyerVariables/mdbxCountBullets.php');
      //accountInfo

      //enc variables
      $enc = Crypt::encrypt([
         'ufid'=>$idFly,
         'umid'=>$umid,
         'cid'=>'mdbxFlyerBranch',
         'eid'=>'0',
         'emArea'=>'0',
         'template'=>$theTemplate,
         'toEmail'=>'screenClick'
      ]);

      return view('mdbxMember.fullPages.mdbxLanding', [
         'accountInfo'        => $accountInfo,
         'propInfo'           => $propInfo,
         'agentInfo'          => $agentInfo,
         'activeCampaigns'    => $activeCampaigns,
         'completeCampaigns'  => $completeCampaigns,
         'newRemID'           => $newRemID,
         'idFly'              => $idFly,
         'graphic_words'      => $graphic_words,
         'graphic_textcolor'  => $graphic_textcolor,
         'graphic_style'      => $graphic_style,
         'flyer_background'   => $flyer_background,
         'hlGraphic'          => $hlGraphic,
         'theTemplate'        => $theTemplate,
         'bullets_LH'         => $bullets_LH,
         'theHeadline'        => $theHeadline,
         'display'            => 'screen',
         'showLight'          => $showLight,
         'fromURL1'           => $fromURL1,
         'fromURL2'           => $fromURL2,
         'fromURL3'           => $fromURL3,
         'agtPhoto'           => $agtPhoto,
         'agtLogo'            => $agtLogo,
         'zipDir'             => $zipDir,
         'mlsDir'             => $mlsDir,
         'totalPhotos'        => $totalPhotos,
         'enc'                => $enc,
      ]);

   }

   public function show(){
      //confirm existence and permissions returns idFly if OK
      include(app_path().'/flyerVariables/existingFlyerCheck.php');
      //accountVariables
      include(app_path().'/accountVariables/accountInfo.php');
      //Campaigns
      //all current
      $allCamps=propdelivnow::select('emArea_display','totalEmails',
         'emStart','emComplete','emRequest','cid','emSubject')
         ->where('propflyer_id','=',"$idFly")
         ->where('propagent_id','=',"$umid");
      //history
      $campHistory=propdeliv::select('emArea_display','totalEmails',
         'emStart','emComplete','emRequest','cid','emSubject')
         ->where('propflyer_id','=',"$idFly")
         ->where('propagent_id','=',"$umid")
         ->whereNotNull('emComplete')
         ->orderBy('emComplete','desc')
         ->get();
      //prepared queries
      $waitingCamps     = clone $allCamps;
      $inProgressCamps  = clone $allCamps;
      $waitingCamps     = $waitingCamps->whereNull('emStart')->get();
      $inProgressCamps  = $inProgressCamps->whereNotNull('emStart')->get();
      //theSubject
      $theSubject=$allCamps->first();
      $theSubject=$theSubject['emSubject'];
      //propInfo
      $propInfo=propflyer::where('id','=',"$idFly")
      ->select('id','xFullStreet','xCity','xState','xZip','xxZip',
         'xListPrice','xMlsNum')
      ->with(['theMeta'=>function($q){
         $q->select('propflyer_id','zipDir','mlsDir','sk1','sysID');
      }])
      ->with(['thePhotos'=>function($q){
         $q->select('propflyer_id','photoName','def','ord')
         ->where('def','=','1')
         ->where('resized','=','500');
      }])
      ->first();
      if(!$propInfo){
         dd('error-line120-mdbxFlyerBranchController');}

      //view
      return view('mdbxMember.fullPages.mdbxFlyerBranch',[
         'waitingCamps'    => $waitingCamps,
         'inProgressCamps' => $inProgressCamps,
         'campHistory'     => $campHistory,
         'theSubject'      => $theSubject,
         'propInfo'        => $propInfo,
         'accountInfo'     => $accountInfo,
         'activeCampaigns'    => $activeCampaigns,
         'completeCampaigns'  => $completeCampaigns,
      ]);
   }

   public function print(){

      $id=request('id');
      $umid=Auth::guard('member')->user()->id;
      //get id/umid
      if(!$id||!$umid){
         dd('error-line84-mdbxFlyerBranchController');}
      //get propflyer_id
      $idFly=propmeta::where('sk1','=',"$id")
      ->pluck('propflyer_id')
      ->first();
      //error if none
      if(!$idFly){
         dd('error-line147-mdbxFlyerBranchController');}
      //propInfo
      $propInfo=propflyer::select(
         'xFullStreet','xCity','xState','xZip',
         'xListPrice','xxZip','xMlsNum','xMlsNum',
         'xBeds','xxBeds','xBaths','xxBaths','xSqft',
         'xxSqft','id')
      ->where('id','=',"$idFly")
      ->with(['theRemarks'=>function($q){
         $q->select('propflyer_id','propagent_id','xb1',
            'xb2','xb3','xb4','xb5','xb6','xb7','xb8',
            'xPubRemarks');
      }])
      ->where('propagent_id','=',"$umid")
      ->first();
      //error if none
      if(!$propInfo){
         dd('error-line98-mdbxFlyerBranchController');}

      $propMetas=propmeta::select('zipDir','mlsDir','sysID')
      ->where('propflyer_id','=',"$idFly")
      ->first();

      $agentInfo=propagent::select(
         'agtFullName','agtPhoto','officeID','agtMainPhone',
         'agtWebsite','agtLogo','id'
      )->where('id','=',"$umid")
      ->with(['theAgtOffice'=>function($q){
         $q->select('officeName','officeID','propagent_id',
            'officeAddress1','officeCity','officeState','officeZip');
      }])
      ->first();

      $allPhotos=propphoto::select('photoName')
      ->where('propflyer_id','=',"$idFly")
      ->where('resized','=','500');

      $getDef=clone $allPhotos;
      $defPhotoName=$getDef->where('def','=','1')->pluck('photoName')->first();
      $photos=$allPhotos->where('def','=','0')->get();

      include(app_path() . '/flyerVariables/mdbxCountBullets.php');

      return view ('mdbxMember.fullPages.mdbxPrint',[
         'propInfo'     => $propInfo,
         'propMetas'    => $propMetas,
         'agentInfo'    => $agentInfo,
         'defPhotoName' => $defPhotoName,
         'remHeight'    => $remHeight,
         'photos'       => $photos,

      ]);
   }

   public function launch(){
      //get request & user id
      $id=request('id');
      $umid=Auth::guard('member')->user()->id;
      //security
      if(!$id||!$umid){
         dd('error-line84-mdbxFlyerBranchController');}

      $idFly=propmeta::where('sk1','=',"$id")
      ->pluck('propflyer_id')
      ->first();

      $propInfo=propflyer::select('xFullStreet','id')
      ->where('id','=',"$idFly")
      ->where('propagent_id','=',"$umid")
      ->first();

      if(!$propInfo){
         dd('error-line161-mdbxFlyerBranchController');}

      $defPhoto=propphoto::select('photoName')
      ->where('propflyer_id','=',"$idFly")
      ->where('propagent_id','=',"$umid")
      ->where('def','=','1')
      ->where('resized','=','500')
      ->first();

      $propMetas=propmeta::select('zipDir','mlsDir')
      ->where('propflyer_id','=',"$idFly")
      ->where('propagent_id','=',"$umid")
      ->first();

      $otherCamps=propdelivnow::where('propflyer_id','=',"$idFly")
      ->where('propagent_id','=',"$umid")
      ->get();

      if($otherCamps->first()){
         $theSubject=$otherCamps->first()->emSubject;
      }else{
         $theSubject=null;}

      $zipDir=$propMetas['zipDir'];
      $mlsDir=$propMetas['mlsDir'];
      $defPhotoURL="http://www.realtyemails.com/hqphotos/$zipDir/$mlsDir/$defPhoto";

      return view('mdbxMember.fullPages.mdbxLaunch',[
         'id'           => $id,
         'propInfo'     => $propInfo,
         'defPhotoURL'  => $defPhotoURL,
         'otherCamps'   => $otherCamps,
         'theSubject'   => $theSubject
      ]);

   }

   public function share(){
      dd('ok share');
   }

   public function delete(){
      //get vars
      $id=request('id');
      $umid=Auth::guard('member')->user()->id;
      //security
      if(!$id||!$umid){
         dd('error-line266-mdbxFlyerBranchController');}
      //find record
      $getID=propmeta::where('sk1','=',"$id")
      ->where('propagent_id','=',"$umid")
      ->select('propflyer_id')
      ->first();
      //error if none
      if(!$getID){
         dd('error-line274-mdbxFlyerBranchController');}

      //get idFly
      $idFly=$getID['propflyer_id'];
      //check for record
      $check=propflyer::where('id','=',"$idFly")
      ->where('propagent_id','=',"$umid")
      ->select('xFullStreet')
      ->first();
      //error if none
      if(!$check){
         dd('error-line-284-mdbxFlyerBranchController');}

      // OK TO PROCEED BELOW
      // *******************
      // delete or archive record in propflyers,propphotos,
      // propremarks,propflyerstats,propmappings
      // propmetas,propstyles,propdelivnow

      //value returned in message
      $xFullStreet=$check['xFullStreet'];
      //multiple campaigns to find
      $multiRows = propdelivnow::where('propflyer_id','=',"$idFly")->delete();
      //multiple photos with files to delete
      $photoList=propphoto::where('propflyer_id','=',"$idFly")
      ->where('propagent_id','=',"$umid")
      ->get();
      //query metas
      $getDir=propmeta::select('zipDir','mlsDir')
      ->where('propflyer_id','=',"$idFly")
      ->where('propagent_id','=',"$umid")
      ->first();
      //set variables
      $zipDir=$getDir['zipDir'];
      $mlsDir=$getDir['mlsDir'];
      //photo image delete loop
      foreach($photoList as $pl){
         //set paths
         $currentPath  = "hqphotos/$zipDir/$mlsDir/$pl->photoName";
         $newPath       = "photoDeletes/$zipDir/$mlsDir/$pl->photoName";
         // if newPath directory doesnt exist create it
         if (!is_dir("photoDeletes/$zipDir/$mlsDir")) {
            mkdir("photoDeletes/$zipDir/$mlsDir", 0777, true);}

         // move files
         if(file_exists($currentPath)){
            rename($currentPath,$newPath);}

         //delete first to avoid dup errors
         propphotodelete::destroy($pl->photoID);
         //add to delete tables
         \DB::insert("
            insert into deletes.propphotodelete
            select * from propphotos
            where photoID=$pl->photoID");

         // when successfully moved
         // remove record from phototable
         propphoto::destroy($pl->photoID);}

      //single records

      // add to delete tables
      // propremarks
      // delete first to avoid dup errors
      propremarkdelete::destroy($idFly);

      \DB::insert("
         insert into deletes.propremarkdelete
         select * from propremarks
         where propflyer_id=$idFly");

      propremark::destroy($idFly);

      //propflyerstats
      // delete first to avoid dup errors
      propflyerstatdelete::destroy($idFly);

      \DB::insert("
         insert into deletes.propflyerstatdelete
         select * from propflyerstats
         where propflyer_id=$idFly");

      propflyerstat::destroy($idFly);

      //propmappings
      propmappingdelete::destroy($idFly);

      \DB::insert("
         insert into deletes.propmappingdelete
         select * from propmappings
         where propflyer_id=$idFly");

      propmapping::destroy($idFly);

      //propmetas
      propmetadelete::destroy($idFly);

      \DB::insert("
         insert into deletes.propmetadelete
         select * from propmetas
         where propflyer_id=$idFly");

      propmeta::destroy($idFly);

      //propstyles
      propstyledelete::destroy($idFly);

      \DB::insert("
         insert into deletes.propstyledelete
         select * from propstyles
         where propflyer_id=$idFly");

      propstyle::destroy($idFly);

      //propflyers
      propflyerdelete::destroy($idFly);

      \DB::insert("
         insert into deletes.propflyerdelete
         select * from propflyers
         where id=$idFly");

      propflyer::destroy($idFly);
      //include function
      include(app_path().'/functions/isDirEmpty.php');
      //remove mls directory
      if($zipDir && $mlsDir){
         //set mlsDir
         $rmlsDir="hqphotos/$zipDir/$mlsDir/";
         //does it exist
         if(is_dir($rmlsDir)){
            //is it empty
            if(is_dir_empty($rmlsDir)){
               rmdir($rmlsDir);}}}

      //send back with success message
      return \Redirect::route("member.login", ['id'=>$id])
        ->with('message', "$xFullStreet has been deleted Successfully!");

   }

   public function deleteCamp(){

      $cid=request('cid');
      $umid=Auth::guard('member')->user()->id;

      //stop if missing
      if(!$cid||!$umid){
         dd('error-line406-mdbxFlyerBranchController');}

      $deleteThis=propdelivnow::where('cid','=',"$cid")
      ->where('propagent_id','=',"$umid")
      ->first();

      if(!$deleteThis){
         dd('error-line414-mdbxFlyerBranchController');}

      $idFly      = $deleteThis['propflyer_id'];
      $thisArea   = $deleteThis['emArea_display'];

      propdelivnow::destroy($cid);

      //send back with success message
      return back()
        ->with('message', "Campaign for $thisArea has been deleted Successfully!");

   }
}
