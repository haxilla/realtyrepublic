<?php

Use App\devJournal\models\devtask;
Use App\devJournal\models\devexcuse;
Use App\devJournal\models\devtip;
Use App\devJournal\models\devtaskcomment;

if($listRef=="devtaskcomment"){

	//find task
	$taskquery=devtask::where('taskID','=',$taskID)
	->with('adminInfo')
	->with('taskComments')
	->paginate(5);

	if($taskquery->first()){
		if($taskquery->first()->taskComplete){
			$taskstatus="Completed";
		}elseif($taskquery->first()->snoozeDate
		||$taskquery->first()->indefinite){
			$taskstatus="Snoozed";
		}elseif($taskquery->first()->softDelete){
			$taskstatus="Deleted";
		}else{
			$taskstatus="Active";}
	}
	
	//devtip
	if(!$taskquery->first()){
		$taskstatus="Tips";
		$taskquery=devtip::where('taskID','=',$taskID)
		->with('adminInfo')
		->with('taskComments')
		->paginate(5);}
	//devexcuse
	if(!$taskquery->first()){
		$taskstatus="Excuses";
		$taskquery=devexcuse::where('taskID','=',$taskID)
		->with('adminInfo')
		->with('taskComments')
		->paginate(5);}
	//error
	if(!$taskquery->first()){
		dd('error-line25-taskresultlink.php');}

}elseif($listRef=='devexcuse'){

	$taskstatus="Excuses";
	$taskquery=devexcuse::where('taskID','=',$taskID)
	->with('adminInfo')
	->with('taskComments')
	->paginate(5);

}elseif($listRef=='devtip'){

	$taskstatus="Tips";
	$taskquery=devtip::where('taskID','=',$taskID)
	->with('adminInfo')
	->with('taskComments')
	->paginate(5);

}elseif($listRef=='devtask'){

	//find task
	$taskquery=devtask::where('taskID','=',$taskID)
	->with('adminInfo')
	->with('taskComments')
	->paginate(5);

	if($taskquery->first()->taskComplete){
		$taskstatus="Completed";
	}elseif($taskquery->first()->snoozeDate
	||$taskquery->first()->indefinite){
		$taskstatus="Snoozed";
	}elseif($taskquery->first()->softDelete){
		$taskstatus="Deleted";
	}else{
		$taskstatus="Active";}

}else{
	dd('error-line81-taskresultlink.php');
}