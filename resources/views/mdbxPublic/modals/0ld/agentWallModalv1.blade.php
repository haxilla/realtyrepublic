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
        <div style="display:inline-block;margin-right:15px;">
          <span class="ti-cup"></span>
        </div>
        <div id="ajaxMemberSince" style="display:inline-block">
        </div>
      </div>
      <!-- Modal body -->
      <div class="modal-body" style="background:#fff;color:#333;
      overflow-y:auto;padding:50px;">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-6">
              <div class="sticky-top">
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
                <div id="ajaxAgentURL" style="background:#223e94;margin-top:30px;
                color:#fff;padding:5px 10px;border-radius:2em;
                display:inline-block;">
                </div>
                <!--
                <div style="text-decoration:underline;font-weight:bold;
                color:#223e94;margin:15px 0;">
                  Network
                </div>
                <div>
                  Join <span id="ajaxAgentJoin"></span> Network
                </div>
                <div>
                  Stay updated on latest listings & blog posts
                </div>
                <div style="margin-top:15px;">
                  @ include('mdbxPublic.includes.elements.solidBlueConnect')
                </div>
                -->
              </div>
            </div>
            <div class="col-lg-6">
              <div style="color:#223e94;text-decoration:underline;
              font-weight:bold;margin-bottom:15px;">
                Most Recent Listings
              </div>
              <div id="ajaxAgentListings">
              </div>
            </div>
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
