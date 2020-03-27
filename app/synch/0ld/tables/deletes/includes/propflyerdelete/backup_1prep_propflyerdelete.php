<?php

//drop table if exists
if(!Schema::hasTable('propflyers')){
    dd('NO PROPFLYERS TABLE!');};

if(!Schema::connection('remailsynch')
->hasTable('propflyerdeleteSynch')){
  $results=DB::select( DB::raw("
    create table remailsynch.propflyerdeleteSynch
    like propflyers
  "));
};

if(!Schema::connection('remailsynch')
->hasTable('propflyerdeleteBackup')){
  $results=DB::select( DB::raw("
    create table remailsynch.propflyerdeleteBackup
    like propflyers
  "));
};