@if($the->taskComments)
	@foreach($the->taskComments
	->where('commentFlag','=','1') as $t)
		<div class='taskComment taskCommentNew roundedResponsive' 
		id='taskComment{{$t->commentID}}'
		data-taskid='{{$the->taskID}}' 
		data-commentid='{{$t->commentID}}'
		data-theclass='comment'>
			<div class="commentShow commentShow{{$t->commentID}}">
				<div class="taskCommentCheck inlineBlock">
					<label class="checkContainer">
					  <input type="checkbox" checked="checked" 
					  name="taskCheck">
					  <span class="checkmark"></span>
					</label>
				</div>
				<div class="taskCommentText inlineBlock">
					<span style="opacity:.7">
						{{$t->created_at->toDateString()}} 
					</span><span class="taskCommentSpan">
						{{$t['taskComment']}}
					</span>
				</div>
			</div>
			<div class="commentEdit commentEdit{{$t->commentID}}">
				<div class="commentEditDiv">
					<form class="commentEditForm{{$t->commentID}}"
					id="{{$t->commentID}}">
						{{csrf_field()}}
						<textarea name="taskComment" 
						class="commentEditField 
						noScroll noResize">{{$t->taskComment}}</textarea>
					</form>
				</div>
				<div class="commentDeleteDiv">
					<div class="commentDeleteButton" 
					data-toggle="tooltip" title="Delete Comment">
						<i class="ti-close"></i>
					</div>
				</div>
			</div>
		</div>
	@endforeach
	<!-- -->
	@foreach($the->taskComments
	->where('commentFlag','!=','1') as $t)
		<div class='taskComment roundedResponsive' 
		id='taskComment{{$t->commentID}}'
		data-taskid='{{$the->taskID}}'
		data-commentid='{{$t->commentID}}'>
			<div class='commentShow commentShow{{$t->commentID}}'>
				<div class='taskCommentCheck inlineBlock'>
					<label class='checkContainer'>
					  <input type='checkbox' 
					  name='taskCheck'>
					  <span class='checkmark'></span>
					</label>
				</div>
				<div class='taskCommentText inlineBlock'>
					<span style='opacity:.7'>
						{{$t->created_at->toDateString()}} 
					</span><span class='taskCommentSpan'>
						{{$t['taskComment']}}
					</span>
				</div>
			</div>
			<div class='commentEdit commentEdit{{$t->commentID}}'>
				<div class='commentEditDiv'>
					<form class='commentEditForm{{$t->commentID}}'
					id='{{$t->commentID}}'>
						{{csrf_field()}}
						<textarea name='taskComment' 
						class='commentEditField 
						noScroll noResize'>{{$t->taskComment}}</textarea>
					</form>
				</div>
				<div class='commentDeleteDiv'>
					<div class='commentDeleteButton' 
					data-toggle='tooltip' title='Delete Comment'>
						<i class='ti-close'></i>
					</div>
				</div>
			</div>
		</div>
	@endforeach
@endif