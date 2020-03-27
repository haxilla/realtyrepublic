<?php

//table variables
include('tableVars.php');

//drop table if exists
if(!Schema::hasTable($tableMains)){
  dd('NO '.$tableMains. 'TABLE!!');}

if(!Schema::connection('remailsynch')
->hasTable($tableSynch)){
  $results=DB::select( DB::raw("
    create table remailsynch.$tableSynch
    like $tableMains
  "));
};

if(!Schema::connection('remailsynch')
->hasTable($tableBackup)){
  $results=DB::select( DB::raw("
    create table remailsynch.$tableBackup
    like $tableMains
  "));
};
