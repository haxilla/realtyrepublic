<?php

namespace App\Http\Controllers\mdbxAdmin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\models\core\propflyer;

class adminAjaxPhotoSynchController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function ajaxGetPhotos_w1000(){
      include(app_path().'/synch/localPhotos_w1000.php');
   }

   public function createNew_agentPhoto(){
      $agentPhotoFix=1;
      $agentLogoFix=0;
      include(app_path().'/synch/agentPhotoLogo/agentPhotoLogoIndex.php');
   }
   public function createNew_agentLogo(){
      $agentPhotoFix=0;
      $agentLogoFix=1;
      include(app_path().'/synch/agentPhotoLogo/agentPhotoLogoIndex.php');
   }

}
