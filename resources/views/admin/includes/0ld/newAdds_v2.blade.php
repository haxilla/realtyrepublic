@foreach($newAdds as $the)
<div class="indexListing">
	<div class="row">
		<div class="col-12">
			<div style="padding-bottom:5px;">
				<b>{{$the->xFullStreet}}</b>
				- ${{number_format($the->xListPrice)}}
			</div>
		</div>
		<div class="col-4">
			<div style="text-align:left;">
				<img style="height:50px;max-width:100%;object-fit:cover;"
				src="/hqphotos/{{$the->theMeta->zipDir}}/{{$the->theMeta
				->mlsDir}}/{{$the->thePhotos->where('def','=','1')
				->first()->photoName}}"
				alt="{{$the->xFullStreet}} Main">
			</div>
		</div>
		<div class="col-8">
			<div style="line-height:1.5em;">
				<div>						
					{{$the->xCity}}, {{$the->xState}} {{$the->xxZip}}
				</div>
				<div>
					{{$the->xxBeds}} Bd | {{$the->xxBaths}} Ba |
					{{$the->xxSqft}} Sq | {{$the->xxYrBuilt}} Yr
				</div>
			</div>
		</div>
		<div class="col-4">
			<div class="row" style="margin-top:5px;">
				@if($the->theAgent->agtPhoto)
					<div class="col-6">
						<div style="height:50px;position:relative;">
							@if($the->theAgent->theAgentCleanup)
								<img style="max-height:50px;max-width:100%;object-fit:cover;
								position:absolute;bottom:0;"
								src='/agentPhotos/{{$the->theAgent->theAgentCleanup
								->newRemID}}/{{$the->theAgent->agtPhoto}}'>
							@else
								<img style="max-height:50px;max-width:100%;object-fit:cover;
								position:absolute;bottom:0;"
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
							style="max-height:50px;max-width:100%;object-fit:cover;
							position:absolute;bottom:0;left:0">
						</div>
					</div>
				@endif
			</div>
		</div>
		<div class="col-8">
			<div style="line-height:1.5em;height:100%;
			position:relative;">
				<div style="position:absolute;bottom:0;width:100%;">
					<div style="text-align:center;max-width:100%;
					overflow:hidden;text-overflow:ellipsis;white-space:nowrap">
						{{$the->theAgent->agtFullName}}
					</div>
					<div style="text-align:center;max-width:100%;
					overflow:hidden;text-overflow:ellipsis;white-space:nowrap">
						{{$the->theOffice->officeName}}
					</div>
				</div>
			</div>
		</div>
		<div class="col-12">
			<div class="comment-footer responsiveText" 
			style="margin-top:15px;margin-bottom:15px;">
				<span class="text-muted float-right">
					April 14, 2016
				</span>
				<span class="label label-rounded label-primary">
					Pending
				</span>
				<span class="action-icons">
					<a href="javascript:void(0)"
					data-id="{{$the->theMeta->sk1}}"
					data-action="edit" >
						<i class="ti-pencil-alt"></i>
					</a>
					<a href="javascript:void(0)"
					data-id="{{$the->theMeta->sk1}}"
					data-action="approve">
						<i class="ti-check"></i>
					</a>
					<a href="javascript:void(0)"
					data-id="{{$the->theMeta->sk1}}"
					data-action="fav">
						<i class="ti-heart"></i>
					</a>
					<a href="javascript:void(0)"
					data-id="{{$the->theMeta->sk1}}"
					data-action="reject">
						<i class="icon-close"></i>
					</a>
				</span>
			</div>
		</div>
	</div>
</div>
@endforeach