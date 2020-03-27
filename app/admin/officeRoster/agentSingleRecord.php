<?php
//get models
Use App\models\core\propagent;
Use App\models\core\agtoffice;
//get umid
$umid=request('umid');
//error if none
if(!$umid){
   dd('error-line5-appPath/admin/officeRoster/agentSingleRecord');}
//get query
include(app_path().'/queries/remailAgentIdQuery_full.php');
//display
$html=View::make('mdbxAdmin.partials.agentIdResultLoop')
   ->with(compact('remailAgentIdQuery'))->render();

echo $html;



