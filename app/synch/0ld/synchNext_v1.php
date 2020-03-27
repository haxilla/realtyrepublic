<?php

use App\models\synch\synchLog;

//count before starting synch
if($next!="complete"){
	include(app_path().'/synch/synchLog/preCounts.php');}

//determine next & synch
if($next=="propagent"){

	//for single synch
	if($synchType=='synchOne'){
		$partialSynch=1;
		$partialNext='agtoffice';}

	$tableMain=$next;
	//reset code
	include(app_path().'/autosynch/synchTable.php');

}elseif($next=="agtoffice"){

	//for single synch
	if($synchType=='synchOne'){
		$partialComplete=1;}

	//reset code
	include(app_path().'/synch/resets/agent/resetAgtOffice.php');

}elseif($next=="propflyer"){
	
	if($synchType=='synchOne'){
		$partialSynch=1;
		$partialNext='propflyerstat';}
	// functioning synch code here

}elseif($next=="propflyerstat"){

	if($synchType=='synchOne'){
		$partialSynch=1;
		$partialNext='propmapping';}
	// functioning synch code here
		
}elseif($next=="propmapping"){

	if($synchType=='synchOne'){
		$partialSynch=1;
		$partialNext='propmeta';}
	// functioning synch code here

}elseif($next=="propmeta"){
	
	if($synchType=='synchOne'){
		$partialSynch=1;
		$partialNext='propremark';}
	// functioning synch code here

}elseif($next=="propremark"){

	if($synchType=='synchOne'){
		$partialSynch=1;
		$partialNext='propstyle';}
	// functioning synch code here

}elseif($next=="propstyle"){

	if($synchType=='synchOne'){
		$partialComplete=1;}
	// functioning synch code here

}elseif($next=="propphoto"){
	
	// functioning synch code here

}elseif($next=="propdeliv"){
	
	// functioning synch code here

}elseif($next=="propdelivnow"){
	
	// functioning synch code here

}elseif($next=="allorder"){
	
	// functioning synch code here

}elseif($next=="etrack"){
	
	// functioning synch code here

}elseif($next=="emailremoval"){
	
	// functioning synch code here

}elseif($next=="deleteflyer"){
	
	if($synchType=='synchOne'){
		$partialSynch=1;
		$partialNext='deletepropflyerstat';}
	//functioning synch code here

}elseif($next=="deletepropflyerstat"){

	if($synchType=='synchOne'){
		$partialSynch=1;
		$partialNext='deletepropmapping';}
	//functioning synch code here

}elseif($next=="deletepropmapping"){
	
	if($synchType=='synchOne'){
		$partialSynch=1;
		$partialNext='deletepropmeta';}
	//functioning synch code here

}elseif($next=="deletepropmeta"){
	
	if($synchType=='synchOne'){
		$partialSynch=1;
		$partialNext='deletepropremark';}
	//functioning synch code here

}elseif($next=="deletepropremark"){
	
	if($synchType=='synchOne'){
		$partialComplete=1;}
	//functioning synch code here
}elseif($next=="deletestyle"){
	
	// functioning synch code here

}elseif($next=="deletephoto"){
	
	// functioning synch code here

}elseif($next=="complete"){
	
	// functioning synch code here

}else{
	dd($next.'- errorline27-synchNext.php');
}

//end of synch log
include(app_path().'/synch/synchLog/completeLog.php');