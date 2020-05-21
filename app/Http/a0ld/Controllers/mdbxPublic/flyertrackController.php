<?php

namespace App\Http\Controllers\mdbxPublic;
use App\Http\Controllers\Controller;

use Request;
use Illuminate\Support\Facades\Crypt;
use App\models\core\propflyer;
use App\models\core\propmeta;
use App\models\core\propflyerstat;
use App\models\core\etrack;

class flyertrackController extends Controller{

    public function pubShowAllPhotos(){
      //get var
      $enc=request('enc');
      //error if not found
      if(!$enc){
         dd('error-line19-flyerTrackController');}

      //decrypt
      $decrypted = Crypt::decrypt($enc);
      //set vars
      $ufid       = $decrypted['ufid'];
      $umid       = $decrypted['umid'];
      $eid        = $decrypted['eid'];
      $cid        = $decrypted['cid'];
      $emArea     = $decrypted['emArea'];
      $template   = $decrypted['template'];
      $toEmail    = $decrypted['toEmail'];
      $linkPage   = 'whats this for';
      $linkClick  = 'allPhotos';
      $theIP      = Request::ip();
      $now        = \Carbon\Carbon::now();
      //Check if exists
      $getFlyer=propflyer::select('id')
      ->where('id','=',"$ufid")
      ->where('propagent_id','=',"$umid")
      ->with(['theStats'=>function($q){
         $q->select('propflyer_id','xWebViews');
      }])
      ->with(['theMeta'=>function($q){
         $q->select('propflyer_id','sk1');
      }])
      ->first();
      //error if not found
      if(!$getFlyer){
         dd('error-line44-flyerTrackController');}

      //increment webViews
      $webViews=$getFlyer->theStats->xWebViews;
      $webViews++;

      //update views on stats
      propflyerstat::where('propflyer_id','=',"$ufid")
      ->update([
         'xWebViews'=>$webViews,
      ]);
      //insert etrack
      etrack::create([
         'propflyer_id' => $ufid,
         'propagent_id' => $umid,
         'etrackDate'   => $now,
         'eid'          => $eid,
         'cid'          => $cid,
         'emArea'       => $emArea,
         'template'     => $template,
         'toEmail'      => $toEmail,
         'linkPage'     => $linkPage,
         'linkClick'    => $linkClick,
         'ip'           => $theIP,
         'lastCount'    => $webViews
      ]);
      //set id
      $id=$getFlyer->theMeta->sk1;
      //redirect to proper page
      return \Redirect::route("public.propInfo",[
         'id'=>$id,
      ]);

   }

   public function pubMlsLink(){
      $enc=request('enc');
      if(!$enc){
         dd('error-line87-flyertrackController');}

      //decrypt
      $decrypted = Crypt::decrypt($enc);
      //set variables
      $ufid       = $decrypted['ufid'];
      $umid       = $decrypted['umid'];
      $eid        = $decrypted['eid'];
      $cid        = $decrypted['cid'];
      $emArea     = $decrypted['emArea'];
      $template   = $decrypted['template'];
      $toEmail    = $decrypted['toEmail'];
      $linkClick  = 'pubMlsLink';
      $theIP      = Request::ip();
      $now        = \Carbon\Carbon::now();

      //Check if exists
      $getFlyer=propflyer::where('id','=',"$ufid")
      ->select('xMlsLink')
      ->where('propagent_id','=',"$umid")
      ->first();

      if(!$getFlyer){
         dd('error-line110-flyertrackController');}

      //set link
      $pubMlsLink=$getFlyer['xMlsLink'];
      //get stats
      $getStats=propflyerstat::where('propflyer_id','=',"$ufid")
      ->select('xWebViews')
      ->first();
      //error if none
      if(!$getStats){
         dd('error finding stats line119_flyertrackController');}

      //increment webViews
      $webViews=$getStats['xWebViews'];
      $webViews++;
      //update views on stats
      propflyerstat::where('propflyer_id','=',"$ufid")
      ->update([
         'xWebViews'=>$webViews
      ]);
      //create log
      etrack::create([
         'propflyer_id' => $ufid,
         'propagent_id' => $umid,
         'etrackDate'   => $now,
         'eid'          => $eid,
         'cid'          => $cid,
         'emArea'       => $emArea,
         'template'     => $template,
         'toEmail'      => $toEmail,
         'linkPage'     => $pubMlsLink,
         'linkClick'    => $linkClick,
         'ip'           => $theIP,
         'lastCount'    => $webViews
      ]);
      //redirect to proper page
      return \Redirect::to("$pubMlsLink");
   }

   public function pubVTour(){
      //get encodeing
      $enc=request('enc');
      //error if none
      if(!$enc){
         dd('error-line157-flyertrackController');}
      //decrypt
      $decrypted = Crypt::decrypt($enc);
      //set variables
      $ufid       = $decrypted['ufid'];
      $umid       = $decrypted['umid'];
      $eid        = $decrypted['eid'];
      $cid        = $decrypted['cid'];
      $emArea     = $decrypted['emArea'];
      $template   = $decrypted['template'];
      $toEmail    = $decrypted['toEmail'];
      $linkClick  = 'pubVtour';
      $theIP      = Request::ip();
      $now        = \Carbon\Carbon::now();
      //Check if exists
      $getFlyer=propflyer::where('id','=',"$ufid")
      ->select('xVirtualTour','xxVirtualTour')
      ->where('propagent_id','=',"$umid")
      ->first();
      //error if none
      if(!$getFlyer){
         dd('error-line179-flyertrackController');}
      //set pubvTour
      $pubVTour=$getFlyer['xVirtualTour'];
      //try again if none
      if(!$pubVTour){
         $pubVTour=$getFlyer['xxVirtualTour'];}
      //error if none
      if(!$pubVTour){
         dd('error-line185-flyerTrackController');}
      //set link
      $linkPage=$pubVTour;
      //get Stats
      $getStats=propflyerstat::where('propflyer_id','=',"$ufid")
      ->select('xWebViews')
      ->first();
      //if nothing found error
      if(!$getStats){
         dd('error finding stats line194_flyertrackController');}
      //increment webViews
      $webViews=$getStats['xWebViews'];
      $webViews++;
      //update views on stats
      propflyerstat::where('propflyer_id','=',"$ufid")
      ->update([
         'xWebViews'=>$webViews,]);
      //create track
      etrack::create([
         'propflyer_id' => $ufid,
         'propagent_id' => $umid,
         'etrackDate'   => $now,
         'eid'          => $eid,
         'cid'          => $cid,
         'emArea'       => $emArea,
         'template'     => $template,
         'toEmail'      => $toEmail,
         'linkPage'     => $linkPage,
         'linkClick'    => $linkClick,
         'ip'           => $theIP,
         'lastCount'    => $webViews]);
      //redirect to proper page
      return \Redirect::to("$pubVTour");
   }

   public function pubMoreInfo(){

      $enc=request('enc');
      if(!$enc){
         dd('error-line229-flyertrackController');}
      //decrypt
      $decrypted = Crypt::decrypt($enc);
      //set variables
      $ufid       = $decrypted['ufid'];
      $umid       = $decrypted['umid'];
      $eid        = $decrypted['eid'];
      $cid        = $decrypted['cid'];
      $emArea     = $decrypted['emArea'];
      $template   = $decrypted['template'];
      $toEmail    = $decrypted['toEmail'];
      $linkPage   = 'mdbxSendCopy';
      $linkClick  = 'pubMoreInfo';
      $theIP      = Request::ip();
      $now        = \Carbon\Carbon::now();
      //Check if exists
      $getFlyer=propflyer::where('id','=',"$ufid")
      ->where('propagent_id','=',"$umid")
      ->first();
      //error if none
      if(!$getFlyer){
         dd('error-line250-flyertrackController');}
      //get stats
      $getStats=propflyerstat::where('propflyer_id','=',"$ufid")
      ->first();
      //error if none
      if(!$getStats){
         dd('error finding stats line119_flyertrackController');}

      //increment webViews
      $webViews=$getStats['xWebViews'];
      $webViews++;

      //update views on stats
      propflyerstat::where('propflyer_id','=',"$ufid")
      ->update([
         'xWebViews'=>$webViews,]);

      etrack::create([
         'propflyer_id' => $ufid,
         'propagent_id' => $umid,
         'etrackDate'   => $now,
         'eid'          => $eid,
         'cid'          => $cid,
         'emArea'       => $emArea,
         'template'     => $template,
         'toEmail'      => $toEmail,
         'linkPage'     => $linkPage,
         'linkClick'    => $linkClick,
         'ip'           => $theIP,
         'lastCount'    => $webViews,]);

      //get sk1
      $sk1=propmeta::where('propflyer_id','=',"$ufid")
      ->pluck('sk1')
      ->first();
      //redirect to proper page
      return \Redirect::route("public.propInfo", ['id'=>$sk1]);

   }

   public function pubEmailme(){
      //encoding
      $enc=request('enc');
      //error if none
      if(!$enc){
         dd('error-line294-flyertrackController');}

      //decrypt
      $decrypted = Crypt::decrypt($enc);
      //set variables
      $ufid       = $decrypted['ufid'];
      $umid       = $decrypted['umid'];
      $eid        = $decrypted['eid'];
      $cid        = $decrypted['cid'];
      $emArea     = $decrypted['emArea'];
      $template   = $decrypted['template'];
      $toEmail    = $decrypted['toEmail'];
      $linkPage   = 'pubEmailMe';
      $linkClick  = 'pubEmailMe';
      $theIP      = Request::ip();
      $now        = \Carbon\Carbon::now();

      //Check if exists
      $getFlyer=propflyer::where('id','=',"$ufid")
      ->where('propagent_id','=',"$umid")
      ->first();
      //error if none
      if(!$getFlyer){
         dd('error-line318-flyertrackController');}
      //get stats
      $getStats=propflyerstat::where('propflyer_id','=',"$ufid")
      ->first();
      //error if none
      if(!$getStats){
         dd('error finding stats line119_flyertrackController');}
      //increment webViews
      $webViews=$getStats['xWebViews'];
      $webViews++;
      //update views on stats
      propflyerstat::where('propflyer_id','=',"$ufid")
      ->update([
         'xWebViews'=>$webViews,]);
      //get sk1
      $sk1=propmeta::where('propflyer_id','=',"$ufid")
      ->pluck('sk1')
      ->first();
      //create log
      etrack::create([
         'propflyer_id' => $ufid,
         'propagent_id' => $umid,
         'etrackDate'   => $now,
         'eid'          => $eid,
         'cid'          => $cid,
         'emArea'       => $emArea,
         'template'     => $template,
         'toEmail'      => $toEmail,
         'linkPage'     => $linkPage,
         'linkClick'    => $linkClick,
         'ip'           => $theIP,
         'lastCount'    => $webViews,]);

      //redirect to proper page
      return \Redirect::route("public.emailAgentForm",
         ['id'=>$sk1,'enc'=>$enc]);

   }

   public function agentInfo(){
      if(isset($_GET['enc'])){
         $enc=$_GET['enc'];
         $decrypted = Crypt::decrypt($enc);
         dd($decrypted,$decrypted['ufid']);
      }else{
         echo "no";
      }
   }

   public function pubShowThePhoto(){
      //get
      $photoID=request('photoID');
      $enc=request('enc');
      //error if none
      if(!$photoID||!$enc){
         dd('error-line366-flyerTrackController');}

      //decrypt
      $decrypted = Crypt::decrypt($enc);
      //set variables
      $ufid       = $decrypted['ufid'];
      $umid       = $decrypted['umid'];
      $eid        = $decrypted['eid'];
      $cid        = $decrypted['cid'];
      $emArea     = $decrypted['emArea'];
      $template   = $decrypted['template'];
      $toEmail    = $decrypted['toEmail'];
      $linkPage   = 'whatsthisfor?';
      $linkClick  = 'pubShowPhoto';
      $theIP      = Request::ip();
      $now        = \Carbon\Carbon::now();
      //Check if exists
      $getFlyer=propflyer::where('id','=',"$ufid")
      ->select()
      ->where('propagent_id','=',"$umid")
      ->first();
      //sk1
      $sk1=propmeta::where('propflyer_id','=',"$ufid")
      ->pluck('sk1')
      ->first();
      if(!$getFlyer||!$sk1){
         dd('error-line392-flyertrackController');}

      //get stats
      $getStats=propflyerstat::where('propflyer_id','=',"$ufid")
      ->first();
      //error if none
      if(!$getStats){
         dd('error finding stats line119_flyertrackController');}

      //increment webViews
      $webViews=$getStats['xWebViews'];
      $webViews++;
      //update views on stats
      propflyerstat::where('propflyer_id','=',"$ufid")
      ->update([
         'xWebViews'=>$webViews,]);
      //log
      etrack::create([
         'propflyer_id' => $ufid,
         'propagent_id' => $umid,
         'etrackDate'   => $now,
         'eid'          => $eid,
         'cid'          => $cid,
         'emArea'       => $emArea,
         'template'     => $template,
         'toEmail'      => $toEmail,
         'linkPage'     => $linkPage,
         'linkClick'    => $linkClick,
         'ip'           => $theIP,
         'photoID'      => $photoID,
         'lastCount'    => $webViews,]);
      //redirect to proper page
      return \Redirect::route("public.propInfo", ['id'=>$sk1]);
   }

}
