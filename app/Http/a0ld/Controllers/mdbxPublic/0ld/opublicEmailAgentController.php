<?php

namespace App\Http\Controllers\mdbxPublic;
use App\Http\Controllers\Controller;

use Request;
use App\models\core\propmeta;
use App\models\core\agtoffice;
use App\models\core\propflyer;
use App\models\core\propagent;
use App\models\admin\remailmsg;
use App\models\core\propphoto;
use App\models\core\propremark;
use App\models\core\propagentcleanup ;
use App\models\admin\adminOption;

class opublicEmailAgentController extends Controller
{
   public function postEmailAgentModal(){
      //request
      $ajid=request('ajid');
      //error if none
      if(!$ajid){
         dd('error-line20-publicEmailAgentController');}
      //get umid
      $getUmid=propagentcleanup::where('newRemID','=',$ajid)
      ->select('propagent_id')
      ->first();
      //set umid
      $umid=$getUmid['propagent_id'];
      
      if(!$umid){
         $umid=$ajid;}

      //query for agtEmail
      $getAgtEmail=propagent::where('id','=',$umid)
      ->select('agtEmail')
      ->first();
      //set AgtEmail
      $agtEmail=$getAgtEmail['agtEmail'];
      //check live or test mode
      $getEmailMode=adminOption::first();
      $emailMode=$getEmailMode['emailMode'];
      if($emailMode !== 'LIVE'){
         $toEmail='realtyemails@gmail.com';
      }else{
         $toEmail=$agtEmail;};

      //captcha code
      if(isset($_POST['g-recaptcha-response'])){
         $captcha=$_POST['g-recaptcha-response'];
      }else{
         $captcha = false;}

      if(!$captcha){
         /** Do something with error **/

         //show error
         return \Redirect::route("public.index")
         ->with('ajid', $ajid)
         ->withErrors('You must check the I am not a robot box!')
         ->withInput();

      }

   }

   public function emailAgentForm(){
      //get id
      $id=request('id');
      //error if none
      if(!$id){
         dd('error-line23-publicEmailAgentController');}

      //get sk1
      $idFly=propmeta::where('sk1','=',"$id")
      ->pluck('propflyer_id')
      ->first();
      //error if none
      if(!$idFly){
         dd('error-line31-publicEmailAgentController');}

      //propinfo query
      $propInfo=propflyer::where('id','=',"$idFly")
      ->select('xFullStreet','propagent_id','xBeds','xBaths',
         'xxBeds','xxBaths','xSqft','xxSqft','xYrBuilt','xxYrBuilt',
         'xListPrice','xCity','xState','xZip','xxZip','id')
      ->with(['theMeta'=>function($q){
         $q->select('propflyer_id','zipDir','mlsDir');
      }])
      ->with(['thePhotos'=>function($q){
         $q->select('propflyer_id','photoName')
         ->where('def','=','1')
         ->where('resized','=','500');
      }])
      ->with(['theRemarks'=>function($q){
         $q->select('xPubRemarks','propflyer_id');
      }])
      ->first();
      //error if none
      if(!$propInfo){
         dd('error-line38-publicEmailAgentController');}

      //umid
      $umid=$propInfo['propagent_id'];
      //agentInfo Query
      $agentInfo=propagent::where('id','=',"$umid")
      ->select('id','agtPhoto','agtLogo','agtWebsite','agtMainPhone',
         'agtFullName','agtFirst')
      ->with(['theAgentMeta'=>function($q){
         $q->select('propagent_id','newRemID');
      }])
      ->first();
      //error if none
      if(!$agentInfo){
         dd('error-line48-publicEmailAgentController');}

      //other agentListings
      $agentListings=propflyer::select('id','propagent_id',
         'xFullStreet','xCity','xState','xZip','xxZip','xListPrice',
         'xBeds','xxBeds','xBaths','xxBaths','xSqft','xxSqft','xYrBuilt',
         'xxYrBuilt')
      ->where('propagent_id','=',"$umid")
      ->where('id','!=',"$idFly")
      ->with(['theAgent'=>function($q){
         $q->select('id','agtFullName');
      }])
      ->with(['theRemarks'=>function($q){
         $q->select('propflyer_id','xPubRemarks');
      }])
      ->with(['theMeta'=>function($q){
         $q->select('propflyer_id','zipDir','mlsDir','sk1');
      }])
      ->with(['thePhotos'=>function($q){
         $q->select('propflyer_id','photoName')
         ->where('def','=','1')
         ->where('resized','=','500');
      }])
      ->orderBy('creationDate','desc')
      ->get();
      //officeInfo
      $officeInfo=agtoffice::where('propagent_id','=',"$umid")
      ->select('officeName','propagent_id','officeAddress1',
         'officeAddress2','officeID','officeCity','officeState','officeZip')
      ->first();
      return view('mdbxPublic.fullPages.emailAgentForm',[
         'id'              => $id,
         'umid'            => $umid,
         'propInfo'        => $propInfo,
         'agentInfo'       => $agentInfo,
         'agentListings'   => $agentListings,
         'officeInfo'      => $officeInfo,
      ]);

    }

   public function emailAgentPost(Request $request){
      //captcha code
      if(isset($_POST['g-recaptcha-response'])){
         $captcha=$_POST['g-recaptcha-response'];
      }else{
         $captcha = false;}

      if(!$captcha){
         /** Do something with error  **/
         return back()->withErrors('You must check the I am not a robot box!')->withInput();
      }else{
         //key v3
         //$secret='6LfM_IgUAAAAAFv-xuHB1DCA9WPn25Bs6yM2YLQY';
         //key v2
         $secret='6LfSH4kUAAAAAB6RGx4o13Mdfd9UDP41mtNveyy8';
         //set response
         $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
         //decode into json
         $json=json_decode($response);
         //set success
         $success=$json->success;
         //if false error
         //v2 captcha
         if($success==false){
            //Do something with error
            dd('error-line123-publicEmailAgentController');
         }
       }

      // The Captcha is valid
      // you can continue with the rest of your code
      //v3 captcha
      /*
         if($success==false){
         //Do something with error
         dd('error-line123-publicEmailAgentController');
         $theScore=null;
         }else{
         //set score
         $theScore=$json->score;
         }
      */

      //get msg
      $msg=request('msg');
      //error if none
      if(!$msg){
         dd('error-line14-publicEmailAgentController.php');}

      $senderName       = request('senderName');
      $senderEmail      = request('senderEmail');
      $contactSubject   = request('contactSubject');
      $theMsg           = request('theMsg');

      $validator = \Validator::make($request::all(), [
         'senderName'      => 'Required|min:5',
         'senderEmail'     => 'Required|email',
         'contactSubject'  => 'Required',
         'theMsg'          => 'Required',
      ]);

      if(!$validator->passes()){
         return back()->withInput()->withErrors($validator);}

      //get id's
      $getMeta=propmeta::where('sk1','=',"$msg")
      ->select('propflyer_id','propagent_id')
      ->first();
      //error if none
      if(!$getMeta){
         dd('error-line25-publicEmailAgentController');}

      //set id's
      $idFly=$getMeta['propflyer_id'];
      $umid=$getMeta['propagent_id'];
      //query record
      $getFlyer=propflyer::where('id','=',"$idFly")
      ->select('xFullStreet')
      ->where('propagent_id','=',"$umid")
      ->first();
      //set Address
      $xFullStreet=$getFlyer['xFullStreet'];
      //query agent
      $getAgent=propagent::where('id','=',"$umid")
      ->select('agtEmail','agtFirst','agtFullName')
      ->first();

      $agtFullName=$getAgent['agtFullName'];
      //insert into remailmsg
      remailmsg::create([
         'propflyer_id' => $idFly,
         'propagent_id' => $umid,
         'senderName'   => $senderName,
         'senderEmail'  => $senderEmail,
         'fromForm'     => 'propInfo',
         'msg'          => $theMsg,
      ]);
      //send admin msg
      $toEmail    = 'RealtyEmails@gmail.com';
      $toName     = 'Chris Mistretta';
      $agtFirst   = $toName;
      $theSubject = "REVIEW: RealtyEmails Message for $xFullStreet";
      $sendThis   = 'emails.members.propInfoMsg';
      $data       = [
         'senderName'      => $senderName,
         'senderEmail'     => $senderEmail,
         'senderMsg'       => $theMsg,
         'agtFirst'        => $agtFirst,
         'xFullStreet'     => $xFullStreet,];

      include(app_path().'/functions/email/sendEmailTemplate.php');

      return back()
         ->with('message',"Message Sent to $agtFullName !");

   }


}
