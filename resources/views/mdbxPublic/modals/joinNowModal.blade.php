<div class="modal fade" id="joinNowModal"
tabindex="-1" role="dialog" aria-labelledby="joinNowModal" aria-hidden="true">
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
                <div class="joinNowModalSuccessMessage" style="display:none;">
                    @include('mdbxPublic.modals.modalParts.joinNowSuccessMessage')
                </div>
                <div class="joinNowModalLargeLoader" style="display:none;">
                    @include('mdbxPublic.modals.modalParts.loadingMessage')
                </div>
                <div style="background-color:#ebebeb;padding:25px;"
                class="joinNowModalFullBody">
                    @include('mdbxPublic.modals.modalParts.joinNowFormBody')
                </div>
                <div style="text-align:center;padding:15px;
                display:none;padding-bottom:5px;" 
                class="joinNowModalForgotPasswordDiv">
                    <a href="#" data-dismiss="modal" data-toggle="modal"
                    id="joinNowModalForgotPassword"
                    data-target="#passwordChangeRequestModal" style="color:#666;
                    font-size:9pt;">
                        Forgot Password?
                    </a>
                </div>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
