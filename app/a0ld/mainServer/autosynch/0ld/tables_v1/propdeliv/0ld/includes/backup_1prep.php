<?php
//alert if no propdelivs table
if(!Schema::hasTable('propdelivs')){
    dd('no propdelivs table!');
};

//if remaildelieries2019Synch table
//does NOT exist create it
if(!Schema::connection('remailsynch')
->hasTable('remaildeliveries2019Synch')){
  $results=DB::select( DB::raw("
    create table remailsynch.remaildeliveries2019Synch
    like propdelivs
  "));
};

//if remaildelieries2019Backup table
//does NOT exist create it
if(!Schema::connection('remailsynch')
->hasTable('remaildeliveries2019Backup')){
  $results=DB::select( DB::raw("
    create table remailsynch.remaildeliveries2019Backup
    like propdelivs
  "));
};