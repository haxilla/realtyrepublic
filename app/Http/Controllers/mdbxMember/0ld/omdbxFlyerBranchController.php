<?php

namespace App\Http\Controllers\mdbxMember\0ld;
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

class omdbxFlyerBranchController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:web');
   }

   public function edit(){
      //add security check check

      //propInfo,agentInfo,officeInfo, etc
      include(app_path() . '/queries/mdbxMainQueries.php');
      //created variables from above queries
      include(app_path() . '/functions/flyerVariables/mdbxSetVars.php');
      //count Bullets
      include(app_path() . '/functions/flyerVariables/mdbxCountBullets.php');

      //enc variables
      $enc = Crypt::encrypt([
         'ufid'=>$idFly,
         'umid'=>$umid,
         'cid'=>'mdbxFlyerBranch',
         'eid'=>'0',
         'emArea'=>'0',
         'template'=>$propStyles['template'],
         'toEmail'=>'screenClick'
      ]);

      return view('members.mdbx.mdbxLanding', [
         'zipDir'          => $zipDir,
         'mlsDir'          => $mlsDir,
         'propInfo'        => $propInfo,
         'agentInfo'       => $agentInfo,
         'officeID'        => $officeID,
         'agentPhoto'      => $agentPhoto,
         'allPhotos'       => $allPhotos,
         'defPhoto500'     => $defPhoto500,
         'resize500'       => $resize500,
         'propStyles'      => $propStyles,
         'showTemplate'    => $showTemplate,
         'showHL'          => $showHL,
         'showColors'      => $showColors,
         'idFly'           => $idFly,
         'theTemplate'     => $theTemplate,
         'theHeadline'     => $theHeadline,
         'display'         => 'screen',
         'fromURL'         => $fromURL,
         'fromURL2'        => $fromURL2,
         'fromURL3'        => $fromURL3,
         'hlGraphic'       => $hlGraphic,
         'totalPhotos'     => $totalPhotos,
         'enc'             => $enc,
         'bulletCount'     => $bulletCount,
         'propRemarks'     => $propRemarks,
         'xIntersection'   => $xIntersection,
         'officeInfo'      => $officeInfo,
         'bullets_LH'      => $bullets_LH,
         'showLight'       => $showLight,
      ]);
   }

   public function show(){

      $idFly=request('idFly');
      $umid=Auth::guard('web')->user()->id;

      $allCamps=propdelivnow::select('emArea_display','totalEmails',
         'emStart','emComplete','emRequest','cid','emSubject')
         ->where('propflyer_id','=',"$idFly")
         ->where('propagent_id','=',"$umid");

      $campHistory=propdeliv::select('emArea_display','totalEmails',
         'emStart','emComplete','emRequest','cid','emSubject')
         ->where('propflyer_id','=',"$idFly")
         ->where('propagent_id','=',"$umid")
         ->whereNotNull('emComplete')
         ->get();

      //find zipDir, mlsDir, defPhotoName
      $getMeta=propmeta::where('propflyer_id','=',"$idFly")
      ->where('propagent_id','=',"$umid")
      ->first();

      $defPhotoName=propphoto::where('propflyer_id','=', "$idFly")
      ->where('propagent_id','=',"$umid")
      ->where('def','=','1')
      ->where('resized','=','500')
      ->pluck('photoName')
      ->first();

      $zipDir=$getMeta['zipDir'];
      $mlsDir=$getMeta['mlsDir'];

      //determines fromURL based on photo location
      include(app_path() . '/functions/mdbx/mdbxfromURL.php');

      $waitingCamps     = clone $allCamps;
      $inProgressCamps  = clone $allCamps;

      $theSubject=$allCamps->first();
      $theSubject=$theSubject['emSubject'];

      $waitingCamps     = $waitingCamps->whereNull('emStart')->get();
      $inProgressCamps  = $inProgressCamps->whereNotNull('emStart')->get();

      return view('mdbxMember.fullPages.mdbxFlyerBranch',[
         'waitingCamps'    => $waitingCamps,
         'inProgressCamps' => $inProgressCamps,
         'fromURL'         => $fromURL,
         'campHistory'     => $campHistory,
         'theSubject'      => $theSubject
      ]);
   }

   public function print(){

      $idFly=request('idFly');
      $umid=Auth::guard('web')->user()->id;

      if(!$idFly||!$umid){
         dd('error-line84-mdbxFlyerBranchController');
      }

      $propInfo=propflyer::select(
         'xFullStreet','xCity','xState','xZip',
         'xListPrice','xxZip','xMlsNum','xMlsNum',
         'xBeds','xxBeds','xBaths','xxBaths','xSqft',
         'xxSqft'
      )->where('propflyers.id','=',"$idFly")
      ->where('propflyers.propagent_id','=',"$umid")
      ->first();

      if(!$propInfo){
         dd('error-line98-mdbxFlyerBranchController');
      }

      $propMetas=propmeta::select('zipDir','mlsDir','sysID')
      ->where('propflyer_id','=',"$idFly")
      ->first();

      $agentInfo=propagent::select(
         'agtFullName','agtPhoto','officeID','agtMainPhone',
         'agtWeb','agtLogo'
      )->where('id','=',"$umid")
      ->first();

      $officeID=$agentInfo['officeID'];

      $officeInfo=agtoffice::select('officeID','officeName')
      ->where('officeID','=',"$officeID")
      ->first();

      $propRemarks=propremark::where('propflyer_id','=',"$idFly")
      ->where('propagent_id','=',"$umid")
      ->first();

      $allPhotos=propphoto::select('photoName')
      ->where('propflyer_id','=',"$idFly")
      ->where('resized','=','500');

      $getDef=clone $allPhotos;
      $defPhotoName=$getDef->where('def','=','1')->pluck('photoName')->first();
      $photos=$allPhotos->where('def','=','0')->get();

      include(app_path() . '/functions/mdbx/mdbxCountBullets.php');

      return view ('members.mdbx.includes.mdbxPrint',[
         'propInfo'     => $propInfo,
         'propMetas'    => $propMetas,
         'agentInfo'    => $agentInfo,
         'officeInfo'   => $officeInfo,
         'defPhotoName' => $defPhotoName,
         'propRemarks'  => $propRemarks,
         'remHeight'    => $remHeight,
         'photos'       => $photos,

      ]);
   }

   public function launch(){
      //get request & user id
      $idFly=request('idFly');
      $umid=Auth::guard('web')->user()->id;
      //security
      if(!$idFly||!$umid){
         dd('error-line84-mdbxFlyerBranchController');
      }

      $propInfo=propflyer::select('xFullStreet','id')
      ->where('id','=',"$idFly")
      ->where('propagent_id','=',"$umid")
      ->first();

      if(!$propInfo){
         dd('error-line161-mdbxFlyerBranchController');
      }

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

      return view('members.mdbx.mdbxLaunch',[
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
      $idFly=request('idFly');
      $umid=Auth::guard('web')->user()->id;
      //security
      if(!$idFly||!$umid){
         dd('error-line236-mdbxFlyerBranchController');}
      //find record
      $check=propflyer::where('id','=',"$idFly")
      ->where('propagent_id','=',"$umid")
      ->first();

      $xFullStreet=$check['xFullStreet'];

      if(!$check){
         dd('error-line242-mdbxFlyerBranchController');}

      // OK TO PROCEED BELOW
      // *******************
      // delete or archive record in propflyers,propphotos,
      // propremarks,propflyerstats,propmappings
      // propmetas,propstyles,propdelivnow

      //multiple campaigns to find
      $multiRows = propdelivnow::where('propflyer_id','=',"$idFly")->delete();

      //multiple photos with files to delete
      $photoList=propphoto::where('propflyer_id','=',"$idFly")
      ->where('propagent_id','=',"$umid")
      ->get();

      //get & set directory
      $getDir=propmeta::select('zipDir','mlsDir')
      ->where('propflyer_id','=',"$idFly")
      ->where('propagent_id','=',"$umid")
      ->first();

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
            insert into propphotodeletes
            select * from propphotos
            where photoID=$pl->photoID");

         // when successfully moved
         // remove record from phototable
         propphoto::destroy($pl->photoID);
      }

      //single records

      // add to delete tables
      // propremarks
      // delete first to avoid dup errors
      propremarkdelete::destroy($idFly);

      \DB::insert("
         insert into propremarkdeletes
         select * from propremarks
         where propflyer_id=$idFly");

      propremark::destroy($idFly);

      //propflyerstats
      // delete first to avoid dup errors
      propflyerstatdelete::destroy($idFly);

      \DB::insert("
         insert into propflyerstatdeletes
         select * from propflyerstats
         where propflyer_id=$idFly");

      propflyerstat::destroy($idFly);

      //propmappings
      propmappingdelete::destroy($idFly);

      \DB::insert("
         insert into propmappingdeletes
         select * from propmappings
         where propflyer_id=$idFly");

      propmapping::destroy($idFly);

      //propmetas
      propmetadelete::destroy($idFly);

      \DB::insert("
         insert into propmetadeletes
         select * from propmetas
         where propflyer_id=$idFly");

      propmeta::destroy($idFly);

      //propstyles
      propstyledelete::destroy($idFly);

      \DB::insert("
         insert into propstyledeletes
         select * from propstyles
         where propflyer_id=$idFly");

      propstyle::destroy($idFly);

      //propflyers
      propflyerdelete::destroy($idFly);

      \DB::insert("
         insert into propflyerdeletes
         select * from propflyers
         where id=$idFly");

      propflyer::destroy($idFly);

      //remove mls directory
      if($zipDir && $mlsDir){
         $rmlsDir="hqphotos/$zipDir/$mlsDir/";
         rmdir($rmlsDir);}

      //send back with success message
      return \Redirect::route("mLogin", ['id'=>$idFly])
        ->with('message', "$xFullStreet has been deleted Successfully!");

   }

   public function deleteCamp(){

      $cid=request('cid');
      $umid=Auth::guard('web')->user()->id;

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
      return \Redirect::route("mdbxFlyerBranch", ['idFly'=>$idFly])
        ->with('message', "Campaign for $thisArea has been deleted Successfully!");

   }
}
