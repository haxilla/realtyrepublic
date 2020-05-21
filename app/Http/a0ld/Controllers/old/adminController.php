<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Auth;
use App\agtoffice;
use App\propflyer;
use App\propstyle;
use App\propphoto;
use App\propagent;
use App\propmeta;
use App\propdelivnow;
use App\propdeliv;
use App\qcreate;
use App\remailmsg;

class adminController extends Controller
{

   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function logout(){
      Auth::guard('admin')->logout();
      return \Redirect::route("admin.login");
   }

   public function index(){

      $theData=collect(); //empty
      $agentID=null;

      $campData=propdelivnow::whereNull('authorized')
      ->whereNotNull('emRequest')
      ->where( 'emRequest', '<', \Carbon\Carbon::now())
      ->whereNull('emStart')
      ->whereNull('emComplete')
      ->leftJoin('propflyers', 'propflyers.id', '=', 'propdelivnow.propflyer_id')
      ->leftJoin('propagents', 'propdelivnow.propagent_id','=','propagents.id')
      ->get();

      if($campData->first()){

         $mapRecords = $campData->map(function ($item) {
            return [
               'xFullStreet'     => $item->xFullStreet,
               'agtFullName'     => $item->agtFullName,
               'campCreated'     => $item->campCreated,
               'emRequest'       => $item->emRequest,
               'emArea'          => $item->emArea,
               'emSubject'       => $item->emSubject,
               'cid'             => $item->cid,
               'propID'          => $item->propflyer_id
            ];
         });

         $theData=$mapRecords->groupBy('xFullStreet');
         $agentID=$campData->first()->propagent_id;

      }

      return view('admin.index',[
         'campType'  => 'unauth',
         'theData'   => $theData,
         'agentID'   => $agentID,
      ]);

   }

   public function campaigns($campType){

      if($campType=='unauth'){

         $campData=propdelivnow::whereNull('authorized')
         ->whereNotNull('emRequest')
         ->where( 'emRequest', '<', \Carbon\Carbon::now())
         ->whereNull('emStart')
         ->whereNull('emComplete')
         ->leftJoin('propflyers', 'propflyers.id', '=', 'propdelivnow.propflyer_id')
         ->leftJoin('propagents', 'propdelivnow.propagent_id','=','propagents.id')
         ->get();

      }

      if($campType=='auth'){

         $campData=propdelivnow::where('authorized','=','1')
         ->whereNotNull('emRequest')
         ->where( 'emRequest', '<', \Carbon\Carbon::now())
         ->whereNull('emStart')
         ->whereNull('emComplete')
         ->leftJoin('propflyers', 'propflyers.id', '=', 'propdelivnow.propflyer_id')
         ->leftJoin('propagents', 'propdelivnow.propagent_id','=','propagents.id')
         ->get();

      }

      if($campType=='inprog'){

         $campData=propdelivnow::whereNotNull('emRequest')
         ->where( 'emRequest', '<', \Carbon\Carbon::now())
         ->whereNotNull('emStart')
         ->whereNull('emComplete')
         ->leftJoin('propflyers', 'propflyers.id', '=', 'propdelivnow.propflyer_id')
         ->leftJoin('propagents', 'propdelivnow.propagent_id','=','propagents.id')
         ->get();

      }

      if($campType=='future'){

         $campData=propdelivnow::whereNotNull('emRequest')
         ->where( 'emRequest', '>', \Carbon\Carbon::now())
         ->leftJoin('propflyers', 'propflyers.id', '=', 'propdelivnow.propflyer_id')
         ->leftJoin('propagents', 'propdelivnow.propagent_id','=','propagents.id')
         ->get();

      }

      if($campType=='complete'){

         $campData=propdeliv::whereNotNull('emComplete')
         ->where( 'emComplete', '>', \Carbon\Carbon::now()->subDays(30))
         ->leftJoin('propflyers', 'propflyers.id', '=', 'propdelivs.propflyer_id')
         ->leftJoin('propagents', 'propdelivs.propagent_id','=','propagents.id')
         ->orderBy('emComplete','desc')
         ->get();

      }

      if($campType=='incomplete'){

         $campData=propdelivnow::where( 'emRequest', '=', null)
         ->leftJoin('propflyers', 'propflyers.id', '=', 'propdelivnow.propflyer_id')
         ->leftJoin('propagents', 'propdelivnow.propagent_id','=','propagents.id')
         ->orderBy('campCreated','desc')
         ->get();

      }

      if($campData->first()){

         $flyerID=$campData->first()->propflyer_id;
         $agentID=$campData->first()->propagent_id;

      }else{

         $flyerID=0;
         $agentID=0;

      }

      $mapRecords = $campData->map(function ($item) {
         return [
            'xFullStreet'     => $item->xFullStreet,
            'agtFullName'     => $item->agtFullName,
            'emRequest'       => $item->emRequest,
            'emStart'         => $item->emStart,
            'emComplete'      => $item->emComplete,
            'emArea'          => $item->emArea,
            'emSubject'       => $item->emSubject,
            'campCreated'     => $item->campCreated,
            'cid'             => $item->cid,
            'id'              => $item->id,
            'propID'          => $item->propflyer_id
         ];
      });

      $theData=$mapRecords->groupBy('xFullStreet');
      $messages=remailmsg::whereNull('apprv')
      ->get();

      return view('admin.index',[
         'campType'  => $campType,
         'theData'   => $theData,
         'agentID'   => $agentID,
         'messages'  => $messages
      ]);

   }

   public function showFlyer($id){

      $campsWaiting=propdelivnow::where('propflyer_id','=',"$id")
      ->where('emRequest','<',\Carbon\Carbon::now())
      ->whereNull('emStart')
      ->get();

      $campsInProg=propdelivnow::where('propflyer_id','=',"$id")
      ->where('emRequest','<',\Carbon\Carbon::now())
      ->whereNotNull('emStart')
      ->whereNull('emComplete')
      ->get();

      $campsComplete=propdeliv::where('propflyer_id','=',"$id")
      ->whereNotNull('emStart')
      ->whereNotNull('emComplete')
      ->where('emComplete', '>', \Carbon\Carbon::now()->subDays(90))
      ->orderBy('emComplete','desc')
      ->get();

      if($campsWaiting->first()){
         $emSubject=$campsWaiting
         ->pluck('emSubject')
         ->first();
      }elseif($campsInProg->first()){
         $emSubject=$campsinProg
         ->pluck('emSubject')
         ->first();
      }else{
         $emSubject=null;
      }

      $propInfo=propflyer::where('id','=',"$id")
      ->first();

      $umid=$propInfo['propagent_id'];

      $template=propstyle::where('propflyer_id','=',"$id")
      ->pluck('template')
      ->first();

      $messages=remailmsg::whereNull('apprv')
      ->get();

      $enc = Crypt::encrypt([
         'ufid'=>$id,
         'umid'=>$umid,
         'cid'=>'0',
         'eid'=>'0',
         'emArea'=>'0',
         'template'=>$template,
         'toEmail'=>'Screen View',
         'linkPage'=>'adminShowFlyer'
      ]);

      return view('admin.flyerEdit.showFlyer',[
         'campsWaiting'    => $campsWaiting,
         'campsInProg'     => $campsInProg,
         'propInfo'        => $propInfo,
         'template'        => $template,
         'messages'        => $messages,
         'ufid'            => $id,
         'umid'            => $umid
      ]);

   }

   public function admEditHeadline($id){
      $idMem=propflyer::where('id','=',"$id")
      ->pluck('propagent_id')
      ->first();

      $theHeadline=propflyer::where('id','=',"$id")
      ->pluck('xHeadline')
      ->first();

      $xFullStreet=propflyer::where('id','=',"$id")
      ->pluck('xFullStreet')
      ->first();

      if(! $theHeadline){
         $theHeadline=qcreate::where('id','=',"$id")
         ->pluck('xHeadline')
         ->first();
      }

      return view('admin.flyerEdit.admEditHeadline',[
         'id'           => $id,
         'page'         => 'headline',
         'idMem'        => $idMem,
         'theHeadline'  => $theHeadline,
         'xFullStreet'  => $xFullStreet
      ]);
   }

   public function admEditText($id){

      $idMem=propflyer::where('id','=',"$id")
      ->pluck('propagent_id')
      ->first();

      $qFlyer=propflyer::where('id','=',"$id")
      ->first();

      $xFullStreet=$qFlyer['xFullStreet'];

      return view('admin.flyerEdit.admEditText',[
         'id'              => $id,
         'page'            => 'text',
         'idMem'           => $idMem,
         'qFlyer'          => $qFlyer,
         'xFullStreet'     => $xFullStreet
      ]);
   }

   public function admEditAgent($id,$idMem){

      $agentInfo=propagent::where('id','=',"$idMem")
      ->first();

      $officeInfo=agtoffice::where('propagent_id','=',"$idMem")
      ->first();

      $xFullStreet=propflyer::where('id','=',"$id")
      ->pluck('xFullStreet')
      ->first();

      $officeID=$agentInfo['officeID'];
      $agentPhoto=$agentInfo['agtPhoto'];
      $agentName=$agentInfo['agtFullName'];
      $officeName=$officeInfo['officeName'];
      $officeAddress=$officeInfo['officeAddress'];
      $officeCity=$officeInfo['officeCity'];
      $officeState=$officeInfo['officeState'];
      $officeZip=$officeInfo['officeZip'];
      $agtMainPhone=$agentInfo['agtMainPhone'];
      $agentLogo=$agentInfo['agtLogo'];

      $src3 = 'http://www.realtyemails.com/hqoffice/'. $officeID .'/'.$agentPhoto;
      $src4 = 'http://www.realtyrepublic.com/hqoffice/'. $officeID .'/'.$agentPhoto;

      if (@getimagesize($src3)) {
         $fromURL2='http://www.RealtyEmails.com';
      }elseif(@getimagesize($src4)){
         $fromURL2='http://www.RealtyRepublic.com';
      }else{
         $fromURL2='http://www.rosemary.test';
      }

      return view('admin.flyerEdit.admEditAgent',[
         'umid'            => $idMem,
         'idMem'           => $idMem,
         'id'              => $id,
         'ufid'            => $id,
         'xFullStreet'     => $xFullStreet,
         'agentInfo'       => $agentInfo,
         'officeInfo'      => $officeInfo,
         'officeID'        => $officeID,
         'officeName'      => $officeName,
         'officeAddress'   => $officeAddress,
         'officeCity'      => $officeCity,
         'officeState'     => $officeState,
         'officeZip'       => $officeZip,
         'agentName'       => $agentName,
         'agtMainPhone'    => $agtMainPhone,
         'agentLogo'       => $agentLogo,
         'agentPhoto'      => $agentPhoto,
         'fromURL2'        => $fromURL2,
         'page'            => 'agent'
      ]);
   }

   public function admAddPhotos($id){

      $xFullStreet=propflyer::where('id','=',"$id")
      ->pluck('xFullStreet')
      ->first();

      $idMem=propflyer::where('id','=',"$id")
      ->pluck('propagent_id')
      ->first();

      return view('admin.flyerEdit.admAddPhotos',[
         'id'           =>$id,
         'page'         =>'Add Photos',
         'xFullStreet'  => $xFullStreet,
         'idMem'        => $idMem
      ]);
   }

   public function admArrangePhotos($id){
      return view('admin.flyerEdit.admArrangePhotos',[
         'id'     =>$id,
         'page'   =>'Arrange Photos'
      ]);
   }

   public function admEditStyle($id){
      return view('admin.flyerEdit.admEditStyle',[
         'id'     => $id,
         'page'   => 'style'
      ]);
   }

   public function admEditColors($id){
      return view('admin.flyerEdit.admEditColors',[
         'id'     => $id,
         'page'   => 'colors'
      ]);
   }

   public function admDontDisplayAgt($id){
      return view('admin.flyerEdit.admDontDisplayAgt',[
         'id'     => $id,
         'page'   => 'dontDisplay'
      ]);
   }

   public function admAuth($id){

      return view('admin.flyerEdit.admAuth',[
         'id'     => $id,
         'page'   => 'authorize'
      ]);

   }

   public function admEditEmSubject($id){

      $emSubject = request('emSubject');

      propdelivnow::where('propflyer_id','=',"$id")
      ->whereNull('emComplete')
      ->update([
         'emSubject'=> $emSubject
      ]);

      return back();

   }

   public function searchBox(){

      $searchBox = request('searchBox');
      $fromURL=null;
      $fromURL2=null;
      $fromURL=null;
      $agentListings=null;
      $agentID=null;
      $listCount=null;

      if(!$searchBox){
         dd('no criteria');
      }

      $byMlsNum=propflyer::where('xMlsNum','=',"$searchBox")
      ->get();

      $byAddress=propflyer::where('xFullStreet','like','%'.$searchBox.'%')
      ->get();

      $byAgentName=propagent::where('agtFullName','like','%'.$searchBox.'%')
      ->get();

      if(count($byAgentName) > 1){

         $agentID='multi';

      }elseif(count($byAgentName)==1){

         $agentID=$byAgentName
         ->pluck('id')
         ->first();

         $officeID=$byAgentName
         ->pluck('officeID')
         ->first();

         $agentPhoto=$byAgentName
         ->pluck('agtPhoto')
         ->first();

         $listCount=propflyer::where('propagent_id','=',"$agentID")
         ->count();

         $agentListings=propflyer::where('propagent_id','=',"$agentID")
         ->orderBy('creationDate','desc')
         ->simplePaginate(25);

      }else{

      }

      if($agentID && $agentID !== 'multi'){

         $src3 = 'http://www.realtyemails.com/hqoffice/'. $officeID .'/'.$agentPhoto;
         $src4 = 'http://www.realtyrepublic.com/hqoffice/'. $officeID .'/'.$agentPhoto;

         if (@getimagesize($src3)) {
            $fromURL2='http://www.RealtyEmails.com';
         }elseif(@getimagesize($src4)){
            $fromURL2='http://www.RealtyRepublic.com';
         }else{
            $fromURL2='http://www.rosemary.test';
         }

      }

      return view('admin.searchResults',[
         'byMlsNum'        => $byMlsNum,
         'byAddress'       => $byAddress,
         'byAgentName'     => $byAgentName,
         'agentID'         => $agentID,
         'fromURL2'        => $fromURL2,
         'searchBox'       => $searchBox,
         'campType'        => 'searchResult',
         'agentListings'   => $agentListings,
         'listCount'       => $listCount
      ]);

   }

   public function searchResultAgent($id){

      $byAgentName=propagent::where('id','=',"$id")
      ->get();

      $officeID=$byAgentName
      ->pluck('officeID')
      ->first();

      $agentPhoto=$byAgentName
      ->pluck('agtPhoto')
      ->first();

      $agentID=$byAgentName
      ->pluck('id')
      ->first();

      $listCount=propflyer::where('propagent_id','=',"$agentID")
      ->count();

      $agentListings=propflyer::where('propagent_id','=',"$agentID")
      ->orderBy('creationDate','desc')
      ->simplePaginate(25);

      $src3 = 'http://www.realtyemails.com/hqoffice/'. $officeID .'/'.$agentPhoto;
      $src4 = 'http://www.realtyrepublic.com/hqoffice/'. $officeID .'/'.$agentPhoto;

      if (@getimagesize($src3)) {
         $fromURL2='http://www.RealtyEmails.com';
      }elseif(@getimagesize($src4)){
         $fromURL2='http://www.RealtyRepublic.com';
      }else{
         $fromURL2='http://www.rosemary.test';
      }

      return view('admin.searchResultAgent',[
         'byAgentName'     => $byAgentName,
         'fromURL2'        => $fromURL2,
         'officeID'        => $officeID,
         'agentPhoto'      => $agentPhoto,
         'agentID'         => $agentID,
         'campType'        => 'searchResult',
         'searchBox'       => 'agentID: '.$agentID,
         'listCount'       => $listCount,
         'agentListings'   => $agentListings
      ]);

   }

   public function authFlyer($id){
      propdelivnow::where('propflyer_id','=',"$id")
      ->update([
         'authorized'=>1
      ]);
      return redirect('/admin');
   }

   public function unauthFlyer($id){
      propdelivnow::where('propflyer_id','=',"$id")
      ->update([
         'authorized'=>null
      ]);
      return redirect('/admin');
   }

   public function authCamp($cid){

      $checkAuth=propdelivnow::where('cid','=',"$cid")
      ->pluck('authorized')
      ->first();

      if($checkAuth){
         propdelivnow::where('cid','=',"$cid")
         ->update([
            'authorized'=>null
         ]);
      }else{
         propdelivnow::where('cid','=',"$cid")
         ->update([
            'authorized'=>1
         ]);
      }

      return back();

   }

   public function admHeadlinePost($id){

      //value from form
      $xHeadline=request('xHeadline');

      //see if record in qcreate
      $checkQ=qcreate::where('id','=',"$id")
      ->first();

      //if so update it
      if($checkQ){
         qcreate::where('id','=',"$id")
         ->update([
            'xHeadline' => $xHeadline
         ]);
      }

      //update main propflyer
      propflyer::where('id','=',"$id")
      ->update([
         'xHeadline' => $xHeadline
      ]);

      //return to showFlyer
      return \Redirect::route("adminShowFlyer", ['id'=>$id]);

   }

   public function admPhotoUpload($id){

      include(app_path() . '\functions\dzupload.php');

      return redirect()->route('admChangePhotos', ['id' => $id]);

   }

   public function admResizePhotos($id){

      include(app_path() . '\functions\resizePhotos.php');

      return redirect()->route('admChangePhotos', ['id' => $id]);

   }

   public function admDeletePhoto($photoID){

      $oldfilename=propphoto::where('photoID','=',"$photoID")
      ->pluck('oldfilename')
      ->first();

      $deleteID=propphoto::where('oldfilename','=',"$oldfilename")
      ->get();

      $propflyer_id=propphoto::where('photoID','=',"$photoID")
      ->pluck('propflyer_id')
      ->first();

      $zipDir=qcreate::where('id','=',"$propflyer_id")
      ->pluck('zipDir')
      ->first();

      $mlsDir=qcreate::where('id','=',"$propflyer_id")
      ->pluck('mlsDir')
      ->first();

      foreach($deleteID as $di){

         $filePath="hqphotos/$zipDir/$mlsDir/$di->photoName";

         if(file_exists($filePath)){
            //delete file
            unlink($filePath);
            //delete from database
            $thePhoto = propphoto::find($di->photoID);
            $thePhoto->delete();
         }else{
            //delete from database
            $thePhoto = propphoto::find($di->photoID);
            $thePhoto->delete();
         }

      }

      //reorder photos to
      $reOrder=propphoto::where('propflyer_id','=',"$propflyer_id")
      ->orderBy('ord')
      ->get();

      $newCount=1;
      foreach($reOrder as $ro){

         propphoto::where('photoID','=',"$ro->photoID")
         ->update([
            'ord' =>$newCount
         ]);

         $newCount++;
      }

      return back();

   }

   public function admMakeDef($id){

      include(app_path() . '\functions\makeDefPhoto.php');

      return back();

   }

   public function admChangePhotos($id){

      $checkMeta=propmeta::where('propflyer_id','=',"$id")
      ->first();

      if($checkMeta){

         $zipDir=$checkMeta['zipDir'];
         $mlsDir=$checkMeta['mlsDir'];

      }else{

         $zipDir=qcreate::where('id','=',"$id")
         ->pluck('zipDir')
         ->first();

         $mlsDir=qcreate::where('id','=',"$id")
         ->pluck('mlsDir')
         ->first();

      }

      $xFullStreet=propflyer::where('id','=',"$id")
      ->pluck('xFullStreet')
      ->first();

      $idMem=propflyer::where('id','=',"$id")
      ->pluck('propagent_id')
      ->first();

      $defPhoto=propphoto::where('def','=','1')
      ->where('propflyer_id','=',"$id")
      ->where('resized','=','500')
      ->pluck('photoName')
      ->first();

      $allPhotos=propphoto::select('photoName','orient','resized','photoID','ord')
      ->where('propflyer_id','=',"$id")
      ->where('def','=','0')
      ->where('resized','=','500')
      ->orderBy('ord')
      ->get();

      return view('admin.flyerEdit.admChangePhotos',[
         'id'           => $id,
         'idMem'        => $idMem,
         'xFullStreet'  => $xFullStreet,
         'zipDir'       => $zipDir,
         'mlsDir'       => $mlsDir,
         'defPhoto'     => $defPhoto,
         'allPhotos'    => $allPhotos
      ]);

   }



}
