<?php

//models
Use App\autosynch\models\etrack\etrackCur;
Use App\autosynch\models\etrack\etrackOld;

//increase memory for this one
ini_set('memory_limit', '256M');

// * last ID found by sort desc
// * get first record
$maxCurID=etrackCur::select('etrackid')
->orderby('etrackid','desc')
->first();

//set startID
if(!$maxCurID){
  $startID=0;
}else{
  $startID=$maxCurID['etrackid'];}

//get records larger than local etrackid
$getNew=etrackOld::where('etrackid','>',$startID)
->get();

//loop insert into local
foreach($getNew as $the){
  //convert this record to array
  $insertThis=$the->toArray();
  //compare against this field
  $matchThese = array('etrackid' =>$the->etrackid);
  //update or create
  etrackCur::updateOrCreate($matchThese,$insertThis);}