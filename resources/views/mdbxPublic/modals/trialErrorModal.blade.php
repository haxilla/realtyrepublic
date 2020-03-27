<div class="modal fade" id="trialErrorModal" tabindex="-1" role="dialog"
 aria-labelledby="contactSuccess" style="border-radius:10px;" aria-hidden="true">
    <div class="modal-dialog" style="border-radius:10px;">
        <div class="modal-content" style="border-radius:10px;">
            <div class="modal-header modHeader"
            style="background-color:#900;color:#fff;font-size:18pt;
            font-weight:bold;">
            Error Processing Your Request.
		            <button type="button"
		            class="close"
		            data-dismiss="modal"
		            style="color:#fff;">
		            	&times;
		            </button>
            </div>
            <div style="text-align:center;padding-top:25px;line-height:2em;">
                <div id="trialEmailError" style="text-align:center;padding:15px;
                display:none;">
                    Invalid Email
                </div>
                <div id="trialAddressError" style="text-align:center;padding:15px;
                display:none;">
                    Invalid Address
                </div>
                <div id="trialDuplicateImport" style="text-align:center;padding:15px;
                display:none;">
                    <div style="padding:10px;">
                        Duplicate Trial Account Found
                    </div>
                    <div style="padding-bottom:10px;">
                        Please Check Your Email & complete the process!
                    </div>
                </div>
                <div id="trialDuplicateError" style="text-align:center;padding:15px;
                display:none;">
                    <div style="padding:10px;">
                        Duplicate Account Found!
                    </div>
                    <div style="padding-bottom:10px;">
                        <a href="#">
                            Please log into existing account
                        </a>
                    </div>
                </div>
                @if($errors->has('theEmail'))
                    <div style="text-align:center;padding:15px;">
                        Invalid Email
                    </div>
                @endif
                @if($errors->has('trialAddress'))
                    <div style="text-align:center;padding:15px;">
                        Invalid Address
                    </div>
                @endif
                @if($errors->has('dup'))
                    <div style="text-align:center;padding:15px;">
                        You already have an account! Please log into existing account.
                    </div>
                @endif
            </div>
            <div class="modal-body">
			</div>
        </div>
    </div>
</div>
