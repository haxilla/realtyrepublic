<div id="carouselControls" class="carousel slide" 
data-ride="carousel">
  <div class="carousel-inner">
    <!-- LOOP 1 -->
    @foreach($newAdds as $the)
    <div class="carousel-item 
    @if($loop->iteration===1)
      active
    @endif">
      <div class="padding10 inlineBlock font-Lora">
        <hr class="marginBottom10">
        <span class="text-remGreen text-bold marginRight15">Featured Home:</span> 
        {{$the->xFullStreet}} - {{$the->xCity}}, {{$the->xState}} {{$the->xxZip}}
        <span class="text-remGreen marginLeft15 text-bold">
          ${{number_format($the->xListPrice)}}
        </span>
      </div>
      <div class="row">
        <div class="col-lg-9 noPad">
          <div class="image500hContainer">
            <img class="d-block w-100 image500h borderWhite1 borderRightNone" 
            src="/hqphotos/{{$the->theMeta->zipDir}}/{{$the->theMeta
              ->mlsDir}}/{{$the->thePhotos->where('def','=','1')
              ->first()->photoName}}"
              alt="{{$the->xFullStreet}} Main">
          </div>
          <div class="carouselAgentDiv">
            @if($the->theAgent->agtPhoto)
              <div class="img-circle">
                  @if($the->theAgent->theAgentCleanup)
                      <img class="rounded-circle carouselAgentImg"
                      src='/agentPhotos/{{$the->theAgent->theAgentCleanup
                        ->newRemID}}/{{$the->theAgent->agtPhoto}}'>
                  @else
                      <img class="rounded-circle carouselAgentImg" 
                      src='http://www.realtyemails.com/HQoffice/{{$the->theOffice
                        ->officeID}}/{{$the->theAgent->agtPhoto}}'>
                  @endif
              </div>
            @endif
            <div class="carouselAgentContact">
              <div class="carouselAgentName">
                {{$the->theAgent->agtFullName}}
              </div>
              <div class="carouselAgentField">
                  {{$the->theOffice->officeName}}
              </div>
              <div class="carouselAgentField">
                  {{$the->theAgent->agtMainPhone}}
              </div>
            </div>
            <div style="clear:both;">
            </div>
          </div>
        </div>
        <div class="col-lg-3 noPad">
          @foreach($the->thePhotos->where('def','=','0')->take(2) as $t)
            <div class="image250hContainer">
              <img class="d-block w-100 borderWhite1 image250h
              @if($loop->iteration===1)
                borderBottomNone
              @endif" 
              src="/hqphotos/{{$the->theMeta->zipDir}}/{{$the->theMeta
                ->mlsDir}}/{{$t->photoName}}"
                alt="{{$t->photoName}}">
            </div>
          @endforeach
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