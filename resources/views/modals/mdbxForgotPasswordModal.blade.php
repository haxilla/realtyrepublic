<div class="modal fade" id="mdbxForgotPassword" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content no 1-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center form-title">Password Reset</h4>
      </div>
      <div class="modal-body padtrbl">
        <div class="login-box-body">
          <div class="form-group">
            <form action="/mdbx/mdbxPasswordResetPost" method="POST">
              {{csrf_field()}}
             <div class="form-group has-feedback"> <!-- username -->
                  <input class="form-control" placeholder="Username"
                  id="xxAgtUname" type="text"
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
              <div class="row">
                  <div class="col-xs-12">
                      <button type="submit" name="submit"
                      class="btn btn-green btn-block btn-flat">Send Password Reset Email</button>
                  </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
