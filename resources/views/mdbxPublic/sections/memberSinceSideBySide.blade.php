<div class="memberSince backgroundPrimary"
style="border-top:5px solid #fff; ">
	<div class="row noMargin">
		<div class="col-sm-4">
			<div class="agentWallAltHero">
				<div class="row">
					<div class="col-4">
						<div style="padding-top:25px;padding-left:15px;">
							<div style="background:rgba(255,255,255,.1);
							border-radius:50%;width:80px;height:80px;
							color:#fff;padding-top:10px;">
								<span class="ti-cup">
								</span>
								<div style="font-size:75%;">
									<div>
										Since
									</div>
									<div>
										2006
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-8">
							<div style="padding:25px 0;">
								<h1 style="color:#fff;font-size:1.5em;">
									<div>
										Serving
									</div>
									<div style="color:#efedff;"
									class="font-Lora">
										THOUSANDS of
									</div>
									<div>
										Real Estate Agents
									</div>
								</h1>
							</div>
					</div>
				</div>
			</div>
			<div class="row agentWallTop">
				@foreach($memberSince->take(18) as $the)
					<div class="col-2 col-sm-4 noPad">
						<div class="agentWallTile">
							@if($the->theAgentCleanup)
								<a id="agentWallPhoto" class="{{$the->theAgentCleanup->newRemID}}"
								data-toggle="popover"
								title="{{$the->agtFullName}} Member Since {{$the->startDate->format('Y')}}"
								data-ajid="{{$the->theAgentCleanup->newRemID}}">
									<img src="{{env('APP_IMGURL')}}/agentPhotos/{{$the->theAgentCleanup
									->newRemID}}/{{$the->agtPhoto}}">
								</a>
							@else
								<a id="agentWallPhoto" data-toggle="popover"
								title="{{$the->agtFullName}} Member Since {{$the->startDate->format('Y')}}"
								data-ajid="{{$the->propagent_id}}" class="{{$the->propagent_id}}">
									<img src="{{env('APP_IMGURL')}}/HQoffice/{{$the->theAgtOffice
										->officeID}}/{{$the->agtPhoto}}">
								</a>
							@endif
						</div>
					</div>
				@endforeach
			</div>
			<div class="row agentWallBot">
				@foreach($memberSince->skip(18) as $the)
					<div class="col-2 col-sm-4 noPad">
						<div class="agentWallTile">
							@if($the->theAgentCleanup)
								<a id="agentWallPhoto" class="{{$the->theAgentCleanup->newRemID}}"
								data-toggle="popover"
								title="{{$the->agtFullName}} Member Since {{$the->startDate->format('Y')}}"
								data-ajid="{{$the->theAgentCleanup->newRemID}}">
									<img src="{{env('APP_IMGURL')}}/agentPhotos/{{$the->theAgentCleanup
									->newRemID}}/{{$the->agtPhoto}}">
								</a>
							@else
								<a id="agentWallPhoto" data-toggle="popover"
								title="{{$the->agtFullName}} Member Since {{$the->startDate->format('Y')}}"
								data-ajid="{{$the->propagent_id}}" class="{{$the->propagent_id}}">
									<img src="{{env('APP_IMGURL')}}/HQoffice/{{$the->theAgtOffice
										->officeID}}/{{$the->agtPhoto}}">
								</a>
							@endif
						</div>
					</div>
				@endforeach
			</div>
		</div>
		<div class="col-sm-8">
			<div class="row noMargin agentWallHero textWhite">
				<div class="col-12">
					<div class="headWrapper">
						<span class="preHead font-Lora">
							Serving
						</span>
						<span class="mainHead" style="font-weight:bold;color:#efedff;">
							<div>
								THOUSANDS OF
							</div>
							<div>
								REAL ESTATE AGENTS
							</div>
						</span>
					</div>
					<div class="ticonFrame">
						<span class="ticon ti-cup">
						</span>
						<span class="font-Lora">Since 2006</span>
					</div>
					<div class="heroText">
						<p>
							RealtyEmails is a network of proactive real estate agents
							who go beyond the average agent to network with
							one another and market their listings.
						</p>
					</div>
				</div>
			</div>
			<div class="row agentWallStats">
				<div class="col-6">
					<div class="statDesc">
						Members To Date
					</div>
					<h1>
						6,892
					</h1>
				</div>
				<div class="col-6">
					<div class="statDesc">
						Flyers Sent
					</div>
					<h1>
						683,321
					</h1>
				</div>
			</div>
			<div class="row">
				<div class="col" style="text-align:center;
				margin-bottom:25px;">
					<div class="orangeGradientRoundest">
						<button id="joinNowFree">
							Join NOW for FREE!
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
