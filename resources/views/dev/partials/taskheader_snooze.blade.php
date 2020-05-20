@if($taskstatus=='Snoozed')
	<div class="inlineBlock" 
	style="vertical-align:middle;font-size:.65em">
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
@endif