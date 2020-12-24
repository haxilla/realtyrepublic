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
    propflyer_id,
    propagent_id,
    xDeliveryCount,
    xMlsCheck,
    xSellerSendOK,
    xAgtSent,
    xLastDeliveryDate,
    xSold,
    xWebViews,
    xBonusAmt,
    xReducedAmt,
    xReducedDate,
    xOpenDateStart,
    xOpenDateEnd
  )
SELECT
  ufid,
  umid,
  delivered,
  mls_check,
  sellersendok,
  agent_sent,
  last_delivered,
  sold,
  hits,
  bonusamount,
  reducedamount,
  reduceDate,
  openDateOne,
  openDateTwo
FROM  remailsynch.$tableFed
"));

//revert back to default
DB::statement("
  SET GLOBAL TRANSACTION ISOLATION LEVEL REPEATABLE READ;
");