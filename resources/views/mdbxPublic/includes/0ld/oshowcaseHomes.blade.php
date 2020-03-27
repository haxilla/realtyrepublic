<div style="text-align:center;padding:50px">
    <h1>
        FEATURED LISTINGS
    </h1>
</div>
<div class="banner">
    <div class="container">
        <div id="carouselControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            @foreach($newAdds as $the)
            @if($the->thePhotos->first())
            <div class="carousel-item
            @if($loop->iteration===1)
            active
            @endif"
            style="background-image:url('/hqphotos/{{$the->theMeta
            ->zipDir}}/{{$the->theMeta->mlsDir}}/{{$the->thePhotos
            ->where('def','=','1')->first()->photoName}}');">
            <div class="captionAgent">
            @if($the->theAgent->agtPhoto)
                <div class="agentPhoto img-circle">
                    @if($the->theAgent->theAgentCleanup)
                        <img class="img-circle"
                        src='/agentPhotos/{{$the->theAgent->theAgentCleanup->newRemID}}/{{$the->theAgent->agtPhoto}}'
                        style="height:75px;">
                    @else
                        <img class="img-circle" src='http://www.realtyemails.com/HQoffice/{{$the->theOffice->officeID}}/{{$the
                        ->theAgent->agtPhoto}}' style="height:75px;">
                    @endif
                </div>
            @endif
            <div class="agentName">
                {{$the->theAgent->agtFullName}}
            </div>
            <div class="agentCompany">
                {{$the->theOffice->officeName}}
            </div>
            <div class="agentPhone">
                {{$the->theAgent->agtMainPhone}}
            </div>
            <a href="/propInfo?id={{$the->theMeta->sk1}}">
                <button class="carouselMoreInfo">
                    More Info
                </button>
            </a>
            </div>
            <div class="webAdded">
                Added {{ $the->creationDate->diffForHumans() }}
            </div>
            <div class="captionHeadline">
            <div class="fulladdress">
            <div class="address">
            {{ $the->xFullStreet}} - {{$the->xCity}} , {{$the->xState}} @if($the->xZip){{$the->xZip}}@else{{$the->xxZip}}@endif
            </div>
            <div class="addrDetails">
            @if($the->xBeds)
            {{$the->xBeds}}
            @else
            {{$the->xxBeds}}
            @endif Bedrooms,
            @if($the->xBaths)
            {{$the->xBaths}}
            @else
            {{$the->xxBaths}}
            @endif Baths -
            @if($the->xSqft)
            {{$the->xSqft}}
            @else
            {{$the->xxSqft}}
            @endif Sqft.
            </div>
            </div>
            <div class="listPrice">
            ${{number_format($the->xListPrice)}}
            </div>
            <div style="clear:both;">
            </div>
            </div>
            </div>
            @endif
            @endforeach
          </div>
          <a class="carousel-control-prev" href="#carouselControls" 
          role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselControls" 
          role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
    </div>
</div>