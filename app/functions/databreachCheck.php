<?php

//model
use App\models\oldsite\oldAgent;
//main query
$databreach=oldAgent::where('agentCompany','=',"google")
->get();
//run loop
foreach($databreach as $the){
	// set umid
	$umid=$the->umid;
	// run statement
	\DB::connection('oldsite')
	->statement("
		INSERT INTO accountbreaches
		select * from emailagents
		where umid=$umid");
	// delete from main emailagent table
	oldAgent::where('umid','=',$umid)
	->where('agentcompany','=','google')
	->delete();
}
