<div style="background:#f2ecff">
  <div>
    <div style="text-align:center;padding-top:50px;">
      <img src="/images/new_scroll3.png">
    </div>
    <h1 style="color:#303030;margin:0;
    padding-top:25px;padding-bottom:0;margin-right:15%;
    margin-left:15%;text-align:center;font-family:Lora">
      <span>
        Today's
      </span> Top Viewed Flyers
    </h1>
  </div>
  <div class="row" style="padding:25px;padding-top:35px;">
    @foreach($mostViews->take(4) as $mv)
      @if($mv->thePhotos->first())
        <div class="col-lg-6" style="margin-bottom:25px;">
          <div class="row">
            <div class="col-lg-6 noPad" style="border:5px solid #fff;">
              <a href="/propInfo?id={{$mv->theMeta->sk1}}">
                <img src="/hqphotos/{{ $mv->theMeta->zipDir }}/{{$mv->theMeta
                  ->mlsDir}}/{{$mv->thePhotos->first()->photoName}}" 
                  class="colIndexPhoto img-fluid" style="object-fit:cover;
                  height:200px;width:100%;">
              </a>
            </div>
            <div class="col-lg-6 noPad" style="color:#666;">
              <div style="background:#fff;margin-right:25px;
              height:100%;">
                <div class="flyerAddress" 
                style="text-decoration:underline;
                padding-bottom:10px;">
                  <a style="color:#333;font-weight:bold;" 
                  href="/propInfo?id={{$mv->theMeta->sk1}}">
                  {{ $mv->xFullStreet }}
                  </a>
                </div>
                <div style="font-size:16px;padding-bottom:10px;">
                  ${{ number_format($mv->xListPrice )}}
                </div>
                <div style="font-size:14px;">
                  {{$mv->xCity}} {{$mv->xState}} {{ $mv->xZip }}
                </div>
                <div style="font-size:14px;">
                  {{ $mv->xxBeds }} Beds, {{ $mv->xxBaths }} Baths {{ $mv->xxSqft }} Sqft.
                </div>
                <div style="font-size:14px;padding-bottom:10px;">
                  Listed by {{ $mv->theAgent->agtFullName }}
                </div>
              </div>
            </div>
          </div>
        </div>
      @endif
    @endforeach
  </div>
</div>


