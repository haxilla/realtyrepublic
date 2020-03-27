<?php

namespace App\Http\Controllers;

use Request;
use Validator;
use App\propflyer;
use App\propphoto;
use App\propmeta;
use App\propremark;
use App\propagent;
use App\agtoffice;
use App\remailmsg;
use Illuminate\Support\Facades\Crypt;

class emailAgentController extends Controller
{
    public function emailAgentForm($id){

      $propInfo=propflyer::where('id','=',"$id")
      ->first();

      $umid=$propInfo['propagent_id'];

      $agentInfo=propagent::where('id','=',"$umid")
      ->first();

      $agentListings=propflyer::where('propflyers.propagent_id','=',"$umid")
      ->leftJoin('propremarks',
        'propremarks.propflyer_id','=','propflyers.id')
      ->leftJoin('propmetas',
        'propmetas.propflyer_id','=','propflyers.id')
      ->leftJoin('propphotos',
        'propphotos.propflyer_id','=','propflyers.id')
      ->leftJoin('propflyerstats',
        'propflyerstats.propflyer_id','=','propflyers.id')
      ->where('propflyers.id','!=',"$id")
      ->where('def','=','1')
      ->where('resized','=','500')
      ->whereNotNull('xAgtSentCount')
      ->orderBy('creationDate','desc')
      ->take(5)
      ->get();

      $officeInfo=agtoffice::where('propagent_id','=',"$umid")
      ->first();

      $defPhoto=propphoto::where('propflyer_id','=',"$id")
      ->where('def','=','1')
      ->where('resized','=','500')
      ->first();

      $propmeta=propmeta::where('propflyer_id','=',"$id")
      ->first();

      $propRemark=propremark::where('propflyer_id','=',"$id")
      ->first();

      $zipDir=$propmeta['zipDir'];
      $mlsDir=$propmeta['mlsDir'];

      return view('public.emailAgentForm',[
         'id'              => $id,
         'umid'            => $umid,
         'propInfo'        => $propInfo,
         'agentInfo'       => $agentInfo,
         'agentListings'   => $agentListings,
         'officeInfo'      => $officeInfo,
         'defPhoto'        => $defPhoto,
         'zipDir'          => $zipDir,
         'mlsDir'          => $mlsDir,
         'propRemark'      => $propRemark
      ]);

    }

    public function emailAgentPost($id, $umid, Request $request){

      $validator = Validator::make($request::all(), [
         'senderName'       => 'Required',
         'senderEmail'      => 'Required|email',
         'theMsg'           => 'Required',
         'enc'              => 'Required'
      ]);

      //if validator passes
      if ($validator->passes()) {

        $senderName     = $request::input('senderName');
        $senderEmail    = $request::input('senderEmail');
        $senderPhone    = $request::input('senderPhone');
        $theMsg         = $request::input('theMsg');
        $enc            = $request::input('enc');

        $decrypted = Crypt::decrypt($enc);
        $xufid       = $decrypted['ufid'];
        $xumid       = $decrypted['umid'];
        $eid         = $decrypted['eid'];
        $cid         = $decrypted['cid'];
        $theIP       = Request::ip();

        //security check
        if($xufid != $id || $xumid != $umid){
          dd('error processing page line 99 emailAgentController');
        }

        //insert into database
        remailmsg::create([
          'msg_date'      => \Carbon\Carbon::now(),
          'senderName'    => $senderName,
          'senderEmail'   => $senderEmail,
          'senderPhone'   => $senderPhone,
          'msg'           => $theMsg,
          'propflyer_id'  => $id,
          'propagent_id'  => $umid,
          'ip'            => $theIP,
          'eid'           => $eid,
          'cid'           => $cid
        ]);

        return \Redirect::route("emailAgentForm", ['id'=>$id])
        ->with('message', "Email Sent Successfully!");

      }

      //if you're here validation did not pass
     //back to form with errors
      return back()
      ->withErrors($validator);

    }
}
