<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class flyerEditController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function show(){
      //get ID
      $id=request('id');
      //error if none
      if(!$id){
         dd('line21-admin/flyerEditController');}

      //takes in id & passes out idFly if all is well
      include(app_path().'/flyerVariables/existingFlyerCheck.php');
      //swaps between auth & unauth
      include(app_path().'/admin/authorizeFunction.php');
      //propInfo,agentInfo,officeInfo, etc
      include(app_path().'/queries/mdbxMainQueries.php');
      //created variables from above queries
      include(app_path().'/flyerVariables/mdbxSetVars.php');
      //finding fromURL from variables set at above queries
      include(app_path().'/flyerVariables/mdbxfromURL.php');
      //count Bullets
      include(app_path().'/flyerVariables/mdbxCountBullets.php');
      //current Flyer Camps
      include(app_path().'/queries/currentFlyerCamps.php');
      //complete Flyer Camps
      include(app_path().'/queries/completeFlyerCamps.php');

      //enc variables
      $enc = Crypt::encrypt([
         'ufid'=>$idFly,
         'umid'=>$umid,
         'cid'=>'adminFlyerEdit',
         'eid'=>'0',
         'emArea'=>'0',
         'template'=>$theTemplate,
         'toEmail'=>'screenClick'
      ]);

      return view('admin.flyerEdit.flyerView2', [
         'propInfo'              => $propInfo,
         'officeID'              => $officeID,
         'graphic_words'         => $graphic_words,
         'graphic_textcolor'     => $graphic_textcolor,
         'graphic_style'         => $graphic_style,
         'flyer_background'      => $flyer_background,
         'hlGraphic'             => $hlGraphic,
         'theTemplate'           => $theTemplate,
         'bullets_LH'            => $bullets_LH,
         'theHeadline'           => $theHeadline,
         'display'               => 'screen',
         'showLight'             => $showLight,
         'fromURL1'              => $fromURL1,
         'fromURL2'              => $fromURL2,
         'fromURL3'              => $fromURL3,
         'newRemID'              => $newRemID,
         'agtPhoto'              => $agtPhoto,
         'agtLogo'               => $agtLogo,
         'zipDir'                => $zipDir,
         'mlsDir'                => $mlsDir,
         'totalPhotos'           => $totalPhotos,
         'enc'                   => $enc,
         'currentFlyerCamps'     => $currentFlyerCamps,
         'completeFlyerCamps'    => $completeFlyerCamps
      ]);
   }
}
