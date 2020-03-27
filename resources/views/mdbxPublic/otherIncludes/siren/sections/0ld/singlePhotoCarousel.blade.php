<div class="row">
  <div style="background:rgba(0,0,0,.5);padding-top:15px;padding-bottom:15px;">
    <div id="carouselControls" class="carousel slide" 
    data-ride="carousel">
      <div class="carousel-inner">
        @foreach($newAdds as $the)
          <div class="carousel-item 
            @if($loop->iteration===1)
              active
            @endif">
            <div class="image475hContainer">
              <img class="d-block w-100 image475h" 
              src="/hqphotos/{{$the->theMeta->zipDir}}/{{$the->theMeta
                ->mlsDir}}/{{$the->thePhotos->where('def','=','1')
                ->first()->photoName}}"
                alt="{{$the->xFullStreet}} Main">
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
</div>