<?php

//alert
if(!Schema::hasTable('propmappings')){
  dd('no propmappings table!!');
};

//create if doesnt exist
if(!Schema::connection('remailsynch')
->hasTable('propmappingdeleteSynch')){
	$results=DB::select( DB::raw("
		create table remailsynch.propmappingdeleteSynch
		like propmappings
	"));
};

if(!Schema::connection('remailsynch')
->hasTable('propmappingdeleteBackup')){
	$results=DB::select( DB::raw("
		create table remailsynch.propmappingdeleteBackup
		like propmappings
	"));
};