<?php

namespace App\Http\Controllers\member;
use App\Http\Controllers\Controller;
use Request;
use Auth;

class searchController extends Controller
{

  public function __construct()
  {
     $this->middleware('auth:member');
  }

  public function flyerNavSearch (Request $request){

    //returns UMID only
    include(app_path().'/members/auth/getAuth.php');

    //get searchTerm
    $searchTerm=request('searchTerm');

    //search with UMID return $searchResults
    include(app_path().'/members/search/flyerNavSearch.php');

    //set html
    $html=\View::make('member.overlays.searchResults')
    ->with(['searchResults'=>$searchResults,])
    ->render();

    //echo & exit
    echo $html;
    exit();

  }

}
