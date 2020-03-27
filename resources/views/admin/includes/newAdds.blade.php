@foreach($newAdds as $the)
<div class="indexListing">
	<div class="defaultPhotoDiv">
		<img src="{{env('APP_IMGURL')}}/hqphotos/{{$the->theMeta->zipDir}}/{{$the->theMeta
		->mlsDir}}/{{$the->thePhotos->where('def','=','1')
		->first()->photoName}}" alt="{{$the->xFullStreet}} Main">
	</div>
</div>
@endforeach