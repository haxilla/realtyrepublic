<?php

//alert
if(!Schema::hasTable('propmetas')){
  dd('no propmetas table!!');
};

//create if doesnt exist
if(!Schema::connection('remailsynch')
->hasTable('propmetadeleteSynch')){
	$results=DB::select( DB::raw("
		create table remailsynch.propmetadeleteSynch
		like propmetas
	"));
};

if(!Schema::connection('remailsynch')
->hasTable('propmetadeleteBackup')){
	$results=DB::select( DB::raw("
		create table remailsynch.propmetadeleteBackup
		like propmetas
	"));
};