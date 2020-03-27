<div style="text-align:center;">
	
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-5" style="text-align:center;">
				<div class="row">
				@foreach($memberSince as $the)
					<div class="col-lg-2 noPad">
						<div>
							@if($the->theAgentCleanup)
								<img src="/agentPhotos/{{$the->theAgentCleanup
								->newRemID}}/{{$the->agtPhoto}}"
								style="height:100px;width:100%;object-fit:cover;">
							@else
								<img
								src="http://www.realtyemails.com/HQoffice/{{$the->theAgtOffice
								->officeID}}/{{$the->agtPhoto}}"
								style="height:100px;width:100%;object-fit:cover;">
							@endif
						</div>
					</div>			
				@endforeach
			</div>
		</div>
		<div class="col-lg-7">
			<div style="padding:50px 125px;">
				<p>
					SINCE 2006
				</p>	
				<h1>Serving THOUSANDS of Real Estate Agents</h1>
				<p>
					We've been around a long time helping alot of agents!
					Over time we've found that agents who use RealtyEmails are extraordinary
					individuals that arent happy just sitting around waiting for someone else to sell their listing.  They are proactive, innovative and always 
					looking for new ways to network with others in the industry and stay on top of their game.
				</p>
				<p style="padding:25px;font-size:125%;">
					Sound like YOU?
				</p>
				@include('mdbxPublic.includes.elements.lightGradientCreate')
			</div>
		</div>
	</div>
</div>
