<?php


//backup existing propagent before dropping
Schema::connection('remailsynch')
->dropIfExists('agtofficeBackup');

//notify synch of tableDrop
synchLog::where('synchID','=',$synchID)
->update([
  'tableDrop'     => 1,
  'tableDropName' => 'agtofficeBackup',
]);

//create propagentBackup Table
$results=DB::select( DB::raw("
  create table remailsynch.agtofficeBackup
  like propagents
"));

//for reading progress on records
DB::statement("
  SET GLOBAL TRANSACTION ISOLATION LEVEL READ UNCOMMITTED;
");

//insert
$results = DB::select( DB::raw("
    INSERT INTO remailsynch.agtofficeBackup
    SELECT *
    FROM agtoffices
"));

//revert back to default
DB::statement("
  SET GLOBAL TRANSACTION ISOLATION LEVEL REPEATABLE READ;
");

//update tableDrop
synchLog::where('synchID','=',$synchID)
->update([
  'tableDrop'=>0
]);