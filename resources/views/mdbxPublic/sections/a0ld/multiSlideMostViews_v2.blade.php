<div class="container-fluid mostViewSlides"
style="background:#efedff;">
  <div class="row" style="margin:0 !important;">

    <div class="col-12 sectionHeader">
      <div style="margin-top:-75px;">
        <span class="ticon ti-bookmark">
        </span>
        <h1>
          <span class="font-Lora">Today's</span>
          <span style="color:#223e94;font-weight:bold;">
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
    </div>

    <div class="col-12 noPad">
      <div class="landingSlick">
        @foreach($mostViews->take(6) as $mv)
          @if($mv->thePhotos->first())
            <div>
              <div style="margin:1px;">
                <div style="padding:5px 30px;;
                border-left:1px solid #efedff;
                margin-bottom:10px;">
                  <div style="color:#223e94;font-weight:bold;">
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
                <div style="padding:5px 30px;border-left:1px solid #fff;
                margin-top:10px;padding-bottom:65px;">
                  <div>
                    <span style="color:#223e94;font-weight:bold;">
                      ${{ number_format($mv->xListPrice )}}</span> |
                    {{ $mv->xxBeds }} Beds | {{ $mv->xxBaths }} Baths |
                    {{ $mv->xxSqft }} Sqft
                  </div>
                  <div style="font-size:85%;margin-top:15px;">
                    Listed by:
                  </div>
                  <div style="font-weight:bold;font-size:125%;color:#223e94;">
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
