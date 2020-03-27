<div style="padding:15px;padding-top:0;">
  @include('mainInclude.errorsAndMessages')
</div>
<div style="padding:30px;border:1px solid #e3e1de;
margin-left:15px;margin-right:15px;">
  <div style="padding-bottom:5px;text-align:center;
  font-weight:bold;color:#666;font-size:14pt;">
    Listed By:
  </div>
  @if($getFlyer[0]->theAgent->agtPhoto)
    <div style="text-align:center;">
      @if($getFlyer->first()->theAgent->theAgentCleanup)
        <img height="150"
        src="/agentPhotos/{{$getFlyer[0]->theAgent->theAgentCleanup
          ->newRemID}}/{{$getFlyer[0]->theAgent->agtPhoto}}">
      @else
        <img height="150"
        src="http://www.realtyemails.com/HQoffice/{{$getFlyer->first()
          ->theOffice->officeID}}/{{$getFlyer->first()->theAgent->agtPhoto}}">
      @endif
    </div>
  @endif
  <div style="text-align:center;">
     <h3>{{$getFlyer[0]->theAgent->agtFullName}}</h3>
  </div>
  <div class="row">
    <div class="col-lg-12" style="text-align:center;">
        <div>
           {{$getFlyer[0]->theOffice->officeName}}
        </div>
        <div>
          {{$getFlyer[0]->theAgent->agtMainPhone}}
        </div>
        <div>
           {{$getFlyer[0]->theAgent->agtWebsite}}
        </div>
    </div>
    @if($getFlyer[0]->theAgent->agtLogo)
      <div class="col-lg-12" style="text-align:center;margin-top:20px;">
        <img width="155" src="/officeLogos/{{$getFlyer[0]->theOffice->officeID}}/{{$getFlyer[0]->theAgent->agtLogo}}">
      </div>
    @endif
  </div>
</div>
<div style="background:#f3f0ed;padding:30px;margin-left:15px;margin-right:15px;border:1px solid #e3e1de;">
  <h5 style="color:#666;" >Send a Message to {{$getFlyer[0]->theAgent->agtFullName}}</h5>
  <form action="/emailAgentPost?msg={{$getFlyer[0]->theMeta->sk1}}"
  method="post">
    {{csrf_field()}}
    <!--
    //for v3
    <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response"/>
    <input type="hidden" name="action" value="validate_captcha"/>
    -->
    <div width="100%;">
      <div style="padding-bottom:5px;">
        <input class="form-control"
        placeholder="Your Name"
        name="senderName"
        type="text"
        autocomplete="off"
        value="{{old('senderName')}}"
        />
      </div>
      <div style="padding-bottom:5px;">
        <input class="form-control"
        placeholder="Email"
        name="senderEmail"
        type="text"
        autocomplete="off"
        value="{{old('senderEmail')}}" />
      </div>
      <div>
        <textarea class="form-control"
        style="width:100%;height:100px;"
        name="theMsg"
        placeholder="Your Message">{{old('theMsg')}}</textarea>
      </div>
      <div>
        <div class="g-recaptcha" style="transform:scale(.75)"
        data-sitekey="6LfSH4kUAAAAADvUZitB5GPueUtXiSL0SBZKcCPR">
        </div>
      </div>
      <div style="padding-top:5px;">
        <input class="form-control button btn-flat"
        type="submit">
      </div>
    </div>
  </form>
</div>
