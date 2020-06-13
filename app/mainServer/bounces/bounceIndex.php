<?php

//Use
use Illuminate\Pagination\LengthAwarePaginator;

//returns $result
include('streams/realtye-mails_inbox.php');

// Get current page form url e.x. &page=1
$currentPage = LengthAwarePaginator::resolveCurrentPage();

// Fetch an overview for all messages in INBOX
//$result = imap_fetch_overview($mbox,"1:{$MC->Nmsgs}",0);
$result = imap_fetch_overview($mbox,"1:$max",0);

// Create a new Laravel collection from the array data
$itemCollection = collect($result);

// Define how many items we want to be visible in each page
$perPage = 15;

// Slice the collection to get the items to display in current page
$currentPageItems = $itemCollection
->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

// Create our paginator and pass it to the view
$paginatedItems=new LengthAwarePaginator($currentPageItems,
count($itemCollection), $perPage);

// set url path for generted links
$paginatedItems->setPath($request->url());

//total messages in mailbox
$msgCount=imap_num_msg($mbox);

//close connection      
imap_close($mbox);