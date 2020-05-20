<?php

Use App\devJournal\models\devtask;

//activeTasks	
$activeTasks=devtask::whereNull('taskComplete')
->whereNull('softDelete')
->where(function($q){
	$q->whereNull('snoozeDate')
	  ->orWhere('snoozeDate','<=',\Carbon\Carbon::now());
})
->with(['taskComments'=>function($q){
   $q->whereNull('softDelete');
}])
->with('adminInfo')
->orderBy('lastComment','desc')
->get();

//completeTasks
$completeTasks=devtask::whereNotNull('taskComplete')
->with(['taskComments'=>function($q){
   $q->whereNull('softDelete');
}])
->whereNull('softDelete')
->with('adminInfo')
->orderBy('taskComplete','desc')
->take(15)
->get();