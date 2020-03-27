d<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\propstyle;
use App\Http\Controllers\headlineController;

class styleController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth');
    }

    public function s1pc($id){
      propstyle::where('propflyer_id','=',"$id")
      ->update([
         'template'  => 's1pc',
         'template_chosen' => '1'
       ]);

      include(app_path() . '/functions/findNextPage.php');

      return \Redirect::route("$nextURL", ['id'=>$id]);

    }

      public function s2pb($id){
      propstyle::where('propflyer_id','=',"$id")
      ->update([
         'template'  => 's2pb',
         'template_chosen' => '1'
       ]);

      include(app_path() . '/functions/findNextPage.php');
      return \Redirect::route("$nextURL", ['id'=>$id]);

   }

      public function s3pt($id){
      propstyle::where('propflyer_id','=',"$id")
      ->update([
         'template'  => 's3pt',
         'template_chosen' => '1'
       ]);

      include(app_path() . '/functions/findNextPage.php');
      return \Redirect::route("$nextURL", ['id'=>$id]);

   }

      public function s4sp($id){
      propstyle::where('propflyer_id','=',"$id")
      ->update([
         'template'  => 's4sp',
         'template_chosen' => '1'
       ]);

      include(app_path() . '/functions/findNextPage.php');
      return \Redirect::route("$nextURL", ['id'=>$id]);

   }

      public function s5pt($id){
      propstyle::where('propflyer_id','=',"$id")
      ->update([
         'template'  => 's5pt',
         'template_chosen' => '1'
       ]);

      include(app_path() . '/functions/findNextPage.php');
      return \Redirect::route("$nextURL", ['id'=>$id]);

   }
}
