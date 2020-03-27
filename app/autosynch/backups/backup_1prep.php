<?php

// if table not found alert
if(!Schema::connection($tableSchema)
->hasTable($tableMains)){
  dd('NO '.$tableMains. 'TABLE!!');}

//create if needed
if(!Schema::connection('remailsynch')
->hasTable($tableSynch)){
  $results=DB::select( DB::raw("
    create table remailsynch.$tableSynch
    like $tableSchema.$tableMains
  "));
};

if(!Schema::connection('remailsynch')
->hasTable($tableBackup)){
  $results=DB::select( DB::raw("
    create table remailsynch.$tableBackup
    like $tableSchema.$tableMains
  "));
};
