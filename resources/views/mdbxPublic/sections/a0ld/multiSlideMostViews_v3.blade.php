<div class="container-fluid mostViewSlides"
style="background:#fff">
  <div class="svg-row" style="margin:0">
    <div class="r-separator">
      <svg id="" preserveAspectRatio="xMidYMax meet"
      class="svg-separator sep11" viewBox="0 0 1600 100"
      style="display: block;" data-height="100">
        <polygon class=""
          style="fill: #fff"
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
    <div class="col-12 sectionHeader">
      <div>
        <span class="ticon ti-bookmark">
        </span>
        <h1>
          <span class="font-Lora">Today's</span>
          <span class="textPrimary">
            TOP VIEWED
          </span>
        </h1>
      </div>
      <div style="font-family:Roboto">
        <!--
        <p>
          Take a look!  See if you
          or someone you know
          might be interested
          in homes like these.
        </p>
        -->
      </div>
      <div class="header-hr">
        <hr>
      </div>
    </div>

    <div class="col-12 noPad">
      <div class="landingSlick">
        @foreach($mostViews->take(6) as $mv)
          @if($mv->thePhotos->first())
            <div>
              <div style="margin:1px;text-align:center;">
                <div>
                  <div class="textPrimary slideAddress">
                    {{$mv->xFullStreet}}
                  </div>
                  <div style="font-size:80%;">
                    {{$mv->xCity}} {{$mv->xState}} {{$mv->xxZip}}
                  </div>
                </div>
                <a href="/propInfo?id={{$mv->theMeta->sk1}}">
                  <img src="{{env('APP_IMGURL')}}/hqphotos/{{ $mv
                    ->theMeta->zipDir }}/{{$mv->theMeta
                    ->mlsDir}}/{{$mv->thePhotos->first()->photoName}}"
                    class="colIndexPhoto img-fluid"
                    style="object-fit:cover;
                    height:275px;width:100%;">
                </a>
                <div>
                  <div>
                    <span style="color:#223e94;">
                      ${{ number_format($mv->xListPrice )}}</span> |
                    {{ $mv->xxBeds }} Beds | {{ $mv->xxBaths }} Baths |
                    {{ $mv->xxSqft }} Sqft
                  </div>
                  <div style="font-size:85%;margin-top:15px;">
                    Listed by:
                  </div>
                  <div style="font-size:125%;color:#223e94;">
                    {{$mv->theAgent->agtFullName}}
                  </div>
                  <div style="font-size:85%">
                    {{$mv->theOffice->officeName}}
                  </div>
                  <!--
                  <div style="font-size:85%;">
                    {{$mv->theAgent->agtMainPhone}}
                  </div>
                  -->
                </div>

              </div>
              <!--
              <div style="background:#fff;">
                <div class="flyerAddress" style="text-decoration:underline;">
                  <a style="color:#333;font-weight:bold;"
                  href="/propInfo?id={{$mv->theMeta->sk1}}">
                  {{ $mv->xFullStreet }}
                  </a>
                </div>
                <div style="font-size:14px;padding-bottom:10px;">
                  {{$mv->xCity}} {{$mv->xState}} {{ $mv->xZip }}
                </div>
                <div style="font-size:16px;padding-bottom:10px;">
                  ${{ number_format($mv->xListPrice )}}
                </div>
                <div style="font-size:14px;">
                  {{ $mv->xxBeds }} Beds, {{ $mv->xxBaths }}
                  Baths {{ $mv->xxSqft }} Sqft.
                </div>
                <div style="height:140px;overflow:hidden;padding:15px 0;">
                  {{$mv->theRemarks->xPubRemarks}}
                </div>
                <div style="text-align:right;padding:15px;">
                  <a href="/propInfo?id={{$mv->theMeta->sk1}}"
                    style="color:#223e94;text-decoration:underline;">
                    ...More
                  </a>
                </div>
                <div style="font-size:14px;padding-bottom:10px;">
                  Listed by:
                </div>
                  @if($mv->theAgent->agtPhoto)
                    <div style="height:100px;width:80px;object-fit:cover;">
                      @if($mv->theAgent->theAgentCleanup)
                        <a id="agentWallPhoto" data-ajid="{{$mv->theAgent
                        ->theAgentCleanup->newRemID}}" style="cursor:pointer;">
                          <img src='{{env('APP_IMGURL')}}/agentPhotos/{{$mv->theAgent->theAgentCleanup
                            ->newRemID}}/{{$mv->theAgent->agtPhoto}}'
                            style="height:100px;width:80px;object-fit:cover;">
                        </a>
                      @else
                        <a id="agentWallPhoto" data-ajid="{{$mv->theAgent->id}}"
                        style="cursor:pointer">
                          <img src='https://www.realtyemails.com/HQoffice/{{$mv->theOffice
                            ->officeID}}/{{$mv->theAgent->agtPhoto}}'
                            style="height:100px;width:80px;object-fit:cover;">
                        </a>
                      @endif
                    </div>
                  @elseif($mv->theAgent->agtLogo)
                    @if($mv->theAgent->theAgentCleanup)
                      <a id="agentWallPhoto" data-ajid="{{$mv->theAgent
                      ->theAgentCleanup->newRemID}}" style="cursor:pointer;">
                        <img style="height:100px"
                        src="{{env('APP_IMGURL')}}/officeLogos/{{$mv->theOffice->officeID}}/{{$mv
                        ->theAgent->agtLogo}}">
                      </a>
                    @else
                      <a id="agentWallPhoto" data-ajid="{{$mv->theAgent->id}}"
                      style="cursor:pointer">
                        <img style="height:100px"
                        src="{{env('APP_IMGURL')}}/officeLogos/{{$mv->theOffice->officeID}}/{{$mv->theAgent->agtLogo}}">
                      </a>
                    @endif
                  @endif
                <div style="text-align:left;">
                  <div class="carouselAgentName"
                  style="font-weight:bold;font-size:125%;color:#223e94;">
                    {{$mv->theAgent->agtFullName}}
                  </div>
                  <div class="carouselAgentCompany" style="font-size:90%">
                    {{$mv->theOffice->officeName}}
                  </div>
                  <div class="carouselAgentPhone" style="font-size:90%;">
                    {{$mv->theAgent->agtMainPhone}}
                  </div>
                </div>
                <div style="clear:both;">
                </div>
              </div>
              <div style="clear:both;">
              </div>
              -->
            </div>
          @endif
        @endforeach
      </div>
    </div>
    <!--
    <div class="col-12" style="padding:25px;text-align:center;">
      @include('mdbxPublic.includes.elements.gradBlueViewAllEflyers')
    </div>
    -->
  </div>

</div>


<!--
<div style="color:#090;font-weight:bold;font-size:14px;
padding:10px;text-align:center;background:rgba(255,255,255,.8);
width:100%;position:absolute;bottom:0;">
  Viewed
  <span class="badge" style="background-color:#090;color:#fff">
  { { number_format($mv->theStats->xWebViews) } }</span> Times!
</div>
-->
