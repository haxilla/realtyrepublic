<?php

//backup existing propagent before dropping
Schema::connection('remailsynch')
->dropIfExists('propflyerdeleteBackup');
//create propagentSynch Table
$results=DB::select( DB::raw("
  create table remailsynch.propflyerdeleteBackup
  like propflyers
"));
//insert
$results = DB::select( DB::raw("
    INSERT INTO remailsynch.propflyerdeleteBackup
    SELECT *
    FROM deletes.propflyerdelete
"));