<?php
function trunc($phrase, $max_words) {
   $phrase_array = explode(' ',$phrase);
   if(count($phrase_array) > $max_words && $max_words > 0)
      $phrase = implode(' ',array_slice($phrase_array, 0, $max_words)).'...';
   return $phrase;
}
?>

<div class="searchFormTop navSortTabs">
  <ul class="nav nav-tabs">
    <li class="active">
      <a data-toggle="tab" href="#b1">
        Most Recent
      </a>
    </li>
    <li>
      <a data-toggle="tab" href="#b2">
        Most Views
      </a>
    </li>
    <li>
      <a data-toggle="tab" href="#b3">
        High Price
      </a>
    </li>
    <li>
      <a data-toggle="tab" href="#b4">
        Low Price
      </a>
    </li>
  </ul>
</div>
<div class="tab-content">
  <!-- tab 1b-->
  <div id="b1" class="slideList tab-pane fade show active" >
    @foreach($mostRecent as $mr)
      <div style="padding-bottom:5px;">
        <div class="col-lg-4 col-md-4 col-sm-5">
          <div>
            <a href="/propInfo?id={{$mr->theMeta->sk1}}">
              <img src="/hqphotos/{{$mr->theMeta->zipDir}}/{{ $mr->theMeta->mlsDir }}/{{ $mr->thePhotos->first()->photoName }}"
              style="width:300px;" class="img-responsive">
            </a>
          </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-7">
          <div class="slideAddress">
            <h4 style="padding:0;margin:0;">
              <a style="color:#333;"
              href="/propInfo?id={{$mr->theMeta->sk1}}">
                {{ $mr->xFullStreet}} - ${{ number_format($mr->xListPrice) }}
              </a>
            </h4>
          </div>
          <div class="slideDetails">
            {{$mr->xCity}}, {{ $mr->xState }} @if($mr->xZip){{$mr->xZip}}@else{{$mr->xxZip}}@endif
            | @if($mr->xxBeds){{$mr->xxBeds}}@else{{$mr->xBeds}}@endif Bd
            | @if($mr->xxBaths){{$mr->xxBaths}}@else{{$mr->xBaths}}@endif Ba
            | @if($mr->xxSqft){{$mr->xxSqft}}@else{{$mr->xSqft}}@endif SqFt.
          </div>
          <div style="padding:10px;background:#f3f0ed;
          border-radius:8px;font-size:10pt;margin-top:10px;
          margin-bottom:10px;">
            {{ trunc($mr->theRemarks->xPubRemarks,35) }}
          </div>
          <div>
            Listed By:
          </div>
          <div>
            {{$mr->theAgent->agtFullName}}
          </div>
        </div>
        <div class="clearfix">
        </div>
        <hr style="padding-top:5px;padding-bottom:5px;width:90%;text-align:center;">
      </div>
    @endforeach

    <div style="padding:10px;text-align:center;">
    {{ $mostRecent->links() }}
    </div>

  </div>

  <!-- tab 2b -->
  <div id="b2" class="slideList tab-pane fade" >
    @foreach($mostViews as $mv)
      <div style="padding-bottom:5px;">
        <div class="col-lg-4 col-md-4 col-sm-5">
          <div>
            <a href="/propInfo?id={{$mv->theMeta->sk1}}">
              <img src="/hqphotos/{{$mv->theMeta->zipDir}}/{{ $mv->theMeta->mlsDir }}/{{ $mv->thePhotos->first()->photoName }}"
              style="width:300px;" class="img-responsive">
            </a>
          </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-7">
          <div class="slideAddress">
            <h4 style="padding:0;margin:0;">
              <a style="color:#333;"
              href="/propInfo?id={{$mv->theMeta->sk1}}">
                {{ $mv->xFullStreet}} - ${{ number_format($mv->xListPrice) }}
              </a>
            </h4>
          </div>
          <div class="slideDetails">
            {{$mv->xCity}}, {{ $mv->xState }} {{$mv->xZip}} | {{ $mv->xxBeds }} Bd
            | {{$mv->xxBaths}} Ba | {{ $mv->xxsqft }} SqFt.
          </div>
          <div style="padding:10px;background:#f3f0ed;
          border-radius:8px;font-size:10pt;margin-top:10px;
          margin-bottom:10px;">
            {{ trunc($mv->theRemarks->xPubRemarks,35) }}
          </div>
          <div>
            Listed By:
          </div>
          <div>
            {{$mv->theAgent->agtFullName}}
          </div>
        </div>
        <div class="clearfix">
        </div>
        <hr style="padding-top:5px;padding-bottom:5px;width:90%;text-align:center;">
      </div>
    @endforeach
    <div style="padding:10px;text-align:center;">
    {{ $mostViews->links() }}
    </div>
  </div>

  <div id="b3" class="slideList tab-pane fade" >
    @foreach($highPrice as $hp)
      <div style="padding-bottom:5px;">
        <div class="col-lg-4 col-md-4 col-sm-5">
          <div>
            <a href="/propInfo?id={{$hp->theMeta->sk1}}">
              <img src="/hqphotos/{{$hp
                ->theMeta->zipDir}}/{{$hp
                  ->theMeta->mlsDir }}/{{$hp
                    ->thePhotos->first()->photoName}}"
              style="width:300px;" class="img-responsive">
            </a>
          </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-7">
          <div class="slideAddress">
            <h4 style="padding:0;margin:0;">
              <a style="color:#333;"
              href="/propInfo?id={{$hp->theMeta->sk1}}">
                {{ $hp->xFullStreet}} - ${{number_format($hp->xListPrice)}}
              </a>
            </h4>
          </div>
          <div class="slideDetails">
            {{$hp->xCity}}, {{ $hp->xState }} {{$hp->xZip}} | {{ $hp->xxBeds }} Bd
            | {{$hp->xxBaths}} Ba | {{ $hp->xxsqft }} SqFt.
          </div>
          <div style="padding:10px;background:#f3f0ed;
          border-radius:8px;font-size:10pt;margin-top:10px;
          margin-bottom:10px;">
            {{trunc($hp->theRemarks->xPubRemarks,35)}}
          </div>
          <div>
            Listed By:
          </div>
          <div>
            {{$hp->theAgent->agtFullName}}
          </div>
        </div>
        <div class="clearfix">
        </div>
        <hr style="padding-top:5px;padding-bottom:5px;width:90%;text-align:center;">
      </div>
    @endforeach
    <div style="padding:10px;text-align:center;">
    {{ $highPrice->links() }}
    </div>
  </div>

  <div id="b4" class="slideList tab-pane fade" >
    @foreach($lowPrice as $lp)
      <div style="padding-bottom:5px;">
        <div class="col-lg-4 col-md-4 col-sm-5">
          <div>
              <img src="/hqphotos/{{$lp
                ->theMeta->zipDir}}/{{$lp
                  ->theMeta->mlsDir }}/{{$lp
                    ->thePhotos->first()->photoName}}"
              style="width:300px;" class="img-responsive">
          </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-7">
          <div class="slideAddress">
            <h4 style="padding:0;margin:0;">
              <a style="color:#333;"
              href="/propInfo?id={{$lp->theMeta->sk1}}">
                {{ $lp->xFullStreet}} - ${{number_format($lp->xListPrice)}}
              </a>
            </h4>
          </div>
          <div class="slideDetails">
            {{$lp->xCity}}, {{ $lp->xState }} {{$lp->xZip}} | {{ $lp->xxBeds }} Bd
            | {{$lp->xxBaths}} Ba | {{ $lp->xxsqft }} SqFt.
          </div>
          <div style="padding:10px;background:#f3f0ed;
          border-radius:8px;font-size:10pt;margin-top:10px;
          margin-bottom:10px;">
            {{ trunc($lp->theRemarks->xPubRemarks,35) }}
          </div>
          <div>
            Listed By:
          </div>
          <div>
            {{$lp->theAgent->agtFullName}}
          </div>
        </div>
        <div class="clearfix">
        </div>
        <hr style="padding-top:5px;padding-bottom:5px;width:90%;text-align:center;">
      </div>
    @endforeach
    <div style="padding:10px;text-align:center;">
    {{ $lowPrice->links() }}
    </div>
  </div>

</div>
