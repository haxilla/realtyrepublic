<?php

//delete if exists
Schema::connection('remailsynch')
->dropIfExists('propdelivnowSynch');
//re-create
$results=DB::select( DB::raw("
  create table remailsynch.propdelivnowSynch
  like propdelivs
"));
//insert
$results = DB::select( DB::raw("
    INSERT INTO remailsynch.propdelivnowSynch
    SELECT *
    FROM propdelivnow
"));