<?php

//backup existing before dropping
Schema::connection('remailsynch')
->dropIfExists('propflyerstatdeleteBackup');

//create propagentSynch Table
$results=DB::select( DB::raw("
  create table remailsynch.propflyerstatdeleteBackup
  like propflyerstats
"));

//insert
$results = DB::select( DB::raw("
    INSERT INTO remailsynch.propflyerstatdeleteBackup
    SELECT *
    FROM deletes.propflyerstatdelete
"));