<div class="taskEdit taskEdit{{$the->taskID}} taskDesc">
	<div class="taskEditDiv">
		<form class="taskEditForm{{$the->taskID}}"
		id="{{$the->taskID}}">
			{{csrf_field()}}
			<textarea
			name="taskDesc" 
			class="taskEditField 
			noScroll 
			noResize">@if($the->taskDesc){{$the->taskDesc}}@elseif($the->tipDesc){{$the->tipDesc}}@elseif($the->excuseDesc){{$the->excuseDesc}}@endif</textarea>
		</form>
	</div>
	<div class="taskDeleteDiv">
		<div class="taskDeleteButton" 
		data-toggle="tooltip" title="Delete Task">
			<i class="ti-close"></i>
		</div>
	</div>
</div>