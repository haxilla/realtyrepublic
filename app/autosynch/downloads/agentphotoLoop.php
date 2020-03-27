<?php

//check for newRemID
include('functions/synchNewRemID.php');

//agentPhotoQuery
include('queries/agentphotoQuery.php');

//photoCheckQuery Loop
foreach($agentphotoQuery as $the){

	//variables for both agentPhoto & agentLogo
	include('variables/agentphotoVariables.php');

	//get agentphoto
	if(!$localFound){
		
		//fetch
		include('functions/agentphoto_checkremote.php');

		//get photo
		include('functions/agentphoto_download.php');

		//update
		include('functions/agentphoto_update.php');
	
	}else{

		include('functions/agentphoto_update.php');

	}

}//end of foreach loop