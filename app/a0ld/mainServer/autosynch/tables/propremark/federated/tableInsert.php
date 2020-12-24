<?php

// GLOBAL transaction isolation level changed 
// to track number of records during insert
// reverted back to repeatable-read when completed
DB::statement("
  SET GLOBAL TRANSACTION ISOLATION LEVEL READ UNCOMMITTED;
");
// ** Recreate - BEGIN INSERT
DB::select( DB::raw("
INSERT INTO $tableMains
  (
    propflyer_id,
    propagent_id,
    hideRemarks,
    xPubRemarks,
    xb1,
    xb2,
    xb3,
    xb4,
    xb5,
    xb6,
    xb7,
    xb8
  )
SELECT
  ufid,
  umid,
  remarkLink,
  e_remarks,
  b1,
  b2,
  b3,
  b4,
  b5,
  b6,
  b7,
  b8
FROM remailsynch.$tableFed
"));

//revert back to default
DB::statement("
  SET GLOBAL TRANSACTION ISOLATION LEVEL REPEATABLE READ;
");