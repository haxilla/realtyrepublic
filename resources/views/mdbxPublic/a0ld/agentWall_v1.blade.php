<div class="agentWall marginBottom45">
  <div class="row noMargin backgroundPrimary">
    <div class="col-12 noPad">
      <div class="textWhite"
      style="position:sticky;top:-15px;right:5px;
      z-index:100;cursor:pointer;">
        <div class="textCenter circle20 publicOverlayClose"
        style="position:absolute;right:15px;top:30px;line-height:20px;
        background:#223e94;">
          X
        <div>
      </div>
      <div style="clear:both;">
      </div>
    </div>
  </div>
  <div class="row noMargin backgroundPrimary">
    <div class="col-12 noPad textWhite">
      <div class="agentWallBanner">
        @if($agtPhoto)
          <div class="inlineBlock agentWallPhoto">
            <img src="{{env('APP_IMGURL')}}/agentPhotos/{{$ajid}}/{{$agtPhoto}}">
          </div>
        @endif
        <div class="inlineBlock agentWallContact">
          <div class="agentWallName">
            {{$agtFullName}}
          </div>
          <div>
            {{$officeName}}
          </div>
          <div>
            {{$officeAddress}}
          </div>
          <div>
            {{$officeCSZ}}
          </div>
        </div>
        <div class="inlineBlock agentWallLogo">
          @if($agtLogo)
            <img src="{{env('APP_IMGURL')}}/officeLogos/{{$officeID}}/{{$agtLogo}}">
          @endif
        </div>
      </div>
    </div>
  </div>
  <div class="row noMargin
  backgroundSecondary padding15 textPrimary"
  style="position:sticky;top:0;z-index:1">
    RealtyEmails.com/{{$agtURL}}
  </div>
  <div class="row backgroundWhite noMargin">
    <div class="col-12">
      <div class="textPrimary">
        <div class="textUnderline textPrimary margin15-0">
          Contact
        </div>
        <div>
          <div class="inlineBlock marginRight15">
            <span class="ti-mobile"></span>
          </div>
          <div class="inlineBlock">
            {{$agtMainPhone}}
          </div>
        </div>
        <div>
          <div class="inlineBlock marginRight15">
            <span class="ti-world"></span>
          </div>
          <div class="inlineBlock">
            {{$agtWebsite}}
          </div>
        </div>
        <div>
          <div style="display:inline-block;color:#223e94;margin-right:15px;">
            <span class="ti-email"></span>
          </div>
          <div style="display:inline-block;margin-bottom:15px;">
            <a style="color:#223e94;"
            href="#agentWallEmail">Send Email</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row noMargin backgroundWhite">
    @foreach($getFlyers as $the)
    <div class="col-12 col-md-6">
      <div class="row margin15-0">
        <div class="col-12 noPad">
          <div class="textBold textPrimary">
            {{$the->xFullStreet}}
          </div>
          <div class="textSmall">
            {{$the->xCity}} {{$the->xState}} {{$the->xxZip}}
          </div>
        </div>
        <div class="col-12 col-sm-6 noPad">
          <div class="inlineBlock" style="position:relative;">
            <img src="{{env('APP_IMGURL')}}/hqphotos/{{$the
              ->theMeta->zipDir}}/{{$the->theMeta
                ->mlsDir}}/{{$the->thePhotos->first()->photoName}}"
              style="max-width:100%;">
            <div class="r-abso absoTop" style="background:rgba(0,0,0,.8);
            color:#fff;padding:3px 10px;border-bottom-right-radius:1.25em;">
              ${{number_format($the->xListPrice)}}
            </div>
            <div class="r-abso absoBotRight">
              <div style="border-top-left-radius:1.25em;padding:3px 10px;font-size:.85em;
              background:rgba(0,0,0,.8);color:#fff;">
                @if($the->xxBeds)
                  {{$the->xxBeds}} Bd
                  <span style="opacity:.5;margin:0 3px;">|</span>
                @endif
                @if($the->xxBaths)
                  {{$the->xxBaths}} Ba
                  <span style="opacity:.5;margin:0 3px;">|</span>
                @endif
                {{$the->xxSqft}} sqft
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6 noPad">
        </div>
      </div>
    </div>
    <hr style="width:100%;margin:5px 0">
    @endforeach
    <div class="col-12 noPad" style="margin-bottom:45px;"
    id="agentWallEmail">
      <div style="background:#efedff;margin-top:30px;padding:15px;">
        <div class="textPrimary fontBold fontLarger
        marginBottom15">
          Send a message to {{$agtFirst}}
        </div>
        <div class="alert alert-danger">
        </div>
        <form id="ajaxAgentModalForm" method="post">
          {{csrf_field()}}
          <div style="margin-bottom:5px;">
            <input type="text" placeholder="Your Name" class="form-control"
            name="modalName" value="{{ old('modalName') }}">
          </div>
          <div style="margin-bottom:5px;">
            <input type="text" placeholder="Your Email" class="form-control"
            name="modalEmail" value="{{old('modalEmail')}}">
          </div>
          <div style="margin-bottom:5px;">
            <textarea class="form-control" placeholder="Your Message"
            name="modalMessage">{{old('modalMessage')}}</textarea>
          </div>
          <div style="text-align:center;">
            <div class="g-recaptcha"
            data-sitekey="6LfSH4kUAAAAADvUZitB5GPueUtXiSL0SBZKcCPR"
            style="transform:scale(0.77);
            -webkit-transform:scale(0.77);
            transform-origin:0 0;
            -webkit-transform-origin:0 0;">
            </div>
          </div>
          <div style="text-align:center;">
            <input type="submit" value="Send"
            style="display:inline-block;border-radius:2em;
            background:#223e94;color:#fff;border:3px solid #fff;
            padding:5px 15px;"
            id="agtWallMsgSubmit">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
