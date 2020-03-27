<div class="container-fluid newestListSection"
style="background:#efedff;">
  <div class="svg-row" style="margin:0;">
    <div class="r-separator">
      <svg id="" preserveAspectRatio="xMidYMax meet"
      class="svg-separator sep11" viewBox="0 0 1600 100"
      style="display: block;" data-height="100">
        <polygon class=""
          style="fill: #efedff"
          points="-40,63.667 19.833,3.833 80,64 140,
          4 200,64 260,4 320,64 380,4 440,64 500,
          4 560,64 620,4 680,64 740,4 800,64 860,
          4 920,64 980,4 1040,64 1100,4 1160,64 1220,
          4 1280.333,64.333 1340.333,4.333 1400,
          64 1460,4 1520,64 1578,6 1636,64 1636,
          104 -40,104 ">
        </polygon>
        <!--
        <polygon class=""
        style="opacity: 1;fill: #96b7cb;"
        points="-40,86 20,26 80,86 140,26 200,76 260,4 200,64 140,4 80,64 19.833,3.833 -40,63.667 ">
        </polygon>
        <polygon class=""
        style="opacity: 1;fill: #64d1e7;"
        points="1159,69 1220,8 1281,73 1340,14 1399,73 1460,12 1521,73 1578,16 1634,72 1636,73.333 1636,64 1578,6 1520,64 1460,4 1400,64 1340.333,4.333 1280.333,64.333 1220,4 1160,64 1100,4 1040,64 1100,10 ">
        </polygon>
        -->
        </svg>
    </div>
    <div class="col-12" style="color:#223e94;
    padding:15px;text-align:center;margin-bottom:25px;">
      <div style="font-size:2em">
        <i class="ti-shine"></i>
      </div>
      <h1>
        <span style="color:#464555;font-family:Lora">
          Just
        </span> ADDED
      </h1>
      <hr style="margin:5px 100px;">
    </div>

  </div>

  <div class="row" style='margin:0;'>
      @foreach($newAdds->take(4) as $the)
        <div class="col-12 col-md-6 noPad">
          <!--
          <div class="row noMargin">
            <div class="col-5 padding10 backgroundWhite textCenter">
              {{$the->creationDate->diffForHumans()}}
            </div>
            <div class="col-7 padding10">
              {{$the->theAgent->agtFullName}}
            </div>
          </div>
          -->
          <!--
          <div style="position:absolute;left:15px;z-index:1;">
            <div style="padding:3px 10px;
            color:#fff;background:rgba(0,0,0,.2);font-size:70%;">
              {{$the->theAgent->agtFullName}}
            </div>
          </div>
          -->
          <div class="row">
            <div class="col-12 col-md-12">
              <div class="homeImageDiv">
                <img src="{{env('APP_IMGURL')}}/hqphotos/{{$the
                  ->theMeta->zipDir}}/{{$the->theMeta
                  ->mlsDir}}/{{$the->thePhotos
                  ->where('def','=','1')
                  ->first()->photoName}}"
                  alt="{{$the->xFullStreet}} Main"
                  class="fullSize cover">
              </div>
            </div>
            <div class="col-12 col-md-12">
              <div>
                {{$the->xFullStreet}}
              </div>
              <div>
                {{$the->xCity}}, {{$the->xState}} {{$the->xxZip}}
              </div>
              <div>
                ${{number_format($the->xListPrice)}}
              </div>
              <div>
                {{$the->xxBeds}} Bd | {{$the->xxBaths}} Ba | {{$the->xxSqft}} Sqft
              </div>

            </div>
          </div>
        </div>
      @endforeach
  </div>
  <div class="row"
  style="margin:0;padding-top:10px;
  padding-bottom:65px;">
    <div class="col" style="text-align:center;">
      <div class="inlineBlock" style="padding:10px 15px;
      background:rgba(255,255,255,.5);border-radius:1em;
      border:1px solid #fff;margin-top:25px;">
        <a href="" style="color:#223e94;
        text-decoration:none;">
          View & Search ALL
        </a>
      </div>
  </div>

  <!--
  <div class="row" style="margin:0;">
    @foreach($newAdds as $the)
      <div class="col-6 noPad"
      style="padding:1px;height:175px;">
          <img src="{{env('APP_IMGURL')}}/hqphotos/{{$the
            ->theMeta->zipDir}}/{{$the->theMeta
            ->mlsDir}}/{{$the->thePhotos
            ->where('def','=','1')
            ->first()->photoName}}"
            alt="{{$the->xFullStreet}} Main"
            style="width:100%;height:100%;object-fit:cover;">
      </div>
    @endforeach
  </div>
  -->
</div>
