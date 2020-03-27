<div style="text-align:center">

</div>
<div class="container-fluid noPad">
	<div class="row"style="position:relative;">	
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
		<div style="position:absolute;background:rgba(0,0,0,.6);padding:50px;
		text-align:center;top:0;width:100%;height:100%;">
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
	</div>

</div>
