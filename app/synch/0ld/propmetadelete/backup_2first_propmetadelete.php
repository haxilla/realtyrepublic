<?php

//backup existing before dropping
Schema::connection('remailsynch')
->dropIfExists('propmetadeleteBackup');

//create propagentSynch Table
$results=DB::select( DB::raw("
  create table remailsynch.propmetadeleteBackup
  like propmetas
"));

//insert
$results = DB::select( DB::raw("
    INSERT INTO remailsynch.propmetadeleteBackup
    SELECT *
    FROM deletes.propmetadelete
"));