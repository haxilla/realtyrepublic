<?php

//model
Use App\models\synch\synchLog;

//drop
Schema::connection('deletes')
->dropIfExists('propflyerstatdelete');

//notify synch of tableDrop
synchLog::where('synchID','=',$synchID)
->update([
  'tableDrop'     => 1,
  'tableDropName' => 'propflyerstatdelete',
]);

//re-create
$results=DB::select( DB::raw("
  create table deletes.propflyerstatdelete
  like propflyerstats
"));

// GLOBAL transaction isolation level changed 
// to track number of records during insert
// reverted back to repeatable-read when completed
DB::statement("
  SET GLOBAL TRANSACTION ISOLATION LEVEL READ UNCOMMITTED;
");

// ** BEGIN INSERT
// Insert
DB::select( DB::raw("
INSERT INTO deletes.propflyerstatdelete
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
FROM  remailsynch.propflyerstatdelete_federated
"));

//revert back to default
DB::statement("
  SET GLOBAL TRANSACTION ISOLATION LEVEL REPEATABLE READ;
");

//update tableDrop
synchLog::where('synchID','=',$synchID)
->update([
  'tableDrop'     => 0,
  'tableDropName' => null
]);