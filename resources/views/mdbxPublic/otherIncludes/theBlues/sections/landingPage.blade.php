<div style="color:rgba(255,255,255,.9);">
  <div class="row" style="min-height:100vh;position:relative;">
    <div class="col-lg-5">
      <div class="landingPageLeft">
        <h1 style="font-size:170%;padding:5%;padding-bottom:0;padding-top:0;">
          <span class="gradientText text-bold">DAZZLING</span> Online Real Estate Flyers 
          & Custom Property Websites
        </h1>
        <p style="font-size:135%;padding:5%">
           Get Your Listing NOTICED!
        </p>
        <div style="font-size:115%;padding:5%;padding-top:0;">
          <ul>
            <li>
              Email Thousands of Local Agents!
            </li>
            <li>
              Share on Social Media Sites
            </li>
            <li>
              Print Brochures
            </li>
            <li>
              Track Progress
            </li>
          </ul>
        </div>
        <div style="padding:25px;">
          <div style="text-align:center;">
            <div>
              <h6>
                <div>
                  <i class="fas fa-magic gradientText" 
                  style="margin-right:10px;"></i>
                  <span class="gradientText">Auto Create in Minutes!</span>
                </div> 
                <div>
                  With just an Address & Email!
                </div>
              </h6>
            </div>
            <div style="margin-top:15px;">
              <input type="submit" value="Create FREE Flyer!" style="border-radius:2em;
              padding:15px 30px;background:#900;color:#fff;
              border:3px solid #fff;">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-7">
      <div class="landingPageRight">
        <div id="carouselControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            @foreach($newAdds as $the)
              <div class="carousel-item 
                @if($loop->iteration===1)
                  active
                @endif" style="z-index:1;border:3px solid rgba(255,255,255,.5)">
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
      </div>
    </div>
    <!--
    <div class="row">
      <div style="background:rgba(0,0,0,.4);width:100%;
      position:absolute;bottom:0;left:0;padding:25px 0">
        <div class="col-lg-5">
          <div>
            <div style="text-align:center;">
              <h6>
                <i class="fas fa-magic" style="margin-right:10px;"></i>
                Auto Import Your Listing if its already online!
              </h6>
            </div>
            <div style="text-align:center;">
              @ include('mdbxPublic.includes.elements.emailFormButton')                            @ include('mdbxPublic.includes.elements.addressFormButton')
              <input type="submit" value="Create Flyer" style="border-radius:2em;
              padding:5px 20px;background:#900;color:#fff;
              border:1px solid #fff;margin-top:10px;">
            </div>
          </div>
        </div>
        <div class="col-lg-6">
        </div>
      </div>
    </div>
    -->
  </div>
</div>
