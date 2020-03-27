<?php

//backup existing before dropping
Schema::connection('remailsynch')
->dropIfExists('propremarkdeleteBackup');

//create propagentSynch Table
$results=DB::select( DB::raw("
  create table remailsynch.propremarkdeleteBackup
  like propremarks
"));

//insert
$results = DB::select( DB::raw("
    INSERT INTO remailsynch.propremarkdeleteBackup
    SELECT *
    FROM deletes.propremarkdelete
"));