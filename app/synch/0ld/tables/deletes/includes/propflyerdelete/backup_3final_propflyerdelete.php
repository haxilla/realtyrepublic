<?php
//2nd backup

//delete if exists
Schema::connection('remailsynch')
->dropIfExists('propflyerdeleteSynch');

//re-create
$results=DB::select( DB::raw("
  create table remailsynch.propflyerdeleteSynch
  like propflyers
"));

//insert
$results = DB::select( DB::raw("
    INSERT INTO remailsynch.propflyerdeleteSynch
    SELECT *
    FROM deletes.propflyerdelete
"));