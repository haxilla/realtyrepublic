<?php
function trunc($phrase, $max_words) {
   $phrase_array = explode(' ',$phrase);
   if(count($phrase_array) > $max_words && $max_words > 0)
      $phrase = implode(' ',array_slice($phrase_array, 0, $max_words)).'...';
   return $phrase;
}
?>

<div class="container-fluid" style="padding-top:50px;">
  <!-- tab 1b-->
    @foreach($mostRecent as $mr)
      <div style="padding:5px 0;">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-5">
            <div>
              <a href="/propInfo?id={{$mr->theMeta->sk1}}">
                <img src="/hqphotos/{{$mr->theMeta->zipDir}}/{{ $mr->theMeta->mlsDir }}/{{ $mr->thePhotos->first()->photoName }}" style="max-width:100%">
              </a>
            </div>
          </div>
          <div class="col-lg-8 col-md-8 col-7">
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
        </div>
      </div>
      <hr>
    @endforeach
    <div style="padding:10px;text-align:center;">
      {{ $mostRecent->links() }}
    </div>
  </div>
</div>
