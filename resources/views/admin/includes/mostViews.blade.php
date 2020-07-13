
@foreach($mostViews as $the)
	<!-- surround with code below to remove flyers with broken image -->
		<div class="indexListing">
			<div class="defaultPhotoDiv">
					<img src="{{env('APP_IMGURL')}}/hqphotos/{{$the->theMeta->zipDir}}/{{$the->theMeta
					->mlsDir}}/{{$the->thePhotos->where('def','=','1')->first()->photoName}}"
					alt="{{$the->xFullStreet}} Main">
			</div>
		</div>
	<!-- end of surround -->
@endforeach

<!-- to remove entirely add this
@ if($the->thePhotos->first()->notFound != 1)
@ endif
-->
