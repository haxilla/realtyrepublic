<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class bounceReviewController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function index(Request $request){

      include(app_path().'/bounces/bounceReviewIndex.php');
      
      return view('bounces.bounceReviewIndex',[
         'msgCount'        => $num_msg,
         'bounceReviews'   => $bounceReviews,
         'groupedBy'       => $groupedBy,
      ]);

   }

   public function display(Request $request){

      include(app_path().'/bounces/bounceReviewDisplay.php');
      
      return view('bounces.bounceReviewDisplay',[
         'uid'             => $uid,
         'msgCount'        => $num_msg,
         'bounceReviews'   => $bounceReviews,
         'bounceMessage'   => $bounceMessage,
      ]);

   }

}
