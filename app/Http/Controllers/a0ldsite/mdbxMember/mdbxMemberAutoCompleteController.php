<?php

namespace App\Http\Controllers\mdbxMember;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\models\core\propflyer;
use Auth;

class mdbxMemberAutoCompleteController extends Controller
{

   public function __construct()
   {
      $this->middleware('auth:web');
   }

   public function memberFlyerSearch(){

      $umid=Auth::guard('web')->user()->id;

      $queries = propflyer::select('id','propflyer_id','sk1','xFullStreet')
      ->leftJoin('propmetas','propflyers.id','propmetas.propflyer_id')
      ->where('propflyers.propagent_id','=',"$umid")
      ->whereNotNull('xFullStreet')
      ->orderBy('creationDate','desc')
      ->get();

      return response()->json($queries);
   }

}
