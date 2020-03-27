<div class="modal fade" id="emailConfirmedModal" role="dialog">
  <div class="modal-dialog autoWidthModal">
    <!-- Modal content no 1-->
    <div class="modal-content">
      <div class="modal-header" style="background:#223e94;border-radius:0;">
          <img src="/images/remLogoO.png" style="max-height:45px">
          <button type="button" class="close" data-dismiss="modal" 
          style="color:#fff;">
              &times;
          </button>
      </div>
      <div class="modal-body">
          <div>
            <div class="alert alert-warning print-error-msg" 
            style="display:none;margin:5px;padding:25px;">
              <ul></ul>
            </div>
            <form action="/trialPendingAddress" method="POST"
            id="pendingTrialAddressForm">
              {{csrf_field()}}
              <div style="padding:15px;padding-top:5px;">
                <h3 style="color:#223e94;font-weight:bold;margin:0;padding:0;">
                  Success! Your E-mail has been confirmed
                </h3>
              </div>
              <div style="padding:25px;padding-top:5px;padding-bottom:5px;
              text-align:center;">
                <div>
                  Enter the Address or MLS# of the home you want to make
                </div>
                <div>
                  an e-flyer for and we will send a notice when it's ready!
                </div>
              </div>
              <div class="form-group has-feedback"
              style="padding:25px;padding-bottom:15px;">
                <input class="form-control" placeholder="Address"
                id="pendingTrialAddressInputModal" type="text"
                name="pendingTrialAddress" style="height:50px;" autocomplete="off"
                value="{{old('pendingTrialAddress')}}" required/>
                <input type="hidden" name="pendingTrialKey" value="">
              </div>
              <div style="text-align:center;margin-top:5px;margin-bottom:5px;">
                @include('mdbxPublic.includes.elements.captchav2')
              </div>
              <div style="text-align:center;margin-bottom:10px;cursor:pointer;"
              class="pendingTrialAddressSubmit">
                @include('mdbxPublic.includes.elements.solidBlueSubmitOnly')
              </div>
            </form>
            <div id="pendingTrialAddressSuccessDiv" style="display:none;">
              <div style="padding:25px;">
                <h3 style="color:#223e94;font-weight:bold;margin:0;padding:0;">
                  Thank You! Your information has been received.
                </h3>
                <div style="padding:15px;">
                  You will receive an email with login instructions when your flyer is ready!
                </div>
                <div style="text-align:center;">
                  <button type="button" 
                  data-dismiss="modal"
                  style="border:1px solid #eee;background:#223e94;
                  padding:10px 20px;border-radius:2em;color:#fff;">
                    OK!
                  </button>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
