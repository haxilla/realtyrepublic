<?php

namespace App\Http\Controllers\mdbxMember;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use App\models\core\propagent;
use App\models\core\allorder;

class paypalOrderReviewController extends Controller
{

   public function __construct()
   {
      $this->middleware('auth:web');
   }

   public function show(){

      $umid=Auth::guard('web')->user()->id;
      if(!$umid){
         dd('error-line18-mdbxOrderReviewController');}

      $getAgent=propagent::where('id','=',"$umid")
      ->select('last_txn','agtReview')
      ->first();

      $txnID=$getAgent['last_txn'];

      $orderInfo=allorder::select(
         'mc_gross','mc_currency','item_number',
         'payer_email','item_name')
      ->where('txn_id','=',"$txnID")
      ->first();

      return view('mdbxMember.fullPages.paypalOrderReview',[
         'orderInfo' => $orderInfo,
      ]);

   }

}
