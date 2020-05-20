<div class="inputDiv linkFields{{$the->taskID}}"
data-linkid="new">
	<div class="floatLeft pct-90w">
		<form class="linkForm{{$the->taskID}}">
			{{csrf_field()}}
			<input name="linkTitle" 
			placeholder="Link Title"
			class="linkField linkTitle linkTitle{{$the->taskID}}">
			<input name="linkURL" 
			class="linkField linkURL linkURL{{$the->taskID}}"
			placeholder="Link URL">
		</form>
	</div>
	<div class="floatRight pct-5w linkDeleteDiv 
	text-center">
		<div class="linkDelete linkDeleteButton" 
		data-toggle="tooltip" title="Delete Link">
			<i class="ti-close"></i>
		</div>
	</div>
	<div style="clear:both;">
	</div>
</div>

