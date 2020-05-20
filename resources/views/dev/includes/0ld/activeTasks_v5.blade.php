<div>
	@foreach($activeTasks as $the)
		<div class="taskBox" data-taskid="{{$the->taskID}}">
			<div class="taskMenu">
				<div class="floatLeft">
					<div class="taskFlag small circle lighter2 inlineBlock"
					data-toggle="tooltip" title="Flag Task">
						<i class="ti-flag-alt"></i>
					</div>
					<div class="taskBadge taskDate inlineBlock">
						{{$the->created_at->toDateString()}}
					</div>
				</div>
				<div class="taskDeleteDiv inlineBlock floatRight">
					<div class="small circle lighter2 
					taskDelete" data-toggle="tooltip" title="Delete Task">
						<i class="ti-close"></i>
					</div>
				</div>
				<div style="clear:both;">
				</div>
			</div>
			<div class="taskDesc">
				{{$the->taskDesc}}
			</div>
			<div class="ajaxNewComment ajaxNewComment{{$the->taskID}}">
			</div>
			@if($the->taskComments)
				@foreach($the->taskComments
				->where('commentFlag','=','1') as $t)
					<div class="taskComment taskCommentNew roundedResponsive" 
					id="taskComment{{$t->commentID}}"
					data-taskid="{{$the->taskID}}" 
					data-commentid="{{$t->commentID}}">
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
				<hr>
				@foreach($the->taskComments
				->where('commentFlag','!=','1') as $t)
					<div class="taskComment" id="taskComment{{$t->commentID}}"
					data-taskid="{{$the->taskID}}"
					data-commentid="{{$t->commentID}}">
						<div class="taskCommentCheck inlineBlock">
							<label class="checkContainer">
							  <input type="checkbox" name="taskCheck">
							  <span class="checkmark"></span>
							</label>
						</div>
						<div class="taskCommentText inlineBlock">
							<span style="opacity:.7">
								{{$t->created_at->toDateString()}} 
							</span>{{$t['taskComment']}}
						</div>
					</div>
				@endforeach
			@endif
			<div class="ajaxComment ajaxComment{{$the->taskID}}">
			</div>
			<div class="inputDiv commentAdd{{$the->taskID}}">
				<form class="commentAddForm{{$the->taskID}}"
				id="{{$the->taskID}}">
					{{csrf_field()}}
					<textarea name="taskComment" 
					class="commentAddField"></textarea>
				</form>
			</div>
			<div style="margin-top:15px;">
				<div class="inlineBlock" style="vertical-align:middle;">
					<div class="adminInfo inlineBlock">
						<img src="/images/admin/profilePhotos/{{$the->adminInfo['adminPhoto']}}">
					</div>
					<div class="taskBadge taskBadge{{$the->taskType}} inlineBlock">
						{{$the->taskType}}
					</div>
				</div>
				<div class="taskOptions inlineBlock text-center">
					<div class="small circle lighter2 inlineBlock"
					data-toggle="tooltip" title="Mark Done" 
					data-taskclick="markdone">
						<i class="ti-check-box"></i>
					</div>
					<div class="small circle lighter2 inlineBlock"
					data-toggle="tooltip" title="Add Comment" 
					data-taskclick="addcomment">
						<i class="ti-comment"></i>
					</div>
					<div class="small circle lighter2 inlineBlock"
					data-toggle="tooltip" title="Task Metas" 
					data-taskclick="metas">
						<i class="ti-menu"></i>
					</div>
					<div class="small circle lighter2 inlineBlock"
					data-toggle="tooltip" title="Snooze" 
					data-taskclick="snooze">
						<i class="ti-timer"></i>
					</div>
				</div>
			</div>
		</div>
	@endforeach
</div>