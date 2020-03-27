<div style="background:#efedff;overflow:hidden;
position:relative;border-top:5px solid rgba(255,255,255,.5);
border-bottom:5px solid rgba(255,255,255,.5);">
  <div>
    <h1 style="color:#303030;margin:0;padding:25px;padding-bottom:0;
    text-align:center;color:#5C4B9F;font-weight:bold;font-family:Lora;">
      <span>
        Today's
      </span> Top Viewed Flyers
    </h1>
  </div>
  <div class="row" style="padding:25px;padding-top:35px;">
    @foreach($mostViews->take(3) as $mv)
      @if($mv->thePhotos->first())
        <div class="col-lg-4 col-md-4 col-sm-6"
        style="margin-bottom:35px;">
          <div style="position:relative;border:5px solid #fff;">
            <a href="/propInfo?id={{$mv->theMeta->sk1}}">
              <img src="/hqphotos/{{ $mv->theMeta->zipDir }}/{{$mv->theMeta
                ->mlsDir}}/{{$mv->thePhotos->first()->photoName}}" 
                class="colIndexPhoto img-fluid" style="object-fit:cover;
                height:200px;width:100%;">
            </a>
            <div style="color:#090;font-weight:bold;font-size:14px;
            padding:10px;text-align:center;background:rgba(255,255,255,.8);
            width:100%;position:absolute;bottom:0;">
              Viewed 
              <span class="badge" style="background-color:#090;color:#fff">
              {{ number_format($mv->theStats->xWebViews) }}</span> Times!
            </div>
          </div>
          <div style="padding:15px;background:#fff;color:#666;">
            <div class="flyerAddress" style="text-decoration:underline;padding-bottom:10px;">
              <a style="color:#333;font-weight:bold;" href="/propInfo?id={{$mv->theMeta->sk1}}">
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
          <div style="clear:both;">
          </div>
        </div>
      @endif
    @endforeach
  </div>
</div>


