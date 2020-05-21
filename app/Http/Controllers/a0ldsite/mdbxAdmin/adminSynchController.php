<?php

namespace App\Http\Controllers\mdbxAdmin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\models\core\propflyer;
use App\models\core\propagent;
use App\models\core\propmeta;
use App\models\core\propoffice;
use App\models\core\agtoffice;

class adminSynchController extends Controller
{

   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function assignSK1(){
      include(app_path().'/synch/assignSK1.php');
   }

   public function createPassHash(){
      include(app_path().'/synch/createPassHash.php');
   }

   public function flyer_officeID(){
      include(app_path().'/synch/flyer_officeID.php');
      return back();
   }

   public function flyer_getNewPhotos(){
      include(app_path().'/synch/flyer_getNewPhotos.php');
   }

   public function defaultPhotoFix(){
      include(app_path().'/synch/defaultPhotoFix.php');
   }

   public function officeDirectoryFix(){
      include(app_path().'/synch/officeDirectoryFix.php');
   }

   public function setAgtURL(){
      include(app_path().'/synch/agtURL/setAgtURL.php');
   }

   public function uniqueOfficeID(){
      //run query
      $agtOffice=agtoffice::select('officeAddress1',
         'officeName','officeID','updated_at','propagent_id')
      ->whereNotNull('officeAddress1')
      ->where('officeAddress1','!='," ")
      ->orderBy('officeAddress1')
      ->take(25)
      ->get();
      //show view
      return view('mdbxAdmin.fullPages.mdbxAdminOptions',[
         'showPanel'    => 'uniqueOffice',
         'agtOffice'    => $agtOffice
      ]);
   }

   public function archivePhotoCheck(){
      include(app_path().'/synch/maindataRemailPhotoCheck.php');
   }

   public function resizePhoto_w1000(){
      include(app_path().'/synch/photoW1000/photoW1000index.php');
   }

   public function xFieldsFix(){
      dd('xFieldsFix');
   }

   public function entityFix(){
      include(app_path().'/admin/officeRoster/cleanup/officeEntityFix.php');
   }


}
