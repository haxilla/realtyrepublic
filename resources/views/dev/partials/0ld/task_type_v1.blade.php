<!-- create 3days ago variable -->
<?php 
	$now=\Carbon\Carbon::now();
	$taskCreated=$the->created_at;
	$fewDaysAgo=$now->subDays('3');?>

<!-- taskBadge -->
<div class="taskBadge tasktype
@if($the->taskType) taskBadge{{$the->taskType}} 
@elseif($fewDaysAgo < $taskCreated) taskBadgeNew
@else taskBadgeNone 
@endif inlineBlock" data-menuclick="tasktype">

	@if($the->taskType)
		{{$the->taskType}}
	@elseif($fewDaysAgo < $taskCreated)
		New!
	@else
		<span class="mr15">
			<i class="ti-help-alt"></i>
		</span>
		<span class="angleDown">
			<i class="ti-angle-down"></i>
		</span>
	@endif

</div>