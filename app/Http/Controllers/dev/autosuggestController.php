<?php

namespace App\Http\Controllers\dev;
Use App\Http\Controllers\Controller;

class autosuggestController extends Controller
{

   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function search(){

      //query
      include(app_path().'/devJournal/queries/tasksearch.php');

      //make view
      $html=\View::make('dev.autosuggest.tasksearchResults')
      ->with([
         'tasksearch'=>$tasksearch,
      ])->render();

      //return display
      echo $html;

      exit();

   }

}
