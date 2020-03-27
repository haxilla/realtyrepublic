<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 mostViewed" style="background-color:rgba(255,255,255,0.9);padding:0px;">
  <div class="innerMostViewed"
   style="margin:20px;background:#fff;border-radius:15px;
   box-shadow:1px 1px 1px #ebebeb;">
    <div class="thisWeeksHeader">
      <h2>THIS WEEK'S TOP VIEWED E-FLYERS!</h2>
    </div>
    @foreach($mostViews as $mv)
      @if($mv->thePhotos->first())
      <div style="color:#666;"
      class="col-lg-offset-0 col-md-offset-0 col-sm-offset-1">
        <div>
          <hr>
        </div>
        <div class="featuredProps col-lg-5 col-md-6 col-sm-5 col-xs-12 featPhoto">
          <a href="/propInfo?id={{$mv->theMeta->sk1}}">
            <img src="/hqphotos/{{ $mv->theMeta->zipDir }}/{{$mv->theMeta->mlsDir}}/{{$mv->thePhotos->first()->photoName}}">
          </a>
        </div>
        <div class="col-lg-7 col-md-6 col-sm-7 col-xs-12 featText">
          <div cla  ss="flyerAddress" style="text-decoration:underline;padding-bottom:10px;">
            <a style="color:#666;font-weight:bold;" href="/propInfo?id={{$mv->theMeta->sk1}}">
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
          <div style="color:#090;font-weight:bold;font-size:14px;padding:3px;padding-bottom:5px;">
            Viewed <span class="badge" style="background-color:#090;color:#fff;">{{ number_format($mv->theStats->xWebViews) }}</span> Times!<BR>
          </div>
        </div>
        <div style="clear:both;">
        </div>
      </div>
      @endif
    @endforeach
  </div>
</div>
