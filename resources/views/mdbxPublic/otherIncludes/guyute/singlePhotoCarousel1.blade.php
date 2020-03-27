<div class="row">
  <div class="col-lg-3 noPad" style="margin:auto;">
    @if (strpos($theme,'noguy') !== false)
    @else
      <div>  
        <img src="/images/remGuy.png">
      </div>
    @endif
    <div style="color:#fff;padding:25px;padding-bottom:0;
    font-helvetica;line-height:2;">
      PREMIUM EMAIL FLYERS Distributed to THOUSANDS of Interested Real Estate Agents!
    </div>
    <div style="background:#C19928;padding:15px;border-radius:.25em;color:#fff;
      font-size:150%;margin:25px;margin-bottom:0;text-align:center;
      display:inline-block;" class="hoverable z-depth-1">
        <i class="fa fa-envelope marginRight15"></i>FREE TRIAL
    </div>
  </div>
  <div class="col-lg-9">
    <div style="margin-top:50px;margin-bottom:15px;font-size:150%;color:#fff;"
    class="font-Lora">
      Featured
    </div>
    <div id="carouselControls" class="carousel slide" 
    data-ride="carousel">
      <div class="carousel-inner" style="border-radius:.75em;
      border-bottom-left-radius:0;border-bottom-right-radius:0;">
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
                <div style="position:absolute;top:0;background:rgba(0,0,0,.6);
                z-index:600;color:#fff;padding:10px;padding-left:20px;width:100%;">
                  {{$the->xFullStreet}}
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
</div>