<?php
Use App\models\synch\synchLog;

//2nd backup
//delete if exists
Schema::connection('remailsynch')
->dropIfExists('remailsynch.propagentSynch');
//re-create
$results=DB::select( DB::raw("
  create table remailsynch.propagentSynch
  like propagents
"));
//insert
$results = DB::select( DB::raw("
    INSERT INTO remailsynch.propagentSynch
    SELECT *
    FROM propagents
"));