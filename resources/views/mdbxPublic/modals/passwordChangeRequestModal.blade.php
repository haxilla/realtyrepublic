<div class="modal fade" id="passwordChangeRequestModal" role="dialog">
  <div class="modal-dialog">
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
            <form action="/passwordRequest" method="POST">
              {{csrf_field()}}
              @if($errors->any())
                <div style="padding-bottom:15px;color:#900;" class="showErrors">
                  Error Processing your request...
                </div>
                <div class="alert alert-danger showErrors">
                  <ul style="padding:0;margin:0;">
                    @foreach ($errors->all() as $error)
                      <li>{!! $error !!}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
              <div style="padding:15px;padding-top:5px;">
                Enter your username below & submit to reset your password
              </div>
              <div class="form-group has-feedback"> <!-- username -->
                  <input class="form-control" placeholder="Username"
                  id="forgotPswdModalAgtUname" type="email"
                  name="agtUname" style="height:50px;" autocomplete="off"
                  value="{{old('agtUname')}}" required/>
                  <span style="display:none;font-weight:bold;
                  position:absolute;color:red;position:absolute;
                  padding:4px;font-size: 11px;
                  background-color:rgba(128, 128, 128, 0.26);
                  z-index:17;right:27px;top:5px;"
                  id="span_loginid">
                  </span>
              </div>
              <div style="text-align:center;margin-top:5px;margin-bottom:5px;">
                @include('mdbxPublic.includes.elements.captchav2')
              </div>
              <div style="text-align:center;margin-bottom:10px;">
                @include('mdbxPublic.includes.elements.solidBlueResetPassword')
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
