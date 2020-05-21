<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\propslide;

class slidesController extends Controller
{
    //**********************//
    //        SHOW          //
    //**********************//
    public function show(){

      //get most recent
      //paginate example below
      $mostRecent=propslide::mostRecent()->orderBy('creationDate','desc')->simplePaginate(5);
      $mostViews=propslide::mostRecent()->orderBy('xWebViews','desc')->simplePaginate(5);
      $highPrice=propslide::mostRecent()->orderBy('xListPrice','desc')->simplePaginate(5);
      $lowPrice=propslide::mostRecent()->orderBy('xListPrice','asc')->simplePaginate(5);

      //return with data
      return view('public.slides',
      [
        'mostRecent'=>$mostRecent,
        'mostViews'=>$mostViews,
        'highPrice'=>$highPrice,
        'lowPrice'=>$lowPrice
      ]);
    }
}
