<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
    @include('admin.headersFooters.adminHeader')
    <!-- Custom CSS -->
	<link href="/my/css/rets/retsMain.css" rel="stylesheet">
	<meta name="csrf-token" content="{{csrf_token()}}">
</head>
<body class="retsIndex">
	<div class="dim">
    </div>
    @include('admin.overlays.mainFrame')

    <div class="wrapper">
		@include('admin.navigation.mainServer.adminNavTop')
	</div>

	<div class="px15" style="color:#223e94;">
		<span class="inlineBlock mr15">
			<h1>
				<i class="ti-plug"></i>
			</h1>
		</span>
		<h1 class="inlineBlock">
			<a href="/rets" style="text-decoration:none;
			color:#223e94;">
				RETS
			</a>
		</h1>
		<div style="background:#efedff;padding:5px 10px;
		margin-bottom:15px;margin-top:15px;">
			{{$retsList['mlsName']}}
			<hr>
				<a style="color:#223e94;text-decoration:none;"
				class="retsComparison jqclick"
				data-thisclick="retsCompare"
				data-retsid="{{$retsList['retsID']}}">
					COMPARISON
				</a>
			<hr>
		</div>
		<div style="border:1px solid #efedff;"
		class="p15">
			@foreach($retsLog as $the)
				<div>
					<div class="inlineBlock">
						Synch Date:
					</div>
					<div class="inlineBlock">
						{{$the->synchDate}}
					</div>
				</div>
				<div>
					<div class="inlineBlock90">
						New Agents
					</div>
					<div class="inlineBlock5">
						{{$the->newAgents}}
					</div>
				</div>
				<div>
					<div class="inlineBlock90">
						New Listings
					</div>
					<div class="inlineBlock5">
						{{$the->newListings}}
					</div>
				</div>
				<div>
					<div class="inlineBlock90">
						Back on Market
					</div>
					<div class="inlineBlock5">
						{{$the->backOnMarket}}
					</div>
				</div>
				<div>
					<div class="inlineBlock90">
						30 Days
					</div>
					<div class="inlineBlock5">
						{{$the->monthListings}}
					</div>
				</div>
				<div>
					<div class="inlineBlock90">
						60 Days
					</div>
					<div class="inlineBlock5">
						{{$the->twoMonthListings}}
					</div>
				</div>
				<div>
					<div class="inlineBlock90">
						90 Days
					</div>
					<div class="inlineBlock5">
						{{$the->threeMonthListings}}
					</div>
				</div>
			@endforeach
		</div>
	</div>

	<!-- modal -->
	@include('modals.areyousureModal')
	<!-- jquery custom -->
	@include('admin.scripts.adminScripts')
	<!-- rets specific -->
	<script src="/my/js/rets/retsMain.js"></script>
	<!-- synchstart -->
	<script src="/my/js/admin/synch/synchStart.js"></script>

</body>
</html>
