<div class="inputDiv commentAdd{{$the->taskID}}">
	<form class="commentAddForm{{$the->taskID}}"
	id="{{$the->taskID}}">
		{{csrf_field()}}
		<textarea name="taskComment" 
		class="commentAddField"
		placeholder="Add Comment..."></textarea>
	</form>
</div>