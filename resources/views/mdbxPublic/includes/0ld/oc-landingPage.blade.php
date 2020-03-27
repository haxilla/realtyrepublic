<section style="background-image: linear-gradient(-20deg, #b721ff 0%, #21d4fd 100%);">
<div class="container-fluid" style="padding-top:80px;color:#fff;">
  <div class="row">
    <div class="col-lg-6 noPad">
      <div style="padding:60px;padding-bottom:280px;padding-top:80px;">
        <h1 style="padding-bottom:20px;">
          Digitize Your Listing
        </h1>
        <h4>
          Create Dazzling Online Real Estate Flyers
        </h4>
        <h5>
           Emailed to <i>THOUSANDS</i> of Interested Agents!
        </h5>
        <h6 style="padding-top:20px;">
          With FREE Customized Website for YOU & Your Listing!
        </h6>
      </div>
      <div style="padding:15px 60px 30px 60px;
      background:rgba(255,255,255,.4);width:100%;position:absolute;
      bottom:0;">
        <div style="padding-bottom:15px;color:#454498;font-weight:bold;">
          It's FREE to try!
        </div>
        @include('mdbxPublic.includes.elements.emailFormButton')
        @include('mdbxPublic.includes.elements.flyerAddressFormButton')
      </div>
    </div>
    <div class="col-lg-6 noPad" style="padding-top:6px;">
      <div id="carouselControls" class="carousel slide pull-right z-depth-1
      hoverable" data-ride="carousel" 
      style="max-width:600px;position:absolute;border-top-left-radius:1em;
      border-top-right-radius:1em;border:3px solid rgba(255,255,255,.4);
      cursor:pointer;">
        <div class="carousel-inner"
        style="border-top-left-radius:1em;border-top-right-radius:1em;">
          @foreach($newAdds as $the)
            <div class="carousel-item 
              @if($loop->iteration===1)
                active
              @endif">
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
              <div class="image350hContainer" style="position:relative;">
                <img class="d-block w-100 image350h"
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
  </div>
</div>
</section>