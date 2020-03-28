<div class="modal fade" id="login" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content no 1-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center form-title">Login</h4>
      </div>
      <div class="modal-body padtrbl">

        <div class="login-box-body">
          @if($errors->first())
            <div style="padding:10px;
            border:1px solid #900;
            font-size:9pt;
            margin:10px;
            color:#900;">
              {{ $errors->first()}}
            </div>
          @else
            <p class="login-box-msg">Sign in to start your session</p>
          @endif
          <div class="form-group">
            <form action="/member/login" method="POST">
              {{csrf_field()}}
             <div class="form-group has-feedback"> <!-- username -->
                  <input class="form-control" placeholder="Username"
                  id="agtUname" type="text"
                  name="agtUname" autocomplete="off"/>
                  <span style="display:none;font-weight:bold;
                  position:absolute;color:red;position:absolute;
                  padding:4px;font-size: 11px;
                  background-color:rgba(128, 128, 128, 0.26);
                  z-index:17;right:27px;top:5px;"
                  id="span_loginid">
                  </span>
                  <span class="glyphicon glyphicon-user form-control-feedback">
                  </span>
              </div>
              <div class="form-group has-feedback"><!-- password -->
                  <input class="form-control" placeholder="Password" name="password"
                  id="xAgtPswd" type="password" autocomplete="off" />
                  <span style="display:none;font-weight:bold; position:absolute;color: grey;position: absolute;padding:4px;font-size: 11px;background-color:rgba(128, 128, 128, 0.26);z-index: 17;  right: 27px; top: 5px;" id="span_loginpsw">
                  </span><!-- Already exists   -->
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              </div>
              <div class="row">
                  <div class="col-xs-12">
                      <div class="checkbox icheck">
                          <label>
                            <input name="rememberMe"
                            type="checkbox"
                            id="loginrem">
                              Remember Me
                          </label>
                      </div>
                  </div>
                  <div class="col-xs-12">
                      <button type="submit" name="submit"
                      class="btn btn-green btn-block btn-flat">Sign In</button>
                  </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="modal-footer">
          <a href="#" data-dismiss="modal" data-toggle="modal"
          data-target="#mdbxForgotPassword" style="font-size:1rem;color:#900;">
          Forgot Password?
        </a>
      </div>
    </div>
  </div>
</div>
