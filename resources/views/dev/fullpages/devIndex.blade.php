<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
    @include('admin.headersFooters.adminHeader')
    <!-- Custom CSS -->
	<link href="/my/css/dev/devJournal.css" rel="stylesheet">
	<link href="/my/css/shared/common.css" rel="stylesheet">
</head>
<body class="devIndex">
	<div style="background:rgba(239, 237, 255, .5)">
		<div>
			@include('admin.navigation.adminNavTop')
		</div>
		<div class="devTask container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="mx20 text-white">
						<div class="taskPanel">
							@include('dev.navigation.devtaskMenu')
							@include('dev.includes.filterBadges')
							<!-- circle menu -->
							<div class="small circle taskback
							bg-white outline1-blue text-center mb10 ml10"
							style="color:#223e94;">
								<i class="ti-arrow-left"></i>
							</div>
							@if($taskquery->count()>0)
								@foreach($taskquery as $the)
									@include('dev.includes.taskTemplate')
								@endforeach
							@else
								@include('dev.includes.noResults')
							@endif
						</div>
						<div class="taskPaginate" style="text-align:center;">
							@if($taskquery->hasPages())
								<div style="position:absolute;bottom:20px;left:30px;">
									<div class="scrollTop small circle darker5"
									style="text-align:center;">
										<i class="ti-arrow-up"></i>
									</div>
								</div>
								<div class="reloadPage darker5
								small circle inlineBlock mr15"
								data-tooltip="Reload" data-taskstatus="{{$taskstatus}}">
									<i class="ti-reload"></i>
								</div>
								<div class="inlineBlock">
									{{$taskquery->appends([
									'filter' 	 => $filter,
									'taskstatus' => $taskstatus,
									])->links()}}
								</div>
							@endif
						</div>
					</div>
				</div>
			</div>
			@include('admin.scripts.adminScripts')
			<script src="/my/js/dev/devtasks.js"></script>
			<script src="/my/js/dev/devaccordion.js"></script>
			<script src="/my/js/dev/autosuggestDev.js"></script>

		</div>
	</div>
</body>
</html>
