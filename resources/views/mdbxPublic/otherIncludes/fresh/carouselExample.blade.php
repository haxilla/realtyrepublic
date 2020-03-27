<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <!-- LOOP 1 -->
    @foreach($newAdds as $the)
    <div class="carousel-item 
    @if($loop->iteration===1)
      active
    @endif">
      <div style="display:inline-block;padding:10px;font-family:Lora;">
        <hr style="margin:0;margin-bottom:10px;">
        <span style="color:#090;font-weight:bold;margin-right:15px;">Featured Home:</span> 
        {{$the->xFullStreet}} - {{$the->xCity}}, {{$the->xState}} {{$the->xxZip}}
        <span style="color:#090;margin-left:15px;font-weight:bold;">
          ${{number_format($the->xListPrice)}}
        </span>
      </div>
      <div class="row">
        <div class="col-lg-9" style="padding:0;position:relative;">
          <img class="d-block w-100" style="height:500px;border:1px solid #fff;
          border-right:none;object-fit:cover;" 
          src="/hqphotos/{{$the->theMeta->zipDir}}/{{$the->theMeta->mlsDir}}/{{$the
            ->thePhotos->where('def','=','1')->first()->photoName}}"
          alt="First slide">
            <div style="position:absolute;top:-60px;right:0;text-align:center;
        background:rgba(255,255,255,.75);z-index:600;border:1px solid #fff;
        border-right:none;border-bottom-left-radius:1em;">
          <div style="font-weight:bold;color:#3F4A3C;">
            @if($the->theAgent->agtPhoto)
              <div class="agentPhoto img-circle"
              style="margin-top:10px;margin-bottom:10px;">
                  @if($the->theAgent->theAgentCleanup)
                      <img class="rounded-circle"
                      src='/agentPhotos/{{$the->theAgent->theAgentCleanup->newRemID}}/{{$the->theAgent->agtPhoto}}'
                      style="height:75px;">
                  @else
                      <img class="img-circle" src='http://www.realtyemails.com/HQoffice/{{$the->theOffice->officeID}}/{{$the
                      ->theAgent->agtPhoto}}' style="height:75px;">
                  @endif
              </div>
            @endif
            <div style="padding:5px;">
              <div class="agentName" style="background:rgba(255,255,255,.5);
              padding:10px;padding-bottom:0;padding-top:0;">
                {{$the->theAgent->agtFullName}}
              </div>
              <div class="agentCompany" style="background:rgba(255,255,255,.5);padding:5px;
              padding-bottom:0;padding-top:0">
                  {{$the->theOffice->officeName}}
              </div>
              <div class="agentPhone" style="background:rgba(255,255,255,.5);padding:5px;
              padding-bottom:0;padding-top:0;border-bottom-left-radius:1em;">
                  {{$the->theAgent->agtMainPhone}}
              </div>
            </div>
            <div style="clear:both;">
            </div>
          </div>
        </div>
        </div>

        <div class="col-lg-3" style="padding:0;">
          @foreach($the->thePhotos->where('def','=','0')->take(2) as $t)
            <img class="d-block w-100" style="height:250px;
            border:1px solid #fff;object-fit:cover;
            @if($loop->iteration===1)
              border-bottom:none;
            @endif"
            src="/hqphotos/{{$the->theMeta->zipDir}}/{{$the->theMeta
              ->mlsDir}}/{{$t->photoName}}"
              alt="{{$t->photoName}}">
          @endforeach
        </div>
      </div>
    </div>
    @endforeach
    <!-- END LOOP 1 -->
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>