<?php
//2nd backup

//delete if exists
Schema::connection('remailsynch')
->dropIfExists('propmappingdeleteSynch');

//re-create
$results=DB::select( DB::raw("
  create table remailsynch.propmappingdeleteSynch
  like propmappings
"));

//insert
$results = DB::select( DB::raw("
    INSERT INTO remailsynch.propmappingdeleteSynch
    SELECT *
    FROM deletes.propmappingdelete
"));