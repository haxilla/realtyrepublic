<div class="floatLeft"
style="background:#223e94;padding:10px;
border-top-right-radius:1.25em;padding-bottom:5px;">
	@include('dev.partials.task_flag')
	@include('dev.partials.task_section')
	@include('dev.partials.task_authlevel')
</div>
<div class="floatRight text-center taskOptions">
	@include('dev.partials.task_sticky')
</div>
<div style="clear:both">
</div>
@if($taskstatus=='Snoozed')
	<div style="background:#223e94;color:#fff;">
		<div class="inlineBlock ml15" 
		style="vertical-align:middle;font-size:.65em;">
			Until: 
		</div>
		<div class="taskBadge lighter2" style="margin-top:5px;">
			<span>
				<i class="ti-timer"></i>
			</span>
			<span>
				@if($the->indefinite)
					Indefinite
				@else			
					{{$the->snoozeDate->toDateString()}}
				@endif
			</span>
		</div>
	</div>
@else
	<div class="pl15 pt15" 
	style="background:#223e94;color:#fff;font-size:.75em;">
		<div class="rounder lighter1 inlineBlock py5-px10">
			{{$the->created_at->toDateString()}}  
			<span class="darker2 rounder ml10 py0-px5">
				{{$the->created_at->diffForHumans()}}
			</span>
		</div>
	</div>
@endif
