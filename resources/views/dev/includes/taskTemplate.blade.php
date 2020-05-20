<!-- * Task Header * -->
<div class="taskboxFrame" data-taskid="{{$the->taskID}}"
data-listref="{{$the->listRef}}" data-taskstatus="{{$taskstatus}}">

	<div class="taskheaderMenu taskheaderMenu{{$the->taskID}}">
		<!-- taskFlag, taskSection, authLevel -->
		@include('dev.partials.taskheader_menu')

	</div>

	<div class="taskBox taskBox{{$the->taskID}}">
		<!-- * Tasks * -->
		<div class="taskshowFrame">
			<!-- View task -->
			@include('dev.partials.task_show')
			<!-- Edit task -->
			@include('dev.partials.task_edit')

		</div>
		<!-- tasksteps -->
		<div class="taskstepFrame">
			<!-- tasksteps & taskmetas -->
			@include('dev.partials.taskstepBlock')

		</div>
		<div class="frame linksFrame"
		data-theclass="links">
			<!-- retrieve & display links 
					in foreach loop -->
			@include('dev.partials.link_display')
		</div>
		<div class="frame taskcommentFrame"
		data-theclass="comment">
			<!-- * Comments * -->
			<!-- Ajax Before Content -->
			<div class="ajaxNewComment 
			ajaxNewComment{{$the->taskID}}"></div>
			<!-- if comments -->
			@include('dev.partials.task_comments')
			<!-- Ajax After Content -->
			<div class="ajaxComment ajaxComment{{$the->taskID}}"></div>
			<!-- * Form * -->
			<!-- Add Comments -->
			@include('dev.partials.comment_add')

		</div>
		<div class="frame linkFrame{{$the->taskID}}"
		data-theclass="link">
			<!-- * Form * -->
			<!-- Add Links -->
			@include('dev.partials.link_add')

		</div>

		<!-- * taskFooter * -->
		<div class="taskfooterMenu">
			<!-- taskBox Footer -->
			@include('dev.partials.taskfooter_menu')

		</div>

	</div>

</div>

