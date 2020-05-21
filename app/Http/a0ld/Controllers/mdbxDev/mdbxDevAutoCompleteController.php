<?php

namespace App\Http\Controllers\mdbxDev;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\models\dev\devtask;
use App\models\dev\devtaskcomment;
use App\models\dev\devtip;
use App\models\dev\devexcuse;

class mdbxDevAutoCompleteController extends Controller
{
   public function __construct(){
      $this->middleware('auth:admin');
   }

   public function autoComplete(){

      $term = request('search_tasks');

      $query1 = devtaskcomment::select('taskComment as taskDesc','taskID','listRef')
      ->where('taskComment','like','%'.$term.'%');
      $query2 = devtip::select('tipDesc as taskDesc','taskID','listRef')
      ->where('tipDesc','like','%'.$term.'%');
      $query3 = devexcuse::select('excuseDesc as taskDesc','taskID','listRef')
      ->where('excuseDesc','like','%'.$term.'%');
      $queries = devtask::select('taskDesc','taskID','listRef')
      ->where('taskDesc','like','%'.$term.'%')
      ->union($query1)
      ->union($query2)
      ->union($query3)
      ->get();

      return response()->json($queries);

   }
}
