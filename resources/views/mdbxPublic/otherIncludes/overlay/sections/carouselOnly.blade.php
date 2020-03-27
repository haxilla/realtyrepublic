<div id="landingFlyers" 
class="carousel slide paperStack3" 
data-ride="carousel" 
@if(strpos($theme,'rotateFlyer')!==false)
  style="transform:rotateY(-20deg)"
@endif>
  <div class="carousel-inner">
    @foreach($newAdds as $the)
      <div class="carousel-item 
        @if($loop->iteration===1)
          active
        @endif" style="z-index:1;">
        <div class="text-white" 
        style="background:rgba(0,0,0,.2);">
          <div class="landingFlyerHeadline">
            <img src="/images/headline_graphics/mustsee/3d/mustsee_ffffff_3dx.png">
          </div>
          <div style="float:right;
          text-align:right;" class="padding15">
            <div class="text-bold">
              {{$the->xFullStreet}}
            </div>
            <div>
              {{$the->xCity}}, {{$the->xState}} {{$the->xxZip}}
            </div>
          </div>
          <div style="clear:both;">
          </div>
        </div>
        <div class="image375hContainer" style="position:relative;">
          <img class="d-block w-100 image375h"
          src="/hqphotos/{{$the->theMeta->zipDir}}/{{$the->theMeta
            ->mlsDir}}/{{$the->thePhotos->where('def','=','1')
            ->first()->photoName}}"
            alt="{{$the->xFullStreet}} Main">
        </div>
        <div class="padding10" style="color:#333;background:#fff;">
          <div style="float:left;padding-right:15px;">
            @if($the->theAgent->theAgentCleanup)
              <img src='/agentPhotos/{{$the->theAgent->theAgentCleanup
                ->newRemID}}/{{$the->theAgent->agtPhoto}}'
              class="carouselAgentImg">
            @else
              <img class="img-circle"
              src='http://www.realtyemails.com/HQoffice/{{$the->theOffice
                ->officeID}}/{{$the->theAgent->agtPhoto}}'
                class="carouselAgentImg">
            @endif
          </div>
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
  <a class="carousel-control-prev" href="#landingFlyers" 
  role="button" data-slide="prev" style="z-index:2">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" 
  href="#landingFlyers" role="button" data-slide="next"
  style="z-index:2;">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>