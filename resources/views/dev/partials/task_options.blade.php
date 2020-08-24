<!-- left side group -->
<div class="inlineBlock">
	@include('dev.partials.task_comment_menu')
	@include('dev.partials.task_link_menu')
	<!--
	@ include('dev.partials.task_wizard')
	-->
	@include('dev.partials.task_snooze')
</div>

<!-- mark done button -->
<div class="inlineBlock absolute-right10 absolute-top10">
	@include('dev.partials.task_atomopen')
	@if(env('APP_ENV')=='dev')
		@include('dev.partials.task_gitpush')
	@endif
	@include('dev.partials.task_markdone')
</div>
