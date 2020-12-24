<?php

//delete if exists
Schema::connection('remailsynch')
->dropIfExists('remaildeliveries2019Synch');
//re-create
$results=DB::select( DB::raw("
  create table remailsynch.remaildeliveries2019Synch
  like propdelivs
"));
//insert
$results = DB::select( DB::raw("
    INSERT INTO remailsynch.remaildeliveries2019Synch
    SELECT *
    FROM remarchives.remaildeliveries2019
"));