<div class="taskShow taskShow{{$the->taskID}} taskDesc">
	<div class="taskshowBox">
		<span class="taskDescSpan">
			@if($taskstatus=='Tips')
				{{$the->tipDesc}}
			@elseif($taskstatus=='Excuses')
				{{$the->excuseDesc}}
			@else
				{{$the->taskDesc}}
			@endif
		</span>
	</div>
</div>