<div class="row" style="color:#fff;">
  <div 
  @if(strpos($theme,'wideFormat')!==false)
    class="col-lg-5" 
  @else
    class="col-lg-4"
  @endif
  style="margin:auto;">
    <div class="row">
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-1">
          <i class="fa fa-2x fa-bolt"
          style="color:#808080"></i>
      </div>
      <div class="col-lg-10 col-md-10 col-sm-10 col-xs-11">
        <div>
            <h5 class="font-weight-bold"
            style="color:#fff;">
                Auto Import
            </h5>
        </div>
        <div style="font-family:Lora;padding:25px;padding-top:0;
        padding-bottom:50px;">
            If its already online, just enter an address or MLS#
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-1">
          <i class="fa fa-2x fa-envelope"
          style="color:#808080"></i>
      </div>
      <div class="col-lg-10 col-md-10 col-sm-10 col-xs-11">
          <div>
              <h5 class="font-weight-bold"
              style="color:#fff">
                  Email & Text
              </h5>
          </div>
          <div style="font-family:Lora;padding:25px;padding-top:0;
          padding-bottom:50px;">
              Distribute to THOUSANDS of Interested Local Agents & Homebuyers!
          </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-1">
          <i class="fa fa-2x fa-users"
          style="color:#808080"></i>
      </div>
      <div class="col-lg-10 col-md-10 col-sm-10 col-xs-11">
          <div>
              <h5 class="font-weight-bold"
              style="color:#fff;">
                  Social Media
              </h5>
          </div>
          <div style="font-family:Lora;padding:25px;padding-top:0;
          padding-bottom:50px;">
              Share on Facebook, Twitter, Pinterest & more!
          </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12" style="text-align:center;">
        <div style="background-image: linear-gradient(to right bottom,#00c896,
        #00c398,#00bf9a,#00ba9b,#00b59c,#00b19c,#00ac9c,#00a89c,#00a39c,#009e9b, 
        #00999a,#009498);color:#F2ECFF;padding:25px;padding-right:35px;
        padding-left:35px;border-radius:1em;display:inline-block;font-weight:bold;
        cursor:pointer;"
        class="hoverable z-depth-2">
          GET STARTED!
        </div>
      </div>
    </div>
  </div>
  <div class="
  @if(strpos($theme,'wideFormat')!==false)
    col-lg-7
  @else
    col-lg-8 
  @endif
  marginBottom25" style="margin-top:10px;">
    <div id="carouselControls" class="carousel slide" 
    data-ride="carousel">
      <div class="carousel-inner borderRadiusTop1em">
        @foreach($newAdds as $the)
          <div class="carousel-item 
            @if($loop->iteration===1)
              active
            @endif">
            <div>
              <div class="text-white background-transBlack6">
                <div style="float:left;">
                  @if(strpos($theme,'largerShare')!==false)
                    <div style="padding:15px;padding-left:25px;
                    border-radius:.5em;margin:15px;text-align:center;padding-right:0;
                    padding-top:10px;padding-bottom:10px;font-size:125%;color:#F2ECFF">
                      <i class="fa fa-heart-o marginRight25" 
                      aria-hidden="true"></i>
                      <i class="fa fa-share-alt-square marginRight25" 
                      aria-hidden="true"></i>
                      <i class="fa fa-print marginRight25" 
                      aria-hidden="true"></i>
                    </div>
                  @endif
                </div>
                <div style="float:right">
                  <div style="font-size:130%;font-weight:bold;padding-top:15px;padding-right:20px;">
                    {{$the->xFullStreet}}
                  </div>
                  <div style="text-align:right;padding-right:20px;padding-bottom:10px;">
                    {{$the->xCity}}, {{$the->xState}} {{$the->xxZip}}
                  </div>
                </div>
                <div style="clear:both;">
                </div>
              </div>
              <div class="image350hContainer" style="position:relative;">
                <div class="padding5 text-white" style="position:absolute;top:0;
                background:rgba(0,0,0,.5);width:100%;">
                  @if(strpos($theme,'smallerShare')!==false)
                    <div style="float:left;padding-left:15px;">
                      <i class="fa fa-heart-o marginRight25" 
                      aria-hidden="true"></i>
                      <i class="fa fa-share-alt-square marginRight25" 
                      aria-hidden="true"></i>
                      <i class="fa fa-print marginRight25" 
                      aria-hidden="true"></i>
                    </div>
                  @endif
                  <div style="float:right;padding-right:15px;font-weight:bold;">
                      ${{number_format($the->xListPrice)}}
                  </div>
                  <div style="clear:both;">
                  </div>
                </div>
                <img class="d-block w-100 image350h"
                src="/hqphotos/{{$the->theMeta->zipDir}}/{{$the->theMeta
                  ->mlsDir}}/{{$the->thePhotos->where('def','=','1')
                  ->first()->photoName}}"
                  alt="{{$the->xFullStreet}} Main">
              </div>
              <div class="padding15 text-white background-transBlack6">
                <div style="float:left;">
                  <div style="float:left;font-weight:bold;color:#00C896;
                  padding:5px;padding-left:15px;padding-right:15px;">
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
                  <div style="clear:both;">
                  </div>
                </div>
                <div style="clear:both;">
                </div>
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
