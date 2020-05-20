<?php

Use App\devJournal\models\devtask;
Use App\devJournal\models\devtip;
Use App\devJournal\models\devexcuse;

//base query
$basequery=devtask::with('adminInfo');

if($taskstatus=='Active'){
	
	$taskquery=$basequery->whereNull('softDelete')
	->whereNull('taskComplete')
	->where(function($q){
		$q->whereNull('snoozeDate')
		  ->orWhere('snoozeDate','<=',\Carbon\Carbon::now());
	})
	->whereNull('indefinite')
	->with(['taskComments'=>function($q){
		$q->whereNull('softDelete');
	}])
	->with(['taskSteps'=>function($q){
		$q->whereNull('softDelete');
	}])
	->with(['taskDetails'=>function($q){
		$q->whereNull('softDelete');
	}])
	->where('authLevel','>=',$authLevel)
	->orderBy('stickyDate','desc')
	->orderby('lastEdit','desc');

}elseif($taskstatus=='Flagged'){

	$taskquery=$basequery->whereNull('softDelete')
	->whereNull('taskComplete')
	->where('taskFlag','>',0)
	->where(function($q){
		$q->whereNull('snoozeDate')
		  ->orWhere('snoozeDate','<=',\Carbon\Carbon::now());
	})
	->whereNull('indefinite')
	->where('authLevel','>=',$authLevel)
	->with(['taskComments'=>function($q){
	   $q->whereNull('softDelete');
	}])
	->with(['taskSteps'=>function($q){
		$q->whereNull('softDelete');
	}])
	->with(['taskDetails'=>function($q){
		$q->whereNull('softDelete');
	}])
	->orderBy('stickyDate','desc')
	->orderby('lastEdit','desc');


}elseif($taskstatus=='Completed'){

	$taskquery=$basequery->whereNull('softDelete')
	->whereNotNull('taskComplete')
	->where('authLevel','>=',$authLevel)
	->with(['taskComments'=>function($q){
	   $q->whereNull('softDelete');
	}])
	->with(['taskSteps'=>function($q){
		$q->whereNull('softDelete');
	}])
	->with(['taskDetails'=>function($q){
		$q->whereNull('softDelete');
	}])
	->orderBy('stickyDate','desc')
	->orderby('lastEdit','desc');

}elseif($taskstatus=='Snoozed'){
	
	$taskquery=$basequery
	->whereNull('softDelete')
	->where(function($q){
		$q->where('snoozeDate','>=',\Carbon\Carbon::now())
		  ->orWhereNotNull('indefinite');
		})
	->with(['taskComments'=>function($q){
		$q->whereNull('softDelete');
	}])
	->with(['taskSteps'=>function($q){
		$q->whereNull('softDelete');
	}])
	->with(['taskDetails'=>function($q){
		$q->whereNull('softDelete');
	}])
	->where('authLevel','>=',$authLevel)
	->orderby('stickyDate','desc')
	->orderby('snoozeDate','desc');

}elseif($taskstatus=='Deleted'){

	$taskquery=$basequery
	->whereNotNull('softDelete')
	->with('taskComments')
	->with('taskSteps')
	->with('taskDetails')
	->orderby('softDelete','desc');

}elseif($taskstatus=='Tips'){

	$taskquery=devtip::orderby('stickyDate','desc')
	->orderby('lastEdit','desc')
	->whereNull('softDelete')
	->with(['taskComments'=>function($q){
		$q->whereNull('softDelete');
	}])
	->with(['taskDetails'=>function($q){
		$q->whereNull('softDelete');
	}])
	->with('taskSteps')
	->with('adminInfo');

}elseif($taskstatus=='Excuses'){

	$taskquery=devexcuse::orderBy('stickyDate','desc')
	->orderby('lastEdit','desc')
	->whereNull('softDelete')
	->with(['taskComments'=>function($q){
		$q->whereNull('softDelete');
	}])
	->with(['taskDetails'=>function($q){
		$q->whereNull('softDelete');
	}])
	->with('taskSteps')
	->with('adminInfo');
	
}else{
	dd('error-line51-allTasks.php');}

//add filters if any
if($filter){
	$taskquery=$taskquery->where('taskType','=',$filter);}
//add tasksection if any
if($sectionFilter){
	$taskquery=$taskquery->where('tasksection','=',$sectionFilter);}


$taskquery=$taskquery->simplePaginate(5);