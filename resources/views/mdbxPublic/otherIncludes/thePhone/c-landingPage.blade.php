
<div style="z-index:300;position:absolute;
background:#ebebeb;border-bottom-right-radius:1em;
color:#222;padding:5px;font-size:135%;padding-right:20px;
padding-left:15px;text-shadow:1px 1px 0 rgba(0,0,0,0.3);color:#333;" 
class="font-Lora">
<img src="/images/remicon2.gif" style="max-height:30px;">
  RealtyEmails
</div>
<!--
<div style="position:absolute;width:100%;top:0;z-index:300;height:425px;">
  <div style="background:rgba(255,255,255,.6);
  height:100%;width:100%;position:absolute;display:flex;
  align-items:center;justify-content:center;color:#fff;
  flex-direction:column;">
    <div style="background:rgba(255,255,255,.6);color:#222222;
    padding:5px;padding-left:25px;padding-right:25px;">
      <div>
        <h1 style="text-shadow:2px 2px 2px rgba(0,0,0,0.3);">
          Online Real Estate Flyers
        </h1>
      </div>
      <div style="text-align:center;font-family:Lora;">
        <h4>
          Email &nbsp;&nbsp;&nbsp;
          Share &nbsp;&nbsp;&nbsp; 
          Print &nbsp;&nbsp;&nbsp; 
          <span style="font-style:italic;">
            Impress
          </span>
        </h4>
      </div>
    </div>
  </div>
</div>
-->
<section style="background:#ebebeb;">
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
        Awesome Feature 1
      </h4>
      <div class="row">
        <div class="col-lg-6">
        </div>
        <div class="col-lg-6">
          <p>
            Lorem Ipsum Dolore Lorem Ipsum Dolore 
            Lorem Ipsum Dolore
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