<?php

Use App\models\synch\synchLog;

//find which schema table is in
include(app_path().'/autosynch/variables/checkSchema.php');

//if deletes schema
if($checkSchema=='deletes'){

	//default
	Schema::connection('deletes')
	->dropIfExists($tableMains);

	//recreate
	$results=DB::select( DB::raw("
	  create table deletes.$tableMains
	  like remailsynch.$tableBackup
	"));

}else{

	//default
	Schema::dropIfExists($tableMains);
	//re-create
	$results=DB::select( DB::raw("
	  create table $tableMains
	  like remailsynch.$tableBackup
	"));

}

//notify synch of tableDrop
synchLog::where('synchID','=',$synchID)
->update([
  'tableDrop'     	=> 1,
  'tableDropName' 	=> $tableMains,
  'progressMessage'	=> "Importing New Info"
]);