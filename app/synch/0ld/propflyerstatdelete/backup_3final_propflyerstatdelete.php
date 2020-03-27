<?php
//2nd backup

//delete if exists
Schema::connection('remailsynch')
->dropIfExists('propflyerstatdeleteSynch');

//re-create
$results=DB::select( DB::raw("
  create table remailsynch.propflyerstatdeleteSynch
  like propflyerstats
"));

//insert
$results = DB::select( DB::raw("
    INSERT INTO remailsynch.propflyerstatdeleteSynch
    SELECT *
    FROM deletes.propflyerstatdelete
"));