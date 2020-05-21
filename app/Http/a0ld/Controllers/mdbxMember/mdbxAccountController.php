<?php

namespace App\Http\Controllers\mdbxMember;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use App\models\core\propagent;
use Illuminate\Support\Facades\Crypt;

class mdbxAccountController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:member');
   }

   public function show(){
      //set variables
      $umid = Auth::guard('member')->user()->id;
      $idFly=request('idFly');
      //query
      include(app_path().'/accountVariables/accountInfo.php');

      //encrypt
      $umid=Crypt::encryptString($umid);

      if(!$agentInfo){
         dd('error-line23-mdbxAccountController');}

      return view('mdbxMember.fullPages.showAccountDetails',[
         'agentInfo'          => $agentInfo,
         'accountInfo'        => $accountInfo,
         'activeCampaigns'    => $activeCampaigns,
         'completeCampaigns'  => $completeCampaigns,
         'idFly'              => $idFly,
         'umid'               => $umid,
      ]);
   }
}
