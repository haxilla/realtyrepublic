<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\admin\adminTable;
use App\models\oldsite\oldRemailflyerdelete;
use App\models\delete\newremailflyerdelete;
use Auth;

class adminIndexController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function logout(){
      Auth::guard('admin')->logout();
      return \Redirect::route("admin.login");
   }

   public function adminIndex(){

      //return view('admin.adminIndex');
      $adminID=Auth::guard('admin')->user()->id;
      //get admin
      $adminInfo=adminTable::where('id','=',$adminID)
      ->first();
      //get mostViews&newAdds queries
      include(app_path().'/queries/indexQuery.php');
      //get campaigns
      include(app_path().'/queries/admin/adminCampaignQueries.php');
      //are photos valid - returns photoData array
      include(app_path().'/functions/imageControl/isPhotoValid.php');
      //check for funky accounts
      include(app_path().'/functions/databreachCheck.php');

      //view
      return view('admin.index',[
         'breadCrumb'         => 'Dashboard',
         'adminInfo'          => $adminInfo,
         'newAdds'            => $newAdds,
         'mostViews'          => $mostViews,
         'activeCamps'        => $activeCamps,
         'completeCamps'      => $completeCamps,
         'photoData'          => $photoData,
      ]); 
   }

   public function adminIconsPage(){
      return view('admin.adminIcons',[
         'breadCrumb' => 'Icons',
      ]);
   }

   public function adminWall(){
      return view('admin.adminWall',[
         'breadCrumb' => 'Wall',
      ]);
   }
}
