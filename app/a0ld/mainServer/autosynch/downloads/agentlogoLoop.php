<?php

//agentPhotoQuery
include('queries/agentlogoQuery.php');

//photoCheckQuery Loop
foreach($agentlogoQuery as $the){

	//variables for both agentPhoto & agentLogo
	include('variables/agentlogoVariables.php');

	//get agentphoto
	if(!$localFound){
		
		//fetch
		include('functions/agentlogo_checkremote.php');

		//get photo
		include('functions/agentlogo_download.php');

		//update
		include('functions/agentlogo_update.php');
	
	}else{

		include('functions/agentlogo_update.php');

	}


}//end of foreach loop