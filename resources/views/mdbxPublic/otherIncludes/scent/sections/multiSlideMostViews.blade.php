<div class="container-fluid ss-style-roundEdges sectionDivide">
  <div class="row" style="padding:50px 75px;
  background:linear-gradient(#efedff, #fff);">
    <div class="col-12" style="text-align:center;">
      <h1 style="font-weight:700;">
        Today's Top Viewed Homes
      </h1>
      <div style="padding-bottom:15px;">
        <p>
          Take a look!  See if you or someone you know might be interested in homes like these.
        </p>
      </div>
    </div>
    <div class="col-12 your-class">
      @foreach($mostViews->take(6) as $mv)
        @if($mv->thePhotos->first())
          <div style="padding:15px;">
            <div style="position:relative;">
              <a href="/propInfo?id={{$mv->theMeta->sk1}}">
                <img src="/hqphotos/{{ $mv->theMeta->zipDir }}/{{$mv->theMeta
                  ->mlsDir}}/{{$mv->thePhotos->first()->photoName}}" 
                  class="colIndexPhoto img-fluid" style="object-fit:cover;
                  height:275px;width:100%;">
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
</div>
<svg id="bigTriangleColor" xmlns="http://www.w3.org/2000/svg" version="1.1" 
width="100%" height="100" viewBox="0 0 100 102" 
preserveAspectRatio="none">
  <path d="M0 0 L50 100 L100 0 Z"></path>
</svg>