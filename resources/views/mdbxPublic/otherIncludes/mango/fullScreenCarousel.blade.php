<div>
  <div id="carouselControls" class="carousel slide" 
  data-ride="carousel">
    <div class="carousel-inner borderTop1em">
      @foreach($newAdds as $the)
        <div class="carousel-item 
          @if($loop->iteration===1)
            active
          @endif">
          <div class="background-transBlack6 padding15 text-white">
            <div style="float:left;">
              <span style="font-weight:bold;color:#c19928;margin-right:15px;
              background:rgba(0,0,0,.5);padding:5px;padding-left:15px;padding-right:15px;
              border-radius:15px;">
                  JUST EMAILED!
              </span>
              {{$the->xFullStreet}} - {{$the->xCity}}, {{$the->xState}} {{$the->xxZip}}
            </div>
            <div style="float:right;padding-right:15px;font-weight:bold;">
              ${{number_format($the->xListPrice)}}
            </div>
            <div style="clear:both;">
            </div>
          </div>
          <div class="image475hContainer">
            <img class="d-block w-100 image475h"
            src="/hqphotos/{{$the->theMeta->zipDir}}/{{$the->theMeta
              ->mlsDir}}/{{$the->thePhotos->where('def','=','1')
              ->first()->photoName}}"
              alt="{{$the->xFullStreet}} Main">
          </div>
          <div class="background-transBlack6 padding15 text-white">
            <div style="float:left;font-weight:bold;color:#c19928;padding:5px;
            padding-left:15px;padding-right:15px;">
              Listed By:
            </div>
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
            <div style="float:right;padding-right:15px;margin:0 auto;">
              <button style="border-radius:15px;border:none;
              padding-left:15px;padding-right:15px;">
                MORE INFO
              </button>
            </div>
            <div style="clear:both;">
            </div>
          </div>
        </div>
      @endforeach
      <!-- END LOOP 1 -->
    </div>
    <a class="carousel-control-prev" href="#carouselControls" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselControls" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
