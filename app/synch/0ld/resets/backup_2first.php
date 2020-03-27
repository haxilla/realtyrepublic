<?php
//  ** BACKUP CODE
//backup existing propagent before dropping
Schema::connection('remailsynch')
->dropIfExists('propagentBackup');

//notify synch of tableDrop
synchLog::where('synchID','=',$synchID)
->update([
  'tableDrop'     => 1,
  'tableDropName' => 'propagentBackup',
]);

//create propagentBackup Table
$results=DB::select( DB::raw("
  create table remailsynch.propagentBackup
  like propagents
"));
//insert
$results = DB::select( DB::raw("
    INSERT INTO remailsynch.propagentBackup
    SELECT *
    FROM propagents
"));
