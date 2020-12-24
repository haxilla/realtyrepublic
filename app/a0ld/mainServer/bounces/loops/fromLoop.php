<?php

//default var
$theMailbox=null;
$theHost=null;
$thisEmail=null;
$firstName=null;
$middleName=null;
$lastName=null;
$To_data=array();

if(isset($fromLoop) 
&& count($fromLoop)){
	//loop
	foreach($fromLoop as $loop){
		
		//loop variables
		$fullName=$loop['from_personal'];
		$theMailbox=$loop['from_mailbox'];
		$theHost=$loop['from_host'];

		//create thisEmail from to header
		if($theMailbox && $theHost){
			$thisEmail=$theMailbox.'@'.$theHost;}

		//must have email or name
		if(!$thisEmail && !$fullName){
			dd('error-line24-toLoop.php');}

		//if fullName
		if($fullName){
			include(app_path().'/functions/name_splitter.php');}
		
		//check distro
		include(app_path().'/bounces/functions/distro_review.php');

		//pull adre data from first & last name
		if(!$agentLicNum && $firstName && $lastName){
			include(app_path().'/adre/functions/adre_review.php');}

		//check members ie. propagents
		include(app_path().'/bounces/functions/umid_review.php');

		//filter out unwanted emails
		$badEmail=null;
		$badEmailKeys=array('agents.camelback','agents.pinnaclepeak',
			'members@arizonaemails.com');
		//run keys against email mark if bad
		foreach($badEmailKeys as $badKey){
			if(stripos($thisEmail,$badKey)!==false){
				$badEmail=1;}}

		//add clean emails to array
		if(!$badEmail){
			//allData
			$To_Data[]=[
				'uid'					=>$uid,
				'eidx'					=>$eidx,
				'last_hit'				=>$last_hit,
				'eidx_officeName'		=>$eidx_officeName,
				'eidx_officeAddress1'	=>$eidx_officeAddress1,
				'thisEmail'				=>$thisEmail,
				'fullName'				=>$fullName,
				'firstName'				=>$firstName,
				'middleName'			=>$middleName,
				'lastName'				=>$lastName,
				'adreCount'				=>$adreCount,
				'agentLicNum'			=>$agentLicNum,
				'agentLicStatus'		=>$agentLicStatus,
				'employerLicNum'		=>$employerLicNum,
				'legalName'				=>$legalName,
				'theSubject'			=>$subject,
				'theMailbox'			=>$theMailbox,
				'theHost'				=>$theHost,
				'umid'					=>$umid,
				'umidCount'				=>$umidCount,
			];
		};
	};
};