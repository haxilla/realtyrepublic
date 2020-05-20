<div class="taskBox taskBox{{$the->taskID}}" data-taskid="{{$the->taskID}}"
data-listref="{{$the->listRef}}" data-taskstatus="{{$taskstatus}}">
	
	<!-- * Task Header * -->
	<div class="taskHeaderMenu">
		<!-- taskFlag, taskSection, authLevel -->
		@include('dev.partials.taskheader_menu')

	</div>

	<!-- * Tasks * -->
	<!-- View task -->
	@include('dev.partials.task_show')
	<!-- Edit task -->
	@include('dev.partials.task_edit')

	<div class="taskstepBlock">
		<!-- tasksteps & taskmetas -->
		@include('dev.partials.taskstepBlock')
	</div>

	<!-- * Comments & taskFooter * -->
	<div class="taskFooterMenu">
		<!-- * Comments * -->
		<!-- Ajax Before Content -->
		<div class="ajaxNewComment ajaxNewComment{{$the->taskID}}"></div>
		<!-- if comments -->
		@include('dev.partials.task_comments')
		<!-- Ajax After Content -->
		<div class="ajaxComment ajaxComment{{$the->taskID}}"></div>

		<!-- * Form * -->
		<!-- Add Comments -->
		@include('dev.partials.comment_add')

		<!-- taskBox Footer -->
		@include('dev.partials.taskfooter_menu')

	</div>

</div>