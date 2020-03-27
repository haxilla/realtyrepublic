<div id="carouselControls" 
class="carousel slide" 
data-ride="carousel">
  <div class="carousel-inner">
    @foreach($newAdds as $the)
      <div class="carousel-item 
        @if($loop->iteration===1)
          active
        @endif" style="z-index:1;">
        <div class="padding15 text-white" 
        style="background:rgba(0,0,0,.4);">
          <div style="float:left;text-align:center;">
            <div class="text-bold">
              {{$the->xFullStreet}}
            </div>
            <div>
              {{$the->xCity}}, {{$the->xState}} {{$the->xxZip}}
            </div>
          </div>
          <div class="padding15" style="float:right;font-weight:bold;">
            ${{number_format($the->xListPrice)}}
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
        <div class="padding15" style="color:#333;background:#fff;">
          <div style="float:left;padding-right:15px;">
            @if($the->theAgent->theAgentCleanup)
              <img src='/agentPhotos/{{$the->theAgent->theAgentCleanup
                ->newRemID}}/{{$the->theAgent->agtPhoto}}'
              style="height:75px;">
            @else
              <img class="img-circle"
              src='http://www.realtyemails.com/HQoffice/{{$the->theOffice
                ->officeID}}/{{$the->theAgent->agtPhoto}}'
                style="height:75px;">
            @endif
          </div>
          <div style="float:left;">
            <div class="agentName">
              {{$the->theAgent->agtFullName}}
            </div>
            <div class="agentCompany">
              {{$the->theOffice->officeName}}
            </div>
            <div class="agentPhone">
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
  <a class="carousel-control-prev" href="#carouselControls" 
  role="button" data-slide="prev" style="z-index:2">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" 
  href="#carouselControls" role="button" data-slide="next"
  style="z-index:2;">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>