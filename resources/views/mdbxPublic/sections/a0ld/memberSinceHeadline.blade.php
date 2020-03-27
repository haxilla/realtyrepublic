<div style="text-align:center">
	<h1 style="margin:0;padding:0;padding-top:0;padding-bottom:50px;">
		<span class="font-Lora">
		Helping 
		</span>
		THOUSANDS of AGENTS
		<span class="font-Lora">
			since 2006
		</span>
	</h1>
</div>
<div class="container-fluid">
	<div class="row">	
		@foreach($memberSince as $the)
			<div class="col-lg-1 noPad">
				@if($the->theAgentCleanup)
					<img src="/agentPhotos/{{$the->theAgentCleanup
					->newRemID}}/{{$the->agtPhoto}}"
					style="height:125px;width:100%;object-fit:cover;">
				@else
					<img
					src="http://www.realtyemails.com/HQoffice/{{$the->theAgtOffice
					->officeID}}/{{$the->agtPhoto}}"
					style="height:125px;width:100%;object-fit:cover;">
				@endif
			</div>	
		@endforeach
	</div>
</div>
