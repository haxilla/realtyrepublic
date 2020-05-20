@if($taskstatus=='Completed')
	<div class="mb5">
		<div class="inlineBlock taskBadge lighter2">
			{{$the->versionTag}}
		</div>
		<div class="inlineBlock taskBadge lighter2">
			{{$the->taskComplete->diffForHumans($the->created_at,true)}}
		</div>
	</div>
@endif