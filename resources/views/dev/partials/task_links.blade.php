@if($the->tasklinks)
	@foreach($the->tasklinks as $t)
		<div class='tasklink roundedResponsive' 
		id='tasklink{{$t->linkID}}'
		data-taskid='{{$the->taskID}}' 
		data-linkid='{{$t->linkID}}'
		data-theclass='link'>
			<div class="linkShow linkShow{{$t->linkID}}">
				<div class="tasklinkText">
					<span style="opacity:.7">
						{{$t->created_at->toDateString()}} 
					</span><span class="tasklinkSpan">
						{{$t['tasklinkDesc']}}
					</span>
				</div>
			</div>
			<div class="linkEdit linkEdit{{$t->linkID}}">
				<div class="linkEditDiv">
					<form class="linkEditForm{{$t->linkID}}"
					id="{{$t->linkID}}">
						{{csrf_field()}}
						<textarea name="tasklink" 
						class="linkEditField 
						noScroll noResize">{{$t->tasklinkDesc}}</textarea>
					</form>
				</div>
				<div class="linkDeleteDiv">
					<div class="linkDeleteButton" 
					data-toggle="tooltip" title="Delete link">
						<i class="ti-close"></i>
					</div>
				</div>
			</div>
		</div>
	@endforeach
@endif