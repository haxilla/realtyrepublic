<div id="carouselBackgroundAbsolute" 
class="carousel slide" 
data-ride="carousel" style="position:relative;z-index:0;">
  <div class="carousel-inner">
    @foreach($newAdds as $the)
      <div class="carousel-item 
        @if($loop->iteration===1)
          active
        @endif">
        <div class="image650hContainer" style="position:relative;">
          <img class="d-block w-100 image650h"
          src="{{env('APP_IMGURL')}}/hqphotos/{{$the->theMeta->zipDir}}/{{$the->theMeta
            ->mlsDir}}/{{$the->thePhotos->where('def','=','1')
            ->first()->photoName}}"
            alt="{{$the->xFullStreet}} Main">
        </div>
        <div style="width:100%;height:100%;position:absolute;top:0;
        background:rgba(0,0,0,.5);color:rgba(255,255,255,.7);padding:10% 5%;">
          <div style="font-family:Lora;font-size:150%;">
            Featured Home
          </div>
          <div style="font-size:80%;color:rgba(255,255,255,.8)">
            {{$the->xFullStreet}} - {{$the->xCity}}, {{$the->xState}} {{$the->xxZip}}
          </div>
        </div>
        <div style="position:absolute;bottom:0;
        color:rgba(255,255,255,.7);font-size:80%;padding:5%;">
          @if($the->theAgent->agtPhoto)
            <div style="float:left;">
              @if($the->theAgent->theAgentCleanup)
                <img class="carouselAgentImg"
                src='{{env('APP_IMGURL')}}/agentPhotos/{{$the->theAgent->theAgentCleanup
                  ->newRemID}}/{{$the->theAgent->agtPhoto}}'>
              @else
                <img class="carouselAgentImg"
                src='{{env('APP_IMGURL')}}/HQoffice/{{$the->theOffice
                  ->officeID}}/{{$the->theAgent->agtPhoto}}'>
              @endif
            </div>
          @endif
          <div style="float:left;">
            <div class="carouselAgentName">
              {{$the->theAgent->agtFullName}}
            </div>
            <div class="carouselAgentCompany">
              {{$the->theOffice->officeName}}
            </div>
            <div class="carouselAgentPhone">
              {{$the->theAgent->agtMainPhone}}
            </div>
          </div>
          <div style="clear:both;">
          </div>
        </div>
      </div>
    @endforeach
    <!-- END LOOP 1 -->
  </div>
</div>