<div id="carouselControls" 
class="carousel slide" 
data-ride="carousel">
  <div class="carousel-inner">
    @foreach($newAdds as $the)
      <div class="carousel-item 
        @if($loop->iteration===1)
          active
        @endif" style="z-index:1;">
        <div class="row">
          <div class="col-lg-2 noPad"
          style="text-align:center;background:rgba(0,0,0,.8);
          color:#fff;padding:25px;">
            <div style="font: 400 50px/1.3 'Pacifico',Helvetica,
            sans-serif;color: #fff;text-shadow: 1px 1px 0px #ededed, 
            4px 4px 0px rgba(0,0,0,0.15);">
              Featured Home
            </div>
            <div class="text-bold">
              {{$the->xFullStreet}}
            </div>
            <div>
              {{$the->xCity}}, {{$the->xState}} {{$the->xxZip}}
            </div>
          </div>
          <div class="col-lg-8 noPad">
            <div class="image500hContainer">
              <img class="d-block w-100 image500h"
              src="/hqphotos/{{$the->theMeta->zipDir}}/{{$the->theMeta
                ->mlsDir}}/{{$the->thePhotos->where('def','=','1')
                ->first()->photoName}}"
                alt="{{$the->xFullStreet}} Main">
            </div>
          </div>
          <div class="col-lg-2 noPad">
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
        </div>
      </div>
    @endforeach
  </div>
</div>