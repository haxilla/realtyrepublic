<div class="formHeader joinNowModalHeader" style="color:#223e94;">
    <h3 style="margin:0;padding-bottom:25px;">
        Join Now & Make Your First Flyer FREE!
    </h3>
</div>
<div class="alert alert-warning print-error-msg" 
style="display:none;margin:0;">
    <ul></ul>
</div>
<div style="padding:25px;padding-top:15px;padding-bottom:0;">
    <form method="POST" action="/trialAccount" class="clearForm"
    id="joinNowModalForm">
        {{ csrf_field() }}
        <fieldset class="form-group">
            <label class="form-control-label sr-only">Your Email</label>
            <div>
                <div>
                    <input
                    style="border:none;height:50px;width:100%;"
                    placeholder="Your Email"
                    name="theEmail"
                    id="trialEmail"
                    class="modInputMsg form-control"
                    type="email"
                    value="{{old('theEmail')}}"
                    required>
                </div>
                <div style="text-align:center;margin-top:5px;">
                    @include('mdbxPublic.includes.elements.captchav2')
                </div>
                <div style="margin-top:15px;">
                    @include('mdbxPublic.includes.elements.solidBlueGetStartedSubmit')
                </div>
            </div>
        </fieldset>
        <input type="hidden" name="fromForm" value="theModal">
    </form>
    <div id="joinNowModalLoginDiv" style="display:none;">
        <div style="color:#223e94;padding:15px;padding-top:0;
        font-weight:bold;">
            Please log into your existing account!
        </div>
        @include('mdbxPublic.includes.forms.memberLoginForm')
    </div>
</div>