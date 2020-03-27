<div style="background:#f2ecff">
  <div>
    <div style="text-align:center;padding-top:50px;">
      <img src="/images/new_scroll3.png">
    </div>
    <h1 style="color:#303030;margin:0;padding-top:25px;padding-bottom:0;margin-right:15%;
    margin-left:15%;text-align:center;font-family:Lora">
      <span>
        Today's
      </span> Top Viewed Flyers
    </h1>
  </div>
  <div class="row" style="padding:25px;padding-top:35px;">
    @foreach($mostViews->take(4) as $mv)
      @if($mv->thePhotos->first())
        <div class="col-lg-3 col-md-3 col-sm-6"
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


