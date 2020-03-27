<div class="default overlayContent">
  <div class="overlayBorder">
    <div class="row noMargin textCenter">
      <div class="col-12 noPad">
          <div class="textCenter circle25
          publicOverlayClose">
            X
          <div>
      </div>
    </div>
    <div class="row noMargin headWrapper">
      <div class="col-12 noPad
      mainHead">
        JOIN NOW
      </div>
      <div class="col-12 noPad
      subHead">
        & Make Your First Flyer FREE!
      </div>
    </div>
    <div>
        <form method="POST" action="/trialAccount" class="clearForm"
        id="joinNowModalForm">
            {{ csrf_field() }}
            <fieldset class="form-group">
                <label class="form-control-label sr-only">
                  Your Email
                </label>
                <div>
                    <div>
                        <input placeholder="Your Email"
                        name="theEmail"
                        class="firstField field"
                        id="trialEmail"
                        type="email"
                        value="{{old('theEmail')}}"
                        required>
                    </div>
                    <div class="transformSmall">
                        @include('mdbxPublic.includes.elements.captchav2')
                    </div>
                    <div>
                        @include('mdbxPublic.includes.elements.solidBlueGetStartedSubmit')
                    </div>
                </div>
            </fieldset>
            <input type="hidden" name="fromForm" value="theModal">
        </form>
        <div id="joinNowModalLoginDiv" style="display:none;">
            <div>
                Please log into your existing account!
            </div>
            @include('mdbxPublic.includes.forms.memberLoginForm')
        </div>
    </div>
  </div>
</div>
