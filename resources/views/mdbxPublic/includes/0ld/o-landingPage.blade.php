<section style="background:#ebebeb;margin-top:50px;">
<div class="container">
<div id="landingCarousel" 
class="carousel slide" 
data-ride="carousel">
  <div class="carousel-inner">
    @foreach($newAdds as $the)
      <div class="carousel-item 
        @if($loop->iteration===1)
          active
        @endif">
        <div class="image425hContainer">
          <img class="d-block w-100 image425h"
          src="/hqphotos/{{$the->theMeta->zipDir}}/{{$the->theMeta
            ->mlsDir}}/{{$the->thePhotos->where('def','=','1')
            ->first()->photoName}}"
            alt="{{$the->xFullStreet}} Main">
        </div>
      </div>
    @endforeach
  </div>
</div>
</div>
</section>
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-4 noPad" style="text-align:right;
    padding-top:75px;">
      <h4 style="font-weight:bold;">
        <i class="fa fa-bolt mr-1"></i>Automatic Import
      </h4>
      <div class="row">
        <div class="col-lg-6">
        </div>
        <div class="col-lg-6">
          <p>
            If its online already, just enter the address or MLS#
          </p>
        </div>
      </div>
    </div>
    <div class="col-lg-4 rellax noPad" data-rellax-speed="-5" 
    style="margin-top:-50px;text-align:center;z-index:301;">    
        <image src="/images/flyerPhoneGrayRound.png">
    </div>
    <div class="col-lg-4 noPad" style="text-align:left;padding-top:75px;">
      <h4>Awesome Feature 2</h4>
      <p style="max-width:300px;">
      Lorem Ipsum Dolore Lorem Ipsum Dolore Lorem Ipsum Dolore </p>
    </div>
  </div>
</div>