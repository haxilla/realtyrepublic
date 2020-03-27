<?php
namespace App\Http\Controllers\mdbxAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//models
use App\models\adre\adreAgent;
use App\models\adre\adreEntity;

class orosterSearchController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function rosterSearch(){

      $formVal=request('formVal');
      $adreAgentQuery=adreAgent::select('licNumber','')
      ->where('firstName','like','%'.$formVal.'%')
      ->take(10)
      ->get();

      dd($adreAgentQuery);

   }
}

/*
"SELECT CONCAT(first_name, last_name) As name FROM people
WHERE (CONCAT(first_name, last_name) LIKE '%" . $term . "%')"
*/
