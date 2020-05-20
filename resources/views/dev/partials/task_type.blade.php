<!-- create 3days ago variable -->
<?php 
	$now=\Carbon\Carbon::now();
	$taskCreated=$the->created_at;
	$fewDaysAgo=$now->subDays('3');?>

<div class="tasktype inlineBlock valign-mid inlineBlock"
data-menuclick="tasktype">
	<div class="dropMenu dropMenu{{$the->taskID}} rounder py0-px10
	@if($the->taskType) taskBadge{{$the->taskType}} 
	@elseif($fewDaysAgo < $taskCreated) taskBadgeNew
	@else taskBadgeNone 
	@endif">
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
	<div class="tasktype tasktype{{$the->taskID}} 
	dropMenuBox">
		<div class="menuItem">
			<a href="" data-menuclick="Core">
				Core
			</a>
		</div>
		<div class="menuItem">
			<a href="" data-menuclick="Feature">
				Feature
			</a>
		</div>
		<div class="menuItem">
			<a href="" data-menuclick="Bug">
				Bug
			</a>
		</div>
		<div class="menuItem">
			<a href="" data-menuclick="Clear">
				Clear
			</a>
		</div>
	</div>
	<!-- dropMenuBox ended -->
</div>
<!-- task section ended -->