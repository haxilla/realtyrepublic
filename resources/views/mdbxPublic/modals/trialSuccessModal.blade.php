<div class="modal fade" id="trialSuccessModal" tabindex="-1" role="dialog"
 aria-labelledby="contactSuccess" style="border-radius:10px;" aria-hidden="true">
    <div class="modal-dialog" style="border-radius:10px;">
        <div class="modal-content" style="border-radius:10px;">
            <div class="modal-header modHeader"
            style="background-color:#223e94;color:#fff;font-size:18pt;
            font-weight:bold;">
            New Account Created!
		            <button type="button"
		            class="close"
		            data-dismiss="modal"
		            style="color:#fff;">
		            	&times;
		            </button>
            </div>
            <div class="modal-body">
                <div id="trialCaptchaError" style="text-align:center;padding:15px;
                color:#900;display:none;">
                    Error19 - No further Information - Please contact us directly
                </div>
                <div id="trialCaptchaMissing" style="padding:15px;
                color:#900;display:none;border:1px solid #900;margin:5px 0;">
                    Please check the "I am not a robot box!"
                </div>
                <div id="trialKeyError" style="padding:15px;
                color:#900;display:none;border:1px solid #900;margin:5px 0;">
                    Error27 - No further Information - Please contact us directly
                </div>
                <div id="importableTrialConfirmation">
                    <div style="padding-bottom:10px;">
                        Confirm by Checking the box below
                    </div>
                    <div>
                        <form id="importableTrialForm" 
                        action="/importableTrialCheck" method="POST">
                            {{csrf_field()}}
                            <div>
                                @include('mdbxPublic.includes.elements.captchav2')
                                <input id="jqKey" name="theKey" type="hidden" value="">
                            </div>
                            <div>
                                <input type="submit"
                                style="padding:5px 10px;border-radius:5px;border:none;margin:5px;"
                                id="importableTrialSubmit">
                            </div>
                        </form>
                    </div>
                </div>
                <div id="importableTrialSuccess" style="display:none;padding:25px;
                padding-bottom:15px;">
                    <div style="padding-bottom:5px;">
                        Success! We are importing your information.
                    </div>  
                    <div style="padding-bottom:5px;">
                        An email will be sent to you when the process is complete.
                    </div>  
                    <div style="padding-bottom:5px;">
                        If you dont see it shortly, make sure to check all folders
                    </div>
                    <div class="col-12" style="text-align:center;">
                      <button type="button" 
                      data-dismiss="modal"
                      style="border:1px solid #eee;background:#223e94;
                      padding:10px 20px;border-radius:2em;color:#fff;margin-top:25px;">
                        OK!
                      </button>
                    </div>
                </div>
			</div>
        </div>
    </div>
</div>
