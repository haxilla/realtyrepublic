<?php

//function find key by value
include(app_path().'/functions/arrays/filter_by_value.php');
//set variables
$results = $dupLoop['allAccounts'][$thisID]['details'];
//filter
$mainResults   = filter_by_value($results, 'main', '1');
$mergeResult   = filter_by_value($results, 'main', '0');

dd($mainResults);
//mainResult
foreach($mainResults as $the){
   $thisID=$the['details']['metaIds']['propagent_id'];
   $dupLoopX['allAccounts']['mainAccount'][$thisID]=$dupLoop['allAccounts'];
}
//mergeResult
if($mergeResult){
   foreach($mergeResult as $the){
      $thisID=$the['metaIds']['propagent_id'];
      $dupLoopX['allAccounts']['mergeAccount'][$thisID]
      =$dupLoop['allAccounts'][$thisID];}
}

//set log
$dupLoopX['error']=$dupLoop['error'];
$remailEventLog=$dupLoopX;
