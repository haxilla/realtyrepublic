@if(!$the->taskComplete && $taskstatus!="Deleted"
&& $taskstatus!="Tips" && $taskstatus!="Excuses")
	<div class="small circle lighter2 inlineBlock"
	data-toggle="tooltip" title="Git Push"
	data-taskclick="taskgitpush">
		<i class="ti-github"></i>
	</div>
@endif
