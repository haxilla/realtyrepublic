<?php
//set variables
$mergeResults=null;
$results = $dupLoop['allAccounts'];
//loop results

foreach($results as $key1=>$value1){
   foreach($value1 as $key2=>$value2){
      //echo "KEY2: $key2<br>";
      foreach($value2 as $key3=>$value3){
         //echo "KEY3: $key3<br>";
         if($key3=='main' && $value3=='1'){
            $mainResults=$dupLoop['allAccounts'][$key1];
         }elseif($key3=='main' && $value3!=1){
            $mergeResults[$key1]=$dupLoop['allAccounts'][$key1];}}}}

//set mainID
$mainID=$mainResults['details']['metaIds']['propagent_id'];
//mainResult into dupLoopX
$dupLoopX['allAccounts']['mainAccount'][$mainID]=$dupLoop['allAccounts'][$mainID];
//mergeResult
if($mergeResults){
   $dupLoopX['allAccounts']['mergeAccount']=$mergeResults;}

//errors
if(array_key_exists('error', $dupLoop)){
   $dupLoopX['error']=$dupLoop['error'];}
//use summary
if(array_key_exists('useSummary', $dupLoop)){
   $dupLoopX['useSummary']=$dupLoop['useSummary'];}
//accountReport
if(array_key_exists('useSummary', $dupLoop)){
   $dupLoopX['accountReport']=$dupLoop['accountReport'];}

$remailEventLog=$dupLoopX;
$remailEventLog['accountReport']['total']['flyers']      = $totalFlyersFound;
$remailEventLog['accountReport']['total']['remCreds']    = $totalRemCredsFound;
$remailEventLog['accountReport']['total']['agtPhotos']   = $totalAgtPhotoFound;
$remailEventLog['accountReport']['total']['agtLogos']    = $totalAgtLogoFound;
$remailEventLog['accountReport']['total']['totalAgtPhotoDL']    = $totalAgtPhotoDL;
$remailEventLog['accountReport']['total']['totalAgtPhotoFound'] = $totalAgtPhotoFound;
$remailEventLog['accountReport']['total']['totalAgtLogoDL']     = $totalAgtLogoDL;
$remailEventLog['accountReport']['total']['totalAgtLogoFound']  = $totalAgtLogoFound;
//label merges
if($mergeResults){
   include('functions/mergedWithLoop.php');}

