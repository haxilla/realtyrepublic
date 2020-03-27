<div style="color:#fff;">
  <div class="row">
    <div class="col-lg-4 noPad">
      <div>
        <div style="text-align:center;padding-top:35px;">
          <img src="/images/remLogo12.png" style="max-height:75px;">
        </div>
        <div style="text-align:center;padding-top:60px;">
          <h1 style="font-size:20pt">
            <span style="color:rgba(255,255,255,.8);
            font-weight:bold;" 
            class="font-Lora">Online</span> Real Estate Flyers
          </h1>
          <h2 style="font-size:18pt;"> 
             <span class="font-Lora"
             style="color:rgba(255,255,255,.8);font-weight:bold;">
                &
              Custom</span> Property Websites!
          </h2>
          <h5 style="padding-top:20px;">
            Email Thousands of 
            <span style="color:rgba(255,255,255,.8);
            font-weight:bold;" class="font-Lora">
              Local Agents
            </span>
          </h5>
          <h5>
            <span class="font-Lora"
            style="font-weight:bold;color:rgba(255,255,255,.8)">
              Share
            </span> on Social Media
          </h5>
          <h4 style="font-weight:bold;padding-top:20px;"
          class="h4-responsive font-Lora">
            + More!
          </h4>
        </div>
      </div>
      <div style="width:100%;position:absolute;bottom:0;padding-top:30px;padding-bottom:30px;">
        <div style="text-align:center;">
          <h6>
            Free Trial!
          </h6>
        </div>
        <div style="text-align:center;">
          @include('mdbxPublic.includes.elements.emailFormButton')
          <input type="submit" value="Create Flyer" style="border-radius:2em;
          padding:5px 20px;background:rgba(0,0,0,.3);color:#fff;
          border:1px solid #fff;margin-top:10px;">
        </div>
      </div>
    </div>
    <div class="col-lg-8 noPad">
      <div  style="border:15px solid rgba(0,0,0,.4)">
        <div id="carouselControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" style="border-bottom:1px solid rgba(0,0,0,.4)">
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
                <div class="image425hContainer" style="position:relative;">
                  <img class="d-block w-100 image425h"
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
          role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" 
          href="#carouselControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
