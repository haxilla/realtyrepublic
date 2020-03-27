<?php

//alert
if(!Schema::hasTable('propremarks')){
  dd('no propremarks table!!');
};

//create if doesnt exist
if(!Schema::connection('remailsynch')
->hasTable('propremarkdeleteSynch')){
	$results=DB::select( DB::raw("
		create table remailsynch.propremarkdeleteSynch
		like propremarks
	"));
};

if(!Schema::connection('remailsynch')
->hasTable('propremarkdeleteBackup')){
	$results=DB::select( DB::raw("
		create table remailsynch.propremarkdeleteBackup
		like propremarks
	"));
};