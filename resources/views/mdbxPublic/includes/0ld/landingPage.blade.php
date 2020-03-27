<div class="">
<div id="carouselControls" class="carousel slide" 
data-ride="carousel">
  <div class="carousel-inner">
    @foreach($newAdds as $the)
      <div class="carousel-item 
        @if($loop->iteration===1)
          active
        @endif">
        <div>
          <div class="image425hContainer view">
            <img class="d-block w-100 image425h"
            src="/hqphotos/{{$the->theMeta->zipDir}}/{{$the->theMeta
              ->mlsDir}}/{{$the->thePhotos->where('def','=','1')
              ->first()->photoName}}"
              alt="{{$the->xFullStreet}} Main">
			<div class="mask flex-center waves-effect waves-light rgba-black-strong">
				<p class="white-text">strong overlay</p>
			</div>
          </div>
        </div>
      </div>
    @endforeach
    <!-- END LOOP 1 -->
  </div>
  <a class="carousel-control-prev" href="#carouselControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>