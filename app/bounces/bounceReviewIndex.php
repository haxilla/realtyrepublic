<?php

Use App\bounces\models\bounceReview;

$groupedBy=request('groupedBy');

if(!$groupedBy){
	$groupedBy='msgID';}

//return num_msg in inbox
include(app_path().'/bounces/streams/realtye-mails_inbox.php');
imap_close($mbox);

$bounceReviews=bounceReview::get()
->groupBy($groupedBy);

$bounceReviews=bounceReview::orderBy($groupedBy)
->get()
->groupBy(function($item) Use($groupedBy){
	return $item->$groupedBy;
});