<?php

include('tableVars.php');

//drop table if exists
if(!Schema::hasTable($tableMaster)){
  dd('NO '.$tableMaster. 'TABLE!!');}

if(!Schema::connection('remailsynch')
->hasTable($tableSynch)){
  $results=DB::select( DB::raw("
    create table remailsynch.$tableSynch
    like $tableMaster
  "));
};

if(!Schema::connection('remailsynch')
->hasTable($tableBackup)){
  $results=DB::select( DB::raw("
    create table remailsynch.$tableBackup
    like $tableMaster
  "));
};
