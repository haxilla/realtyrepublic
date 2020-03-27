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
        <div class="container-fluid">
          <div class="row" style="">
            <div class="col-12">
              <div>
                <div style="text-decoration:underline;font-weight:bold;
                color:#223e94;margin-bottom:15px;">
                  Contact
                </div>
                <div style="color:#223e94;">
                  <div style="display:inline-block;color:#223e94;margin-right:15px;">
                    <span class="ti-mobile"></span>
                  </div>
                  <div id="ajaxAgentMainPhone" style="display:inline-block">
                  </div>
                </div>
                <div id="ajaxAgentWebsite" style="color:#223e94;">
                </div>
                <div>
                  <div style="display:inline-block;color:#223e94;margin-right:15px;">
                    <span class="ti-email"></span>
                  </div>
                  <div style="display:inline-block;">
                    <a style="color:#223e94;" href="">Send Email</a>
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
        </div>
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" 
        data-dismiss="modal">Close
        </button>
      </div>

    </div>
  </div>
</div>
