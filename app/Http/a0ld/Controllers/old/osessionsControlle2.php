<?php

namespace App\Http\Controllers;

use App\agtoffice;
use App\qcreate;
use App\propflyer;
use App\propagent;
use App\propdelivnow;
use App\propdeliv;
use Request;
use Auth;


class osessionsControlle2 extends Controller
{
    protected $table = 'propagents';

    public function create(){

      //? form area for new account creation ?//

    }

    public function store(Request $request){

      //if NOT authorized run script to log-in
      if(!auth::check()){
        $uName=$request::input('agtUname');
        $thePswd=$request::input('password');
        $rememberMe = $request::input('rememberMe') ? true : false;

        //AUTH is using **passHash** for password field
        //this is set in the User.php model getAuthPassword()
        //checks 2 fields agtUname && xxAgtUname

        if (!Auth::attempt([
          'agtUname' => $uName,
          'password' => $thePswd],$rememberMe)
          &&
          !Auth::attempt([
          'xxAgtUname'=> $uName,
          'password' => $thePswd],$rememberMe)
          &&
          !Auth::viaRemember())
          {
            return \Redirect::route('index')->withErrors([
            'message'=> 'Please check your credentials and try again!'
          ]);
        }

      }
      /*
      //if authorized code below will run
      //get agentID and office info
      $agentInfo      = propagent::where('id','=',"$umid")
      ->first();
      $agtFlyers      = propflyer::where('propagent_id','=',"$umid");
      $agtFlyerCount  =  $agtFlyers->count();
      $allDeliveries = propdelivnow::where('propflyers.propagent_id','=',"$umid")
      ->leftJoin(
        'propflyerstats',
        'propflyerstats.propflyer_id', '=', 'propdelivnow.propflyer_id')
      ->leftJoin('propflyers',
        'propdelivnow.propflyer_id','=','propflyers.id')
      ->where('emComplete','=',null)
      ->orderBy('emRequest','desc')
      ->get();

      $allDeliveriesGroup=$allDeliveries
      ->map( function($item) {
          return [
            'xFullStreet'     => $item->xFullStreet,
            'emRequest'       => $item->emRequest,
            'emStart'         => $item->emStart,
            'emComplete'      => $item->emComplete,
            'emArea_display'  => $item->emArea_display,
            'cid'             => $item->cid,
            'id'              => $item->id
          ];
      })->groupBy('id');

      $unsentFlyers=propflyer::leftJoin('propflyerstats',
      'propflyerstats.propflyer_id','=','propflyers.id')
      ->whereNull('xLastDeliveryDate')
      ->whereNull('xAgtSent')
      ->where('propflyerstats.propagent_id','=',"$umid")
      ->get();

      //for agent only
      $latestFlyers=propflyer::leftJoin('propflyerstats',
        'propflyerstats.propflyer_id','=','propflyers.id')
      ->leftJoin('propphotos',
        'propphotos.propflyer_id','=','propflyers.id')
      ->leftJoin('propmetas',
        'propmetas.propflyer_id','=','propflyers.id')
      ->whereNotNull('xLastDeliveryDate')
      ->whereNotNull('xAgtSent')
      ->where('propflyers.propagent_id','=',"$umid")
      ->where('resized','=','500')
      ->where('def','=','1')
      ->orderBy('xLastDeliveryDate','desc')
      ->get()
      ->take(5);

      //includes others on the system
      $otherFlyers=propflyer::select(
        'agtFullName','mlsDir','zipDir','xFullStreet','photoName',
        'officeID','agtPhoto','agtLogo','startDate','xListPrice',
        'xxBeds','xxBaths','xxSqft','xCity','xState','xxZip')
      ->leftJoin('propflyerstats',
        'propflyerstats.propflyer_id','=','propflyers.id')
      ->leftJoin('propphotos',
        'propphotos.propflyer_id','=','propflyers.id')
      ->leftJoin('propmetas',
        'propmetas.propflyer_id','=','propflyers.id')
      ->leftJoin('propagents',
        'propagents.id','=','propflyers.propagent_id')
      ->whereNotNull('xAgtSent')
      ->where('resized','=','500')
      ->where('def','=','1')
      ->where('orient','=','wide')
      ->orderBy('creationDate','desc')
      ->get()
      ->take(10);
      */
      return view('members.mdbx.mdbxIndex');
    }

    public function destroy(){

      auth()->logout();

      return redirect()->route('index');

    }
}
