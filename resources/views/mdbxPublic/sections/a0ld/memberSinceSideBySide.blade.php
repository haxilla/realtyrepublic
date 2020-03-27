<div style="text-align:center;">

</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-4" style="text-align:center;">
				<div class="row">
				@foreach($memberSince as $the)
					<div class="col-lg-2 noPad">
						<div class="agentWall">
							@if($the->theAgentCleanup)
								<a id="agentWallPhoto" class="{{$the->theAgentCleanup->newRemID}}" data-toggle="popover"
								title="{{$the->agtFullName}} Member Since {{$the->startDate->format('Y')}}"
								data-ajid="{{$the->theAgentCleanup->newRemID}}">
									<img src="{{env('APP_IMGURL')}}/agentPhotos/{{$the->theAgentCleanup
									->newRemID}}/{{$the->agtPhoto}}"
									style="height:115px;width:100%;object-fit:cover;">
								</a>
							@else
								<a id="agentWallPhoto" data-toggle="popover"
								title="{{$the->agtFullName}} Member Since {{$the->startDate->format('Y')}}"
								data-ajid="{{$the->propagent_id}}" class="{{$the->propagent_id}}">
									<img src="{{env('APP_IMGURL')}}/HQoffice/{{$the->theAgtOffice->officeID}}/{{$the->agtPhoto}}" 
									style="height:115px;width:100%;object-fit:cover;">
								</a>
							@endif
						</div>
					</div>
				@endforeach
			</div>
		</div>
		<div class="col-lg-8">
			<div style="padding:50px 125px;text-align:left;">
				<h1 style="line-height:1.25em">
					<div>
						<span class="font-Lora">
							Serving
						</span>
					</div>
					<span style="font-weight:bold;color:#efedff;">
						<div>
							THOUSANDS OF
						</div>
						<div>
							REAL ESTATE AGENTS
						</div>
					</span>
				</h1>
				<h3 style="border-bottom:1px solid #fff;padding-bottom:25px;">
					<span class="ti-cup" style="margin-right:15px;"></span>
					<span class="font-Lora">Since 2006</span>
				</h3>
				<div style="text-align:left;">
					<p style="padding:25px 0;">
						RealtyEmails is a network of proactive real estate agents who go beyond the average agent to network with one another and market their listings.
					</p>
				</div>
				<div class="row" style="background:#efedff;color:#223e94;
				text-align:center;margin:0;padding:0;padding:25px;
				border-radius:2em;">
					<div class="col-lg-6">
						<h1>
							6,892
						</h1>
						<div>
							Members Strong
						</div>
					</div>
					<div class="col-lg-6">
						<h1>
							683,321
						</h1>
						<div>
							Flyers Sent
						</div>
					</div>
				</div>
				<div class="row" style="text-align:center;
				margin:0;padding:0;">
					<button
					style="border:3px solid #fff;
					background:#900;padding:15px 20px;color:#fff;
					margin:0 auto;margin-top:50px;border-radius:2em;
					font-weight:bold;"
					data-toggle="modal" data-target="#joinNowModal"
					id="joinNowModalIndex">
						Join NOW for FREE!
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
