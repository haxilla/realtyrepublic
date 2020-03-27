<?php

//2nd backup
//delete if exists
Schema::connection('remailsynch')
->dropIfExists('propmetadeleteSynch');

//re-create
$results=DB::select( DB::raw("
  create table remailsynch.propmetadeleteSynch
  like propmetas
"));

//insert
$results = DB::select( DB::raw("
    INSERT INTO remailsynch.propmetadeleteSynch
    SELECT *
    FROM deletes.propmetadelete
"));