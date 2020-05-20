<div style="padding:10px;color:#464555;">
	@foreach($tasksearch as $the)
		<div class="taskresultItem">
			<a href="/dev/taskResultLink?taskID={{$the->taskID}}&listRef={{$the->listRef}}">
				@if($the->listRef!="devtask")
					<span class="taskBadge lighter5">{{$the->listRef}}</span>
				@endif {{$the->taskDesc}}
			</a>	
		</div>
	@endforeach
</div>