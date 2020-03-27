<div class="mostViewSlides"
style="background:#fff">
  <div class="svg-row">
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
      </svg>
    </div>
    <div class="col-12 sectionHeader">
      <div>
        <span class="ticon ti-bookmark">
        </span>
        <div class="mainHead">
          <span class="font-Lora">Today's</span>
          <span class="textPrimary">
            TOP VIEWED
          </span>
        </div>
      </div>
      <div class="header-hr">
        <hr>
      </div>
    </div>

    <div class="slideFrame col-12 noPad">
      <div class="landingSlick">
        @foreach($mostViews->take(6) as $mv)
          @if($mv->thePhotos->first())
            <div>
              <div style="margin:1px;text-align:center;">
                <div class="slideHeader">
                  <div class="textPrimary slideAddress">
                    {{$mv->xFullStreet}}
                  </div>
                  <div class="csz textSmall">
                    {{$mv->xCity}} {{$mv->xState}} {{$mv->xxZip}}
                  </div>
                </div>
                <div class="imageDiv">
                  <a href="/propInfo?id={{$mv->theMeta->sk1}}">
                    <img src="{{env('APP_IMGURL')}}/hqphotos/{{ $mv
                      ->theMeta->zipDir }}/{{$mv->theMeta
                      ->mlsDir}}/{{$mv->thePhotos->first()->photoName}}"
                    class="fullSize cover">
                  </a>
                  <div class="absoTop widthFull">
                    <div class="inlineBlock padding3-10
                    backgroundPrimary textWhite marginAuto
                    bl-radius-10 br-radius-10 borderTopNone">
                      ${{number_format($mv->xListPrice)}}
                    </div>
                  </div>
                  <div class="absoBot widthFull">
                    <div class="inlineBlock textSmall">
                      <div class="lighter9 padding3-10
                      tl-radius-10 tr-radius-10 borderWhite1
                      borderBottomNone">
                        @if($mv->xxBeds)
                          {{$mv->xxBeds}} Beds
                          <span class="padding0-3 textPrimary opacity3">|</span>
                        @endif
                        @if($mv->xxBaths)
                          {{$mv->xxBaths}} Baths
                          <span class="padding0-3 textPrimary opacity3">|</span>
                        @endif
                        @if($mv->xxSqft)
                          {{$mv->xxSqft}} Sqft
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                <div class="slideFooter">
                  <div class="agentFrame">
                    <div class="agentImageDiv floatLeft">
                      @if($mv->theAgent->theAgentCleanup)
                        <img class="agentImage"
                        src='{{env('APP_IMGURL')}}/agentPhotos/{{$mv->theAgent->theAgentCleanup
                          ->newRemID}}/{{$mv->theAgent->agtPhoto}}'>
                      @endif
                    </div>
                    <div class="agentDetails floatLeft">
                      <div class="textSmall">
                        Listed by:
                      </div>
                      <div class="agentName">
                        {{$mv->theAgent->agtFullName}}
                      </div>
                      <div class="agentOffice textSmall paddingBottom10">
                        {{$mv->theOffice->officeName}}
                      </div>
                    </div>
                    <div style="clear:both;">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endif
        @endforeach
      </div>
    </div>
  </div>
</div>
