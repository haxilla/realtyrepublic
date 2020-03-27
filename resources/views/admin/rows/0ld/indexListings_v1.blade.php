
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-6">
			<div style="background:#fff;">
				<h3 style="padding:1em;padding-bottom:.5em;">
					<u>Newly Added</u>
				</h3>
				<div class="scrollable" style="height:325px;"> 
					@foreach($newAdds as $the)
						<div class="indexListing" style="position:relative;">
							<div class="row" style="margin:0 10px;">
								<div class="col-12">
									<div style="padding:10px 0;">
										<b>{{$the->xFullStreet}}</b>
										- ${{number_format($the->xListPrice)}}
									</div>
								</div>
								<div class="col-lg-3">
									<div style="text-align:left;">
										<img style="height:75px;width:75px;object-fit:cover;"
										src="/hqphotos/{{$the->theMeta->zipDir}}/{{$the->theMeta
										->mlsDir}}/{{$the->thePhotos->where('def','=','1')
										->first()->photoName}}"
										alt="{{$the->xFullStreet}} Main">
									</div>
								</div>
								<div class="col-lg-7">
									<div>						
										{{$the->xCity}}, {{$the->xState}} {{$the->xxZip}}
									</div>
									<div>
										{{$the->xxBeds}} Bd | {{$the->xxBaths}} Ba |
										{{$the->xxSqft}} Sq | {{$the->xxYrBuilt}} Yr
									</div>
								</div>
								<div class="col-lg-2">
									<div style="text-align:right;">
										@if($the->theAgent->agtPhoto)
											@if($the->theAgent->theAgentCleanup)
												<img style="height:50px;width:50px;object-fit:cover;
												position:absolute;bottom:0;right:10px;"
												src='/agentPhotos/{{$the->theAgent->theAgentCleanup
												->newRemID}}/{{$the->theAgent->agtPhoto}}'>
											@else
												<img style="height:50px;width:50px;object-fit:cover;
												position:absolute;bottom:0;right:10px;"
												src='http://www.realtyemails.com/HQoffice/{{$the
												->theOffice->officeID}}/{{$the
												->theAgent->agtPhoto}}'>
											@endif
										@endif
										@if($the->theAgent->agtLogo)
											<img src="/officeLogos/{{$the->theOffice
											->officeID}}/{{$the->theAgent->agtLogo}}"
											style="position:absolute;right:50px;bottom:0;
											width:35px;object-fit:cover;">
										@endif
									</div>
								</div>
								<div class="col-12">
									<div class="comment-footer" style="padding:10px 0;
									border-bottom:1px solid rgba(0,0,0,.1);">
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
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div style="background:#fff;">
				<h3 style="padding:1em;padding-bottom:.5em;">
					<u>Most Views</u>
				</h3>
				<div class="scrollable" style="height:325px;"> 
					@foreach($mostViews as $the)
						<div class="indexListing" style="position:relative;">
							<div class="row" style="margin:0 10px;">
								<div class="col-12">
									<div style="padding:10px 0;">
										<b>{{$the->xFullStreet}}</b>
										- ${{number_format($the->xListPrice)}}
									</div>
								</div>
								<div class="col-lg-3">
									<div style="text-align:left;">
										<img style="height:75px;width:75px;object-fit:cover;"
										src="/hqphotos/{{$the->theMeta->zipDir}}/{{$the->theMeta
										->mlsDir}}/{{$the->thePhotos->where('def','=','1')
										->first()->photoName}}"
										alt="{{$the->xFullStreet}} Main">
									</div>
								</div>
								<div class="col-lg-7">
									<div>						
										{{$the->xCity}}, {{$the->xState}} {{$the->xxZip}}
									</div>
									<div>
										{{$the->xxBeds}} Bd | {{$the->xxBaths}} Ba |
										{{$the->xxSqft}} Sq | {{$the->xxYrBuilt}} Yr
									</div>
								</div>
								<div class="col-lg-2">
									<div style="text-align:right;">
										@if($the->theAgent->agtPhoto)
											@if($the->theAgent->theAgentCleanup)
												<img style="height:50px;width:50px;object-fit:cover;
												position:absolute;bottom:0;right:10px;"
												src='/agentPhotos/{{$the->theAgent->theAgentCleanup
												->newRemID}}/{{$the->theAgent->agtPhoto}}'>
											@else
												<img style="height:50px;width:50px;object-fit:cover;
												position:absolute;bottom:0;right:10px;"
												src='http://www.realtyemails.com/HQoffice/{{$the
												->theOffice->officeID}}/{{$the
												->theAgent->agtPhoto}}'>
											@endif
										@endif
										@if($the->theAgent->agtLogo)
											<img src="/officeLogos/{{$the->theOffice
											->officeID}}/{{$the->theAgent->agtLogo}}"
											style="position:absolute;right:50px;bottom:0;
											width:35px;object-fit:cover;">
										@endif
									</div>
								</div>
								<div class="col-12">
									<div class="comment-footer" 
									style="padding:10px 0;
									border-bottom:1px solid rgba(0,0,0,.1);">
										<span class="text-muted float-right">April 14, 2016</span>
										<span class="label label-rounded label-primary">Pending</span>
										<span class="action-icons">
											<a href="javascript:void(0)">
												<i class="ti-pencil-alt"></i>
											</a>
											<a href="javascript:void(0)">
												<i class="ti-check"></i>
											</a>
											<a href="javascript:void(0)">
												<i class="ti-heart"></i>
											</a>
										</span>
									</div>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>

