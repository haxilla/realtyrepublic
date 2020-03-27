<?php
//model
Use App\models\synch\synchLog;

//drop
Schema::dropIfExists('propagents');

//notify synch of tableDrop
synchLog::where('synchID','=',$synchID)
->update([
  'tableDrop'=>1
]);

//re-create
$results=DB::select( DB::raw("
  create table propagents
  like remailsynch.propagentBackup
"));

// GLOBAL transaction isolation level changed 
// to track number of records during insert
// reverted back to repeatable-read when completed
DB::statement("
  SET GLOBAL TRANSACTION ISOLATION LEVEL READ UNCOMMITTED;
");
//insert into propagents
DB::statement("
INSERT INTO propagents
  (
    startDate,
    expireDate,
    lastLogin,
    removalDate,
    id,
    xxagtUname,
    agtPswd,
    agtPhoto,
    agtLogo,
    agtFullName,
    agtFirst,
    agtLast,
    agtURL,
    agtDesigs,
    agtMainPhone,
    agtPhone2,
    agtEmail,
    agtWebsite,
    agtCity,
    agtState,
    agtZip,
    agtBoard,
    officeID,
    agtMLSID,
    accountType,
    IP,
    pCreds,
    remCreds
  )
SELECT
  startDate,
  expireDate,
  last_login,
  removalDate,
  umid,
  username,
  password,
  agentPhoto,
  logo,
  agentName,
  agentFirst,
  agentLast,
  agtURL,
  agentDesigs,
  agentPhone,
  agentPhone2,
  agentEmail,
  agentWebsite,
  agentCity,
  agentState,
  agentZip,
  board,
  officeID,
  agentID,
  accountType,
  IP,
  pCred,
  remCreds
FROM remailsynch.emailagents_federated;
");

//revert back to default
DB::statement("
  SET GLOBAL TRANSACTION ISOLATION LEVEL REPEATABLE READ;
");

//update tableDrop
synchLog::where('synchID','=',$synchID)
->update([
  'tableDrop'=>0
]);
