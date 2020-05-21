<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\old\oldEmailAgents;
use App\old\oldRemailFlyers;
use App\old\oldRemailStyles;
use App\old\oldRemailPhotos;
use App\old\oldRemailDeliveries;
use App\old\oldRemailDeliveriesNow;
use App\old\oldRemailMsg;
use App\old\oldRemailCopies;
use Illuminate\Support\Facades\Schema;

class synchOldController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function showSynch(){

      //from original site
      $oldEmailAgents=oldEmailAgents::count();
      $oldRemailFlyers=oldRemailFlyers::count();
      $oldRemailStyles=oldRemailStyles::count();
      $oldRemailPhotos=oldRemailPhotos::count();
      $oldRemailDeliveries=oldRemailDeliveries::count();
      $oldRemailDeliveriesNow=oldRemailDeliveriesNow::count();
      $oldRemailMsg=oldRemailMsg::count();
      $oldRemailCopies=oldRemailCopies::count();

      return view('admin.synch.index',[
         'oldEmailAgents'           => $oldEmailAgents,
         'oldRemailFlyers'          => $oldRemailFlyers,
         'oldRemailStyles'          => $oldRemailStyles,
         'oldRemailPhotos'          => $oldRemailPhotos,
         'oldRemailDeliveries'      => $oldRemailDeliveries,
         'oldRemailDeliveriesNow'   => $oldRemailDeliveriesNow,
         'oldRemailMsg'             => $oldRemailMsg,
         'oldRemailCopies'          => $oldRemailCopies
      ]);
   }

   public function abandoned(){

      //creates backup and recreates original table to insert
      Schema::connection('moved')->dropIfExists('remailflyersCopy');

      \DB::connection('moved')->statement('
         CREATE TABLE `remailflyersCopy` SELECT * FROM `remailflyers`
      ');

      Schema::connection('moved')->dropIfExists('remailflyers');

      \DB::connection('moved')->statement('
         CREATE TABLE `remailflyers` like `remailflyerscopy`
      ');

      $oldRemailFlyers=oldRemailFlyers::get();

      foreach($oldRemailFlyers as $orf){
         //abandoned cant figure out how
         //to cross server insert
      }

   }
}
