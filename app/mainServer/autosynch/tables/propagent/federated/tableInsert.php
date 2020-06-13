<?php

// GLOBAL transaction isolation level changed 
// to track number of records during insert
// reverted back to repeatable-read when completed
DB::statement("
  SET GLOBAL TRANSACTION ISOLATION LEVEL READ UNCOMMITTED;
");
//insert into propagents
DB::statement("
INSERT INTO $tableMains
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
FROM remailsynch.$tableFed;
");
//revert back to default
DB::statement("
  SET GLOBAL TRANSACTION ISOLATION LEVEL REPEATABLE READ;
");