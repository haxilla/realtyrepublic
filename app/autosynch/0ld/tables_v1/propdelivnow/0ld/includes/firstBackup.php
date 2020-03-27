<?php

//drop current backup
Schema::connection('remailsynch')
->dropIfExists('propdelivnowBackup');
//create propdelivBackup Table
$results=DB::select( DB::raw("
  create table remailsynch.propdelivnowBackup
  like propdelivs
"));
//insert
$results = DB::select( DB::raw("
    INSERT INTO remailsynch.propdelivnowBackup
    SELECT *
    FROM propdelivnow
"));