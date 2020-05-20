<div>
	<div class="devTask fixedMenu">
		<div class="floatLeft">
			<div class="taskstatus inlineBlock rounder lighter2"
			style="padding:0 10px;margin-top:3px;width:140px;"
			data-menuclick="taskstatus">
				<span class="mr15">
					Active Tasks
				</span>
				<span class="angleDown"><i class='ti-angle-down'></i></span>
			</div>
			<div class="taskstatus dropMenuBox"
			style="width:140px;">
				<div>Completed</div>
				<div>Snoozed</div>
				<div>Deleted</div>
				<div>Tips</div>
				<div>Excuses</div>
			</div>
		</div>
		<div class="floatRight" style="margin-top:3px;">
			<div class="taskfilter inlineBlock small circle lighter2 mr15"
			data-menuclick="taskfilter">
				<i class="ti-filter"></i>
			</div
			><div class="taskfilter dropMenuBox">
				<div>New</div>
				<div>Bug</div>
				<div>Feature</div>
				<div>Flagged</div>
			</div
			><div class="tasksearch inlineBlock small circle lighter2"
			data-menuclick='tasksearch'>
				<i class="ti-search"></i>
			</div>
			<div class="tasksearch dropMenuBox" style="width:100%;position:top:0;left:0;">
				<input type="text" name="qtasks" style="width:100%;padding:0 5px;
				background:none;color:#fff;border:none;outline:none;"
				placeholder="Search Tasks ...">
			</div>
		</div>
		<div style="clear:both;">
		</div>
	</div>
	<div style="padding-top:40px;">
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
				<div class="taskShow taskShow{{$the->taskID}} taskDesc">
					{{$the->taskDesc}}
				</div>
				<div class="taskEdit taskEdit{{$the->taskID}} taskEditDiv taskDesc">
					<form class="taskEditForm{{$the->taskID}}"
					id="{{$the->taskID}}">
						{{csrf_field()}}
						<textarea name="taskDesc" 
						class="taskEditField 
						noScroll noResize">{{$the->taskDesc}}</textarea>
					</form>
				</div>
				<div class="ajaxNewComment ajaxNewComment{{$the->taskID}}">
				</div>
				@if($the->taskComments)
					@foreach($the->taskComments
					->where('commentFlag','=','1') as $t)
						<div class='taskComment taskCommentNew roundedResponsive' 
						id='taskComment{{$t->commentID}}'
						data-taskid='{{$the->taskID}}' 
						data-commentid='{{$t->commentID}}'>
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
</div>