<?php

Use App\bounces\models\bounceReview;

$varLoop=${$import};

if($varLoop){

	foreach($varLoop as $loop){
		//variables
		$thisEmail		= $loop['thisEmail'];
		$theSubject		= $loop['subject'];
		$thisFullName	= $loop['fullName'];
		$msgDate		= $loop['msgDate'];
		//
		if($thisEmail||$thisFullName){

			$thisFullName=str_replace("'","\\'", $thisFullName);
			//query if exists
			$exists=bounceReview::whereRaw("UPPER(email) LIKE '%".strtoupper($thisEmail)."%'")
			->first();

			if(!$exists && $thisFullName){
				$exists=bounceReview::whereRaw("UPPER(fullName) LIKE '%".strtoupper($thisFullName)."%'")
				->first();}

			$reviewID=$exists['reviewID'];
			//update if found
			if($exists){
				//update count
				$bounceCount=$exists['bounceCount']+1;
				bounceReview::where('reviewID','=',$reviewID)
				->update([
					'bounceCount'	=> $bounceCount,
					'msgDate'		=> $msgDate,
				]);

				$theMsgID=$exists['msgID'];

			}else{

				include(app_path().'/bounces/check/badEmail_check.php');
				if($badEmail){
					$thisEmail=null;}
					
				$badFullName=null;
				if($thisFullName=='Mail Delivery Subsystem'){
					$badFullName=1;}

				if($thisEmail||($thisFullName 
				&& !$badFullName)){

					$theMsgID=$msgID;

					if($inlineFiles){
						include(app_path().'/bounces/functions/'.
							'saveInlineFiles.php');}

					$addNew=bounceReview::create([
						'msgID'				=>$msgID,
						'msgDate'			=>$loop['msgDate'],
						'thisLoop'			=>$loop['thisLoop'],
						'subject'			=>$loop['subject'],
						'eidx'				=>$loop['eidx'],
						'email'				=>$thisEmail,
						'fullName'			=>$loop['fullName'],
						'firstName'			=>$loop['firstName'],
						'middleName'		=>$loop['middleName'],
						'lastName'			=>$loop['lastName'],
						'adreCount'			=>$loop['adreCount'],
						'agentLicNum'		=>$loop['agentLicNum'],
						'employerLicNum'	=>$loop['employerLicNum'],
						'umid'				=>$loop['umid'],
						'umidCount'			=>$loop['umidCount'],
					]);

					//import bounceMessage
					include('importBounceMessage.php');
				}
			}
		}
	}
}