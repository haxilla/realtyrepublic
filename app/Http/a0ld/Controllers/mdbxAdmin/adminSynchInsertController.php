<?php

namespace App\Http\Controllers\mdbxAdmin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class adminSynchInsertController extends Controller
{

   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function synchResetFlyer(){
      include(app_path().'/synch/resets/synchResetFlyer.php');
   }
   public function synchResetPhoto(){
      include(app_path().'/synch/resets/synchResetPhoto.php');
   }
   public function synchResetAgent(){
      include(app_path().'/synch/resets/synchResetAgent.php');
   }
   public function synchResetStyle(){
      include(app_path().'/synch/resets/synchResetStyle.php');
   }
   public function synchResetDeliv(){
      include(app_path().'/synch/resets/synchResetDeliv.php');
   }
   public function synchResetDelivNow(){
      include(app_path().'/synch/resets/synchResetDelivNow.php');
   }



}
