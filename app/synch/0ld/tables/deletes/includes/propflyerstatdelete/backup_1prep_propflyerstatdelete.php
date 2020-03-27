<?php
//alert
if(!Schema::hasTable('propflyerstats')){
  dd('no propflyerstats table!!');
};

//create if doesnt exist
if(!Schema::connection('remailsynch')
->hasTable('propflyerstatdeleteSynch')){
	$results=DB::select( DB::raw("
		create table remailsynch.propflyerstatdeleteSynch
		like propflyerstats
	"));
};

if(!Schema::connection('remailsynch')
->hasTable('propflyerstatdeleteBackup')){
  $results=DB::select( DB::raw("
    create table remailsynch.propflyerstatdeleteBackup
    like propflyerstats
  "));
};