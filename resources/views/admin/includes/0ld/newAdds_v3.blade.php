@foreach($newAdds as $the)
<div class="indexListing" style="padding:2px 1px;">
	<div style="position:relative;">
		<img src="/hqphotos/{{$the->theMeta->zipDir}}/{{$the->theMeta
		->mlsDir}}/{{$the->thePhotos->where('def','=','1')
		->first()->photoName}}" alt="{{$the->xFullStreet}} Main">
		<div style="position:absolute;top:0;color:#fff;z-index:4;padding:2px;width:100%;
		text-align:center">
			<div style="display:inline-block;padding:2px 5px;border-radius:.5em;
			background:rgba(0,0,0,.3);" class="responsiveText">
				{{$the->xFullStreet}}
			</div>
		</div>
	</div>
	<div class="row">
		@if($the->theAgent->agtPhoto)
			<div class="col-6">
				<div style="height:50px;position:relative;">
					@if($the->theAgent->theAgentCleanup)
						<img style="max-height:50px;max-width:100%;object-fit:scale-down;
						position:absolute;bottom:0;left:0;"
						src='/agentPhotos/{{$the->theAgent->theAgentCleanup
						->newRemID}}/{{$the->theAgent->agtPhoto}}'>
					@else
						<img style="max-height:50px;max-width:100%;object-fit:scale-down;
						position:absolute;bottom:0;left:0"
						src='http://www.realtyemails.com/HQoffice/{{$the
						->theOffice->officeID}}/{{$the
						->theAgent->agtPhoto}}'>
					@endif
				</div>
			</div>
		@else
			<div class="col-6">
				<div style="height:50px;width:100%;
				background:#eee;">
					OK
				</div>
			</div>
		@endif
		@if($the->theAgent->agtLogo)
			<div class="col-6">
				<div style="position:relative;height:100%;">
					<img src="/officeLogos/{{$the->theOffice
					->officeID}}/{{$the->theAgent->agtLogo}}"
					style="max-height:50px;max-width:100%;object-fit:scale-down;
					position:absolute;bottom:0;left:0">
				</div>
			</div>
		@endif
	</div>
</div>
@endforeach