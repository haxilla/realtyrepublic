<?php

namespace App\Http\Controllers\mdbxMember;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\models\admin\adminOption;
use Illuminate\Support\Facades\Crypt;


class mdbxMemberPurchaseController extends Controller
{

   public function __construct()
   {
      $this->middleware('auth:member');
   }

   public function purchaseOptions(){
      //variables
      $adminOptions=adminOption::first();
      $paymentMode=$adminOptions['paymentMode'];
      $xUmid=\Auth::guard('member')->user()->id;
      $umid=Crypt::encryptString($xUmid);
      //account
      include(app_path().'/accountVariables/accountInfo.php');
      //view
      return view('mdbxMember.fullPages.mdbxPurchases',[
         'paymentMode'        => $paymentMode,
         'umid'               => $umid,
         'accountInfo'        => $accountInfo,
         'activeCampaigns'    => $activeCampaigns,
         'completeCampaigns'  => $completeCampaigns,
      ]);

   }
}
