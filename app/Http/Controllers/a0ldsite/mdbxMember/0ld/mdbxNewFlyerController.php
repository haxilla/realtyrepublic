<?php

namespace App\Http\Controllers\mdbxMember;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Crypt;
use Request;
use Auth;
use Validator;
use App\Helpers\serverValidation; //filename
use App\Helpers\checkMdbxid;      //filename
use App\models\core\propflyer;
use App\models\core\tempflyer;

class mdbxNewFlyerController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:web');
   }



   //when MLS# is posted
   public function mdbxid(){

      //member id
      $umid=Auth::guard('web')->user()->id;
      $showPre=0;
      $inMLS=1;

      //from preCreate form
      $tempMlsNum=request('xMlsNum');
      $mdbxid=request('mdbxid');

      //security error
      if(!$mdbxid){
         dd('errorline76-mdbxNewFlyerController');}

      //detect duplicate
      $flyerExists=propflyer::where('propagent_id','=',"$umid")
      ->where('xMlsNum','=',"$tempMlsNum")
      ->first();

      if($flyerExists){
         dd('duplicate found');}

      //if in temp table
      $tempExists=tempflyer::where('mdbxid','=',"$mdbxid")
      ->orWhere('tempMlsNum','=',"$tempMlsNum")
      ->where('propagent_id','=',"$umid")
      ->first();

      if($tempExists){

         //if exists keep the same
         $mdbxid=$tempExists['mdbxid'];
         $inMLS=1;

         tempflyer::where('mdbxid','=',"$mdbxid")
         ->where('propagent_id','=',"$umid")
         ->update([
            'tempMlsNum'=> $tempMlsNum,
            'inMLS'     => $inMLS
         ]);

         //package last update in variable
         $tempInfo=tempflyer::where('mdbxid','=',"$mdbxid")
         ->first();

      }else{

         //create key
         include(app_path() . '/functions/genMdbxID.php');

         //create in temp table
         tempflyer::create([
            'tempMlsNum'      => $tempMlsNum,
            'mdbxid'          => $mdbxid,
            'propagent_id'    => $umid,
            'inMLS'           => 1
         ]);
      }

      return view('members.mdbx.mdbxFlyerStarter',[
         'mdbxid'          => $mdbxid,
         'tempInfo'        => $tempInfo,
         'showPre'         => $showPre,
         'inMLS'           => $inMLS,
      ]);
   }

   public function flyerStarter(){
      //get mdbxid
      $mdbxid=request('mdbxid');
      //error if no mdbxid
      if(!$mdbxid){
         dd('error-line143-mdbxNewFlyerController');}
      //query
      $tempInfo=tempflyer::where('mdbxid','=',"$mdbxid")
      ->first();
      //view
      return view('members.mdbx.mdbxFlyerStarter',[
         'mdbxid'    => $mdbxid,
         'tempInfo'  => $tempInfo,
         'showPre'   => 0,
      ]);

   }

   public function mdbxAjaxSaveStep(Request $request){

      $umid=Auth::guard('web')->user()->id;
      $mdbxid=request('mdbxid');

      //below code executes server validation
      //and smarty streets
      $myFunction = new serverValidation();  //class
      $myFunction->serverValidate($request); //function

   }//end of ajaxSave Function

   public function mdbxUpload(){
      include(app_path() . '/functions/mdbx/mdbxUpload.php');
   }

   public function mdbxResizeNewPhotos(){
      //Security Logic & assign idFly
      include(app_path() . '/functions/mdbx/mdbxSecurityCheck.php');
      //propInfo,agentInfo,officeInfo, etc
      include(app_path() . '/functions/mdbx/mdbxMainQueries.php');
      //find photos that need resizing and do it
      include(app_path() . '/functions/resizePhotos/resizePhotosFunction.php');
      //created variables from above queries
      include(app_path() . '/functions/mdbx/mdbxSetVars.php');
      //assigns fromURL depending on server
      include(app_path() . '/functions/mdbx/mdbxfromURL.php');
      //gets values from GET request in url
      include(app_path() . '/functions/mdbx/mdbxGetURLvars.php');
      //count Bullets
      include(app_path() . '/functions/mdbx/mdbxCountBullets.php');

      //enc variables
      $enc = Crypt::encrypt([
         'ufid'=>$idFly,
         'umid'=>$umid,
         'cid'=>'flyerLanding',
         'eid'=>'0',
         'emArea'=>'0',
         'template'=>$propStyles['template'],
         'toEmail'=>'screenClick'
      ]);

      return view('members.mdbx.mdbxLanding', [
         'zipDir'          => $zipDir,
         'mlsDir'          => $mlsDir,
         'propInfo'        => $propInfo,
         'allPhotos'       => $allPhotos,
         'defPhoto500'     => $defPhoto500,
         'resize500'       => $resize500,
         'propStyles'      => $propStyles,
         'agentInfo'       => $agentInfo,
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
         'officeID'        => $officeID,
         'agentPhoto'      => $agentPhoto,
         'hlGraphic'       => $hlGraphic,
         'totalPhotos'     => $totalPhotos,
         'enc'             => $enc,
         'bulletCount'     => $bulletCount,
         'bullets_LH'      => $bullets_LH,
         'propRemarks'     => $propRemarks,
         'xIntersection'   => $xIntersection,
         'officeInfo'      => $officeInfo
      ]);
   }

}
