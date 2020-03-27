<?php

// GLOBAL transaction isolation level changed 
// to track number of records during insert
// reverted back to repeatable-read when completed
DB::statement("
  SET GLOBAL TRANSACTION ISOLATION LEVEL READ UNCOMMITTED;
");

// ** BEGIN INSERT
// Insert
DB::select( DB::raw("
  INSERT INTO $tableMains
    (
      entry_date,
      email,
      propflyer_id,
      eid,
      ip,
      ci,
      agentid
    )
  SELECT
    date,
    email,
    ufid,
    eid,
    ip,
    ci,
    agentid
  FROM remailsynch.$tableFed
"));

//revert back to default
DB::statement("
  SET GLOBAL TRANSACTION ISOLATION LEVEL REPEATABLE READ;
");

