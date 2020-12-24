<?php
//models
Use App\models\oldsite\oldetrack2019;
Use App\models\etrack\etrack2019;

//last date comparison
$local=etrack2019::select('etrackid','etrackdate')
->orderby('etrackdate','desc')
->whereNotNull('etrackdate')
->first();
 
$remote=oldetrack2019::select('etrackid','etrackdate')
->orderby('etrackdate','desc')
->whereNotNull('etrackdate')
->first();
$localDate=$local['etrackdate'];
//get new record
$update=oldetrack2019::where('etrackDate','>',$localDate)
->whereNotNull('etrackdate')
->get();

//loop insert into local
foreach($update as $the){
   etrack2018::create([
      'etrackdate' =>$the->etrackdate,
      'ufid'       =>$the->ufid,
      'ei'         =>$the->ei,
      'ci'         =>$the->ci,
      'ip'         =>$the->ip,
      'eid'        =>$the->eid,
      'area'       =>$the->area,
      'umid'       =>$the->umid,
      'email'      =>$the->email,
      'etrackid'   =>$the->etrackid,
      'vt'         =>$the->vt,
      'mls'        =>$the->mls,
      'rm'         =>$the->rm,
      'server'     =>$the->server,
      'notice'     =>$the->notice,
      'noticetime' =>$the->noticetime,
      'agtcontact' =>$the->agtcontact
   ]);
}

//output json & exit
$idArray = array(
  'status'          => 'success',
  'next'            => 'complete',
  'message1'        => 'etrack2018 updated',
  'message2'        => 'Complete!'
);
echo json_encode($idArray);
exit();
