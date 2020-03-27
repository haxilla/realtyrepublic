<?php

// BACKUP
// drop old 
Schema::connection('remailsynch')
->dropIfExists('remaildeliveries2019Backup');

//create propdelivBackup Table
$results=DB::select( DB::raw("
  create table remailsynch.remaildeliveries2019Backup
  like propdelivs
"));

//insert
$results = DB::select( DB::raw("
    INSERT INTO remailsynch.remaildeliveries2019Backup
    SELECT *
    FROM remarchives.remaildeliveries2019
"));

// MAIN TABLE
// drop old
Schema::connection('remarchives')
->dropIfExists('remaildeliveries2019');

//re-create
$results=DB::select( DB::raw("
  create table remarchives.remaildeliveries2019
  like propdelivs
"));