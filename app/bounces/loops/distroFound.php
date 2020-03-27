<?php

//distroFound array
//created in previous include
//inside resultLoop.php

foreach($distroFound as $the){
	//set uid
	$uid=$the['uid'];
	// insert or update bounceCount
	include(app_path().'/bounces/includes/bounceWorksheet.php');
	// bounce history
	include(app_path().'/bounces/includes/bounceHistory.php');
	// mark for delete
	imap_delete($mbox, $uid, FT_UID);}