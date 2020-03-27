<?php
//models
Use App\models\oldsite\oldetrack2019;
Use App\models\etrack\etrack2019;

// * last ID found by sort desc
// * get first record
$findID=etrack2019::select('etrackid')
->orderby('etrackid','desc')
->first();

//set startID
if(!$findID){
  $startID=0;
}else{
  $startID=$findID['etrackid'];}

//get records larger than local etrackid
$update=oldetrack2019::where('etrackid','>',$startID)
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
