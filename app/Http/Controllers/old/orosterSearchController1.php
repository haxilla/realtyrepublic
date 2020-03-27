<?php
namespace App\Http\Controllers\mdbxAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//models
use App\models\adre\adreAgent;
use App\models\adre\adreEntity;

class orosterSearchController1 extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function rosterSearch(){

      $formVal=request('formVal');
      $first5=substr($formVal, 0,5); //address
      $last5=substr($formVal, -5); //address



   }
}

/*
"SELECT CONCAT(first_name, last_name) As name FROM people
WHERE (CONCAT(first_name, last_name) LIKE '%" . $term . "%')"
*/
