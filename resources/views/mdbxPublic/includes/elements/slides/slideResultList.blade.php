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
      <a data-toggle="tab" href="#1c">
        Search Results
      </a>
    </li>
  </ul>
</div>
<div class="tab-content">
  <!-- tab 1b-->
  <div id="1c" class="slideList tab-pane fade in active" style="margin-bottom:25px;">
  @if(!$searchResults->first())
  <div style="padding;15px;margin:15px;">
    Sorry, no results for that search!
  </div>
  @endif
  @foreach($searchResults as $sr)
    <div style="padding-bottom:5px;">
      <div class="col-lg-4 col-md-4 col-sm-5">
        <div>
          <a href="/propInfo?id={{$sr->theMeta['sk1']}}">
            <img src="/hqphotos/{{$sr
              ->theMeta['zipDir']}}/{{$sr
                ->theMeta['mlsDir']}}/{{$sr
                  ->thePhotos->first()->photoName}}"
            style="width:300px;" class="img-responsive">
          </a>
        </div>
      </div>
      <div class="col-lg-8 col-md-8 col-sm-7">
        <div class="slideAddress">
          <h4 style="padding:0;margin:0;">
            <a style="color:#333;"
            href="propInfo?id={{$sr->theMeta['sk1']}}">
              {{ $sr->xFullStreet}} - ${{number_format($sr->xListPrice)}}
            </a>
          </h4>
        </div>
        <div class="slideDetails">
          {{$sr->xCity}}, {{ $sr->xState }} {{$sr->xZip}} | {{ $sr->xxBeds }} Bd
          | {{$sr->xxBaths}} Ba | {{ $sr->xxsqft }} SqFt.
        </div>
        <div style="padding:10px;background:#f3f0ed;
        border-radius:8px;font-size:10pt;margin-top:10px;
        margin-bottom:10px;">
          {{trunc($sr->theRemarks['xPubRemarks'],35)}}
        </div>
        <div>
          Listed By:
        </div>
        <div>
          {{$sr->theAgent['agtFullName']}}
        </div>
      </div>
      <div class="clearfix">
      </div>
      <hr style="padding-top:5px;padding-bottom:5px;width:90%;text-align:center;">
    </div>
    @endforeach

    <div style="padding:10px;text-align:center;">
      {{ $searchResults->appends($_GET)->links() }}
    </div>

  </div>


</div>
