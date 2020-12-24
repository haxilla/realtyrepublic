<?php

//alert if no propdelivnow table
if(!Schema::hasTable('propdeliv')){
  dd('no propdeliv table!!');}

// If none, create propdelivnow
if(!Schema::hasTable('propdelivnow')){
  $results=DB::select( DB::raw("
    create table propdelivnow
    like propdelivs
  "));
}

// If none, create propdelivnowSynch
if(!Schema::connection('remailsynch')
->hasTable('propdelivnowSynch')){
  $results=DB::select( DB::raw("
    create table remailsynch.propdelivnowSynch
    like propdelivs
  "));
};

// If none, create propdelivnowBackup
if(!Schema::connection('remailsynch')
->hasTable('propdelivnowBackup')){
  $results=DB::select( DB::raw("
    create table remailsynch.propdelivnowBackup
    like propdelivs
  "));
};