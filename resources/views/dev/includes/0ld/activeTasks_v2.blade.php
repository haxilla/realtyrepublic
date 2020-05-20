<div>
	@foreach($activeTasks as $the)
		<div class="taskBox">
			<div class="taskMenu">
				<div class="floatLeft">
					<div class="small circle lighter2 inlineBlock">
						<i class="ti-flag-alt"></i>
					</div>
					<div class="adminInfo inlineBlock">
						<img src="/images/admin/profilePhotos/{{$the->adminInfo['adminPhoto']}}">
					</div>
					<div class="taskBadge taskBadge{{$the->taskType}} inlineBlock">
						{{$the->taskType}}
					</div>
					<div class="taskBadge taskDate inlineBlock">
						{{$the->created_at->toDateString()}}
					</div>
				</div>
				<div class="small circle lighter2 inlineBlock floatRight">
					<i class="ti-close"></i>
				</div>
				<div style="clear:both;">
				</div>
			</div>
			<div class="taskDesc">
				{{$the->taskDesc}}
			</div>
			@if($the->taskComments)
				@foreach($the->taskComments as $t)
					<div class="taskComment">
						<div class="taskCommentCheck inlineBlock">
							<i class="ti-check-box"></i>
						</div>
						<div class="taskCommentText inlineBlock">
							<span style="opacity:.7">
								{{$t->created_at->toDateString()}} </span>{{$t['taskComment']}}
						</div>
					</div>
				@endforeach
			@endif
			<div class="taskOptions inlineBlock text-center lighter rounder">
				<div class="small circle lighter2 inlineBlock">
					<i class="ti-check-box"></i>
				</div>
				<div class="small circle lighter2 inlineBlock">
					<i class="ti-comment"></i>
				</div>
				<div class="small circle lighter2 inlineBlock">
					<i class="ti-menu"></i>
				</div>
			</div>
		</div>
	@endforeach
</div>