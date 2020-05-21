<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Auth;
use App\propagent;
use App\adminOption;

class mdbxMemberCreditController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:web');
   }

   public function show(){

      $umid = Auth::guard('web')->user()->id;
      $agentInfo=propagent::where('id','=',"$umid")
      ->first();

      if(!$umid||!$agentInfo){
         dd('error-line24-mdbxMemberCreditController');}

      $umid=Crypt::encryptString($umid);
      $adminOptions=adminoption::first();
      $paymentMode=$adminOptions['paymentMode'];

      return view('members.mdbx.mdbxMemberCreditPurchase',[
         'agentInfo'    => $agentInfo,
         'umid'         => $umid,
         'paymentMode'  => $paymentMode,
      ]);
   }

}
