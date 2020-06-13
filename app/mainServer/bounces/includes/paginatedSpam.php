<?php

//Use
use Illuminate\Pagination\LengthAwarePaginator;

// Get current page form url e.x. &page=1
$currentPage = LengthAwarePaginator::resolveCurrentPage();

// Create a new Laravel collection from the array data
$itemCollection = collect($spam);
$totalSpam=count($itemCollection);

// Define how many items we want to be visible in each page
$perPage = 15;

// Slice the collection to get the items to display in current page
$currentPageItems = $itemCollection
->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

// Create our paginator and pass it to the view
$paginatedSpam=new LengthAwarePaginator($currentPageItems,
count($itemCollection), $perPage);

// set url path for generted links
$paginatedSpam->setPath($request->url());