<?php

namespace App\Http\Controllers\mdbxAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\core\propflyer;
use App\models\core\propdeliv;
use App\models\core\propdelivnow;
use Illuminate\Support\Facades\Crypt;

class mdbxFlyerCheckController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function show(){
      $id=request('id');
      if(!$id){
         dd('line22-mdbxFlyerCheckController');}

      //takes in id & passes out idFly if all is well
      include(app_path().'/flyerVariables/existingFlyerCheck.php');
      //swaps between auth & unauth
      include(app_path().'/admin/authorizeFunction.php');
      //propInfo,agentInfo,officeInfo, etc
      include(app_path() . '/queries/mdbxMainQueries.php');
      //created variables from above queries
      include(app_path() . '/flyerVariables/mdbxSetVars.php');
      //finding fromURL from variables set at above queries
      include(app_path() . '/flyerVariables/mdbxfromURL.php');
      //count Bullets
      include(app_path() . '/flyerVariables/mdbxCountBullets.php');
      //count Bullets
      include(app_path() . '/flyerVariables/adminVariables.php');
      //current Flyer Camps
      include(app_path() . '/queries/currentFlyerCamps.php');
      //complete Flyer Camps
      include(app_path() . '/queries/completeFlyerCamps.php');

      //enc variables
      $enc = Crypt::encrypt([
         'id'=>$idFly,
         'umid'=>$umid,
         'cid'=>'mdbxFlyerBranch',
         'eid'=>'0',
         'emArea'=>'0',
         'template'=>$theTemplate,
         'toEmail'=>'screenClick'
      ]);

      return view('mdbxAdmin.fullPages.mdbxAdminFlyerCheck', [
         'propInfo'              => $propInfo,
         'officeID'              => $officeID,
         'id'                    => $id,
         'umid'                  => $umid,
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
         'agtPhoto'              => $agtPhoto,
         'agtLogo'               => $agtLogo,
         'zipDir'                => $zipDir,
         'mlsDir'                => $mlsDir,
         'totalPhotos'           => $totalPhotos,
         'enc'                   => $enc,
         'theAddress'            => $theAddress,
         'currentFlyerCamps'     => $currentFlyerCamps,
         'completeFlyerCamps'    => $completeFlyerCamps
      ]);
   }
}
