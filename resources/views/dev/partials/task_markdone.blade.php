@if(!$the->taskComplete && $taskstatus!="Deleted"
&& $taskstatus!="Tips" && $taskstatus!="Excuses")
	<div class="small circle lighter2 inlineBlock"
	data-toggle="tooltip" title="Mark Done" 
	data-taskclick="taskcomplete">
		<i class="ti-check-box"></i>
	</div>
@elseif($taskstatus=='Completed')
	<div class="small circle lighter2 inlineBlock"
	data-toggle="tooltip" title="Restore Active" 
	data-taskclick="taskcompleterestore">
		<i class="ti-back-left"></i>
	</div>
@elseif($taskstatus=='Deleted')
	<div class="small circle lighter2 inlineBlock"
	data-toggle="tooltip" title="Restore Active" 
	data-taskclick="taskdeleterestore">
		<i class="ti-back-left"></i>
	</div>
@endif