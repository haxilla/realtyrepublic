<?php

//backup existing before dropping
Schema::connection('remailsynch')
->dropIfExists('propmappingdeleteBackup');

//create propagentSynch Table
$results=DB::select( DB::raw("
  create table remailsynch.propmappingdeleteBackup
  like propmappings
"));

//insert
$results = DB::select( DB::raw("
    INSERT INTO remailsynch.propmappingdeleteBackup
    SELECT *
    FROM deletes.propmappingdelete
"));