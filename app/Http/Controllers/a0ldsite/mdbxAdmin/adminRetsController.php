<?php

namespace App\Http\Controllers\mdbxAdmin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;


class adminRetsController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   //test
   public function phrets(){
      include(app_path().'/rets/phrets.php');
   }
   //get
   public function getProperty_all(){
      include(app_path().'/rets/examples/offsetV1_property.php');
   }
   public function getAgents_all(){
      include(app_path().'/rets/examples/offsetV1_agents.php');
   }
   public function getOffice_all(){
      include(app_path().'/rets/examples/offsetV1_office.php');
   }
   //creates property table with all fields
   public function phretsql_prop(){
   	include(app_path().'/rets/phretsql_prop.php');
   }
   //creates agent table with all fields
   public function phretsql_agent(){
   	include(app_path().'/rets/phretsql_agent.php');
   }
   public function phretsql_office(){
      include(app_path().'/rets/phretsql_office.php');
   }
   public function rets_queries(){
      include(app_path().'/rets/queries/rets_comparison.php');
   }


}
