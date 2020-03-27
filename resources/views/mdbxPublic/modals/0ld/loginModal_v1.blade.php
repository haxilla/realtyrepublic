<div class="modal fade" id="loginModal"
tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
    <div class="modal-dialog autoWidthModal" role="document">
        <!--Content-->
        <div class="modal-content text-center" style='border-radius:0;'>
            <!--Header-->
            <div class="modal-header" style="background:#223e94;border-radius:0;">
                <img src="/images/remLogoO.png" style="max-height:45px">
                <button type="button" class="close" data-dismiss="modal" 
                style="color:#fff;">
                    &times;
                </button>
            </div>
            <!--Body-->
            <div class="modal-body">
                <div style="background-color:#ebebeb;padding:25px;padding-bottom:15px;">
                    <div class="alert alert-warning loginModalError"
                    style="margin-bottom:0;display:none;">
                        <ul style="padding:0;margin:0;padding-left:1.5em;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="loginModalMessage">
                        <h6 style="margin:0;padding:0;color:#223e94;">
                            Sign in to start your session
                        </h6>
                    </div>
                    <div style="padding-top:25px;">
                        @include('mdbxPublic.includes.forms.memberLoginForm')
                    </div>
                </div>
            </div>
            <div style="text-align:center;padding:15px;padding-top:0;">
                <a href="#" data-dismiss="modal" data-toggle="modal"
                id="forgotPasswordModalIndex"
                data-target="#passwordChangeRequestModal" style="color:#666;
                font-size:9pt;">
                    Forgot Password?
                </a>
            </div>
        </div>
    </div>
</div>
