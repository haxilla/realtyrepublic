<div id="landingFlyersAbsolute" 
class="carousel slide" 
data-ride="carousel" style="position:relative;z-index:0;
padding-top:30px;">
  <div class="carousel-inner">
    @foreach($newAdds as $the)
      <div class="carousel-item 
        @if($loop->iteration===1)
          active
        @endif">
        <div class="image600hContainer" style="position:relative;">
          <div style="height:100%;width:100%;position:absolute;
          background:rgba(0,0,0,.5);z-index:1;">
          </div>
          <img class="d-block w-100 image600h"
          src="/hqphotos/{{$the->theMeta->zipDir}}/{{$the->theMeta
            ->mlsDir}}/{{$the->thePhotos->where('def','=','1')
            ->first()->photoName}}"
            alt="{{$the->xFullStreet}} Main">
        </div>
      </div>
    @endforeach
    <!-- END LOOP 1 -->
  </div>
</div>