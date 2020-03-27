<?php
//move from oldAgent to propagent
Use App\models\oldsite\oldAgent;
Use App\models\core\propagent;
Use App\models\synch\propagentBackup;
use App\models\synch\synchProgress;

//query old site
$oldAgentAll=oldAgent::select('startDate','expireDate','last_login',
  'removalDate','umid','username','password','agentPhoto','logo','agentName',
  'agentFirst','agentLast','agentDesigs','agentPhone','agentPhone2','agentEmail',
  'agentWebsite','agentCity','agentState','agentZip','board','officeID',
  'agentID','accountType','IP','pCred','remCreds')
->get();
//set counts
$totalRecords=$oldAgentAll->count();
$oldAgentCount=oldAgent::oldAgentCount();
$currentAgentCount=propagent::thisAgentCount();

$loopCount=0;
//run loop and insert from old database
foreach($oldAgentAll as $the){
  //set values
  propagent::create([
    'startDate'     => $the->startDate,
    'expireDate'    => $the->expireDate,
    'lastLogin'     => $the->last_login,
    'removalDate'   => $the->removalDate,
    'id'            => $the->umid,
    'xxAgtUname'    => $the->username,
    'agtPswd'       => $the->password,
    'agtPhoto'      => $the->agentPhoto,
    'agtLogo'       => $the->logo,
    'agtFullName'   => $the->agentName,
    'agtFirst'      => $the->agentFirst,
    'agtLast'       => $the->agentLast,
    'agtDesigs'     => $the->agentDesigs,
    'agtMainPhone'  => $the->agentPhone,
    'agtPhone2'     => $the->agentPhone2,
    'agtEmail'      => $the->agentEmail,
    'agtWebsite'    => $the->agentWebsite,
    'agtCity'       => $the->agentCity,
    'agtState'      => $the->agentState,
    'agtZip'        => $the->agentZip,
    'agtBoard'      => $the->board,
    'officeID'      => $the->officeID,
    'agtMlsID'      => $the->agentID,
    'accountType'   => $the->accountType,
    'IP'            => $the->IP,
    'pCreds'        => $the->pCred,
    'remCreds'      => $the->remCreds,
  ]);
  $loopCount++;
  // synch progress
  synchProgress::where('id','=',1)
  ->update([
    'propagentCount'=>$loopCount,
    'propagentTime'=>\Carbon\Carbon::now(),
  ]);

}//end loop;

//  Important step - Save Before & After
// propagentBackup before / propagentSynch after
Schema::dropIfExists('propagentSynch');
//create propagentSynch Table
$results=DB::select( DB::raw("
  create table propagentSynch
  like propagents
"));
//insert
$results = DB::select( DB::raw("
    INSERT INTO propagentSynch
    SELECT *
    FROM propagents
"));

//output json & exit
$idArray = array(
  'status'  => 'clearInterval',
);
echo json_encode($idArray);
exit();
