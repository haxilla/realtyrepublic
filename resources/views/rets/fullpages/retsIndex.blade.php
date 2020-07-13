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
			RETS
		</h1>
		<div style="background:#efedff;padding:5px 10px;
		margin-bottom:15px;margin-top:15px;">
			<div class="inlineBlock" style="width:130px;">
				MLS name
			</div>
			<div class="inlineBlock">
				Last Synch
			</div>
		</div>
		<div>
			@foreach($retsList as $the)
				<div class="my5">
					<div class="inlineBlock inlineBlock small
					circle bg-secondary jqclick mr10 text-center"
					data-thisclick="retsSynch"
					data-retsid="{{$the->retsID}}">
						<i class="ti-reload"></i>
					</div>
					<div class="inlineBlock small
					circle bg-secondary jqclick mr10
					text-center"
					data-thisclick="retsEdit"
					data-retsid="{{$the->retsID}}"
					data-retssystem="{{$the->retsSystem}}"
					data-retsversion="{{$the->retsVersion}}"
					data-mlsname="{{$the->mlsName}}"
					data-retsURL="{{$the->retsURL}}"
					data-retsuname="{{$the->retsUname}}"
					data-retspswd="{{$the->retsPswd}}">
						<i class="ti-pencil-alt"></i>
					</div>
					<div class="inlineBlock w100">
						<a href="/rets/retsDisplay?retsID={{$the->retsID}}">
							{{$the->mlsName}}
						</a>
					</div>
					<div class="inlineBlock">
						@if($the->lastSynchDate!==null)
							{{$the->lastSynchDate->timezone('America/Phoenix')}}
						@else
							N/A
						@endif
					</div>
				</div>
			@endforeach
		</div>
		<hr>
		<div style="background:#efedff;
		border:2px solid #eee; color:#223e94;
		font-size:.70em"
		class="py5-px10 inlineBlock shadowBottomFaint
		jqclick retsButton"
		data-thisclick="addRets">
			ADD NEW
		</div>
		<div class="formErrorDiv">
		</div>
		<div class="jqhide addRetsDiv">
			<div class="bg-secondary p15">
				<form class="addRetsForm">
					{{csrf_field()}}
					<div class="formDiv">
						<input type="text" name="retsSystem"
						placeholder="System"
						class="roundedInputBar lighter5">
					</div>
					<div class="formDiv">
						<input type="text" name="retsVersion"
						placeholder="Version"
						class="roundedInputBar lighter5">
					</div>
					<div class="formDiv">
						<input type="text" name="mlsName"
						placeholder="MLS Name"
						class="roundedInputBar lighter5">
					</div>
					<div class="formDiv">
						<input type="text" name="retsURL"
						placeholder="Login URL"
						class="roundedInputBar lighter5">
					</div>
					<div class="formDiv">
						<input type="text" name="retsUname"
						placeholder="Username"
						class="roundedInputBar lighter5">
					</div>
					<div class="formDiv">
						<input type="text" name="retsPswd"
						placeholder="Password"
						class="roundedInputBar lighter5">
					</div>
					<div class="formSubmit p15 text-center">
						<div class="theButton inlineBlock
						rounder bg-white py5-px10 jqclick"
						style="border:2px solid #e8e8e8;"
						data-thisclick="retsSubmit"
						data-retsid="">
							Submit
						</div>
					</div>
				</form>
			</div>
			<hr class="my25">
			<div class="text-center my25">
				<div class="inlineBlock rounder
				px10 jqclick retsDeleteLink displayNone"
				style="background:#900;color:#fff;"
				data-thisclick="retsdelete"
				data-retsid="">
					<div class="smaller circle inlineBlock"
					style="font-size:.70em;">
						<i class="ti-close"></i>
					</div>
					<div class="inlineBlock"
					style="font-size:.70em;">
						Delete
					<div>
				</div>
			</div>
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
