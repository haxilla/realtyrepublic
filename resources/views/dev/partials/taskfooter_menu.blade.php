<div class="taskboxFooter">	
	
	<!-- if completed -->
	@include('dev.partials.task_complete')

	<!-- admin & tasktype -->
	<div class="inlineBlock valign-mid">
		@include('dev.partials.task_admin')
		@include('dev.partials.task_type')
	</div>

	<!-- circles menu -->
	<div class="inlineBlock taskOptions text-center">
		@include('dev.partials.task_options')
	</div>

</div>