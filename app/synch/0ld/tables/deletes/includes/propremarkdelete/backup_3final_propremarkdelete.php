<?php
//2nd backup

//delete if exists
Schema::connection('remailsynch')
->dropIfExists('propremarkdeleteSynch');

//re-create
$results=DB::select( DB::raw("
  create table remailsynch.propremarkdeleteSynch
  like propremarks
"));

//insert
$results = DB::select( DB::raw("
    INSERT INTO remailsynch.propremarkdeleteSynch
    SELECT *
    FROM deletes.propremarkdelete
"));