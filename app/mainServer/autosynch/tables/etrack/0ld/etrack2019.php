<?php
//models
Use App\autosynch\models\etrackCur;
Use App\autosynch\models\etrackOld;

// * last ID found by sort desc
// * get first record
$findID=etrackCur::select('etrackid')
->orderby('etrackid','desc')
->first();

//set startID
if(!$findID){
  $startID=0;
}else{
  $startID=$findID['etrackid'];}

//get records larger than local etrackid
$update=etrackOld::where('etrackid','>',$startID)
->get();

//loop insert into local
foreach($update as $the){
  //convert this record to array
  $insertThis=$the->toArray();
  //compare against this field
  $matchThese = array('etrackid' =>$the->etrackid);
  //update or create
  etrack2019::updateOrCreate($matchThese,$insertThis);}

//output json & exit
$idArray = array(
  'status'          => 'success',
  'next'            => 'complete',
  'message1'        => 'etrack2019 updated',
  'message2'        => 'Complete!'
);
echo json_encode($idArray);
exit();
