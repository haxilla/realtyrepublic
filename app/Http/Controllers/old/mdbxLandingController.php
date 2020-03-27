<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class mdbxLandingController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:web');
   }

   public function showLanding(){

      //Security Logic & assign idFly
      include(app_path() . '/functions/mdbx/mdbxSecurityCheck.php');
      //propInfo,agentInfo,officeInfo, etc
      include(app_path() . '/functions/mdbx/mdbxMainQueries.php');
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
         'showLight'       => $showLight
      ]);
   }
}
