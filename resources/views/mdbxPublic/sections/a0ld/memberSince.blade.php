<div style="text-align:center;">
	<h1>Helping THOUSANDS of Agents since 2006</h1>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-4">		
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
		<div class="col-lg-8">
			Other Side
		</div>
	</div>
</div>
