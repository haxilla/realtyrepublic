<!-- The Modal -->
<div class="modal" id="agentWallModal">
  <div class="modal-dialog" style="max-width:80% !important;border-radius:0 !important;
  max-height:none !important;height:100% !important;margin:0 auto;">
    <div class="modal-content" style="height:100% !important;
    -webkit-border-radius: 0px !important;
    -moz-border-radius: 0px !important;
    border-radius: 0px !important;">
      <!-- Modal Header -->
      <div class="modal-header" style="color:#fff;width:100%;background:#223e94;
      border-radius:0;">
        <div style="display:inline-block;">
          <h4 id="ajaxAgentPhoto" style="margin-right:25px;">
          </h4>
        </div>
        <div>
          <div style="display:inline-block;">
            <h4 id="ajaxAgentName">
            </h4>
            <div id="ajaxAgentOffice">
            </div>
            <div id="ajaxOfficeAddress1" style="font-size:90%">
            </div>
            <div id="ajaxOfficeCSZ" style="font-size:90%;">
            </div>
          </div>
          <div style="display:inline-block;vertical-align:bottom;margin-left:25px;">
            <div id="ajaxAgentLogo">
            </div>
          </div>
        </div>
        <button type="button" class="close"
        data-dismiss="modal" style="color:#fff;">&times;</button>
      </div>
      <div style="color:#223e94;padding:15px;background:#efedff;">
        <div id="ajaxAgentURL" style="color:#223e94;">
        </div>
      </div>
      <!-- Modal body -->
      <div class="modal-body" style="background:#fff;color:#333;
      overflow-y:auto;padding:25px;">
        <div class="container-fluid modalMain">
          <div class="row" style="">
            <div class="col-12">
              <div class="textPrimary">
                <div style="text-decoration:underline;font-weight:bold;
                color:#223e94;margin-bottom:15px;">
                  Contact
                </div>
                <div>
                  <div class="inlineBlock marginRight15">
                    <span class="ti-mobile"></span>
                  </div>
                  <div class="inlineBlock">
                  </div>
                </div>
                <div>
                </div>
                <div>
                  <div class="inlineBlock marginRight15">
                    <span class="ti-email"></span>
                  </div>
                  <div class="inlineBlock">
                    <a class="textPrimary"
                    href="#agentModalEmail">Send Email</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div style="color:#223e94;text-decoration:underline;
              font-weight:bold;margin:15px 0;margin-top:30px;">
                Most Recent Listings
              </div>
            </div>
          </div>
          <div id="ajaxAgentListings" class="row">
          </div>
          <div id="agentModalEmail" class="row" name="agentModalEmail">
            @if($errors->any())
              <div class="col-12" style="padding-bottom:0;margin-bottom:0;">
                  <div class="alert alert-danger" style="text-align:center;margin-bottom:0;">
                    <h4>{{$errors->first()}}</h4>
                  </div>
              </div>
            @endif
            <div class="col-12">
              <div style="background:#efedff;padding:35px;margin-top:30px;">
                <div id="ajaxSendAgentMessage" style="color:#223e94;margin-bottom:15px;
                font-weight:bold;font-size:125%;">
                </div>
                <div class="alert alert-danger">
                </div>
                <form id="ajaxAgentModalForm" action="" method="post">
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
                    style="display:inline-block;">
                    </div>
                  </div>
                  <div style="text-align:center;">
                    <input type="submit"
                    style="display:inline-block;border:1px solid #d3d3d3;
                    width:300px;text-align:center;border-radius:3px;padding:10px 0;
                    background:#f9f9f9;box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.08);
                    -webkit-box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.08);"
                    id="ajaxAgentModalSubmit">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="container-fluid modalContactSuccess" style="display:none;">
          <div class="row">
            <div class="col-12" style="color:#223e94;text-align:center;
            padding:25px;">
              Your Message Was Sent Successfully!
            </div>
            <div class="col-12" style="text-align:center;">
              <button type="button"
              data-dismiss="modal"
              id="agentWallContactSuccessButton"
              style="border:1px solid #eee;background:#223e94;
              padding:10px 20px;border-radius:2em;color:#fff;">
                OK!
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal footer
      <div class="modal-footer">
        <button type="button" class="btn btn-danger"
        data-dismiss="modal">Close
        </button>
      </div>
      -->
    </div>
  </div>
</div>
