<div class="publicLoginWrapper">
  <div class="publicLoginContent">
    <div class="border">
      <div class="publicOverlayClose">
        X
      </div>
      <div class="formTitle">
        Log-in to start your session
      </div>
      <div class="alert-warning">
      </div>
      @include('mdbxPublic.overlays.publicLoginErrors')
      <form class="publicLoginForm noSubmit"
      method="POST" action="/member/loginSubmit">
        {{csrf_field()}}
        <div>
          <input type="text" name="agtUname" class="field"
          placeholder="Username">
        </div>
        <div>
          <input type="password" name="password" class="field"
          placeholder="Password">
        </div>
        <div class="conditionalCaptcha textCenter marginTop10">
          <div class="g-recaptcha transformSmall
          inlineBlock maxWidth235 maxHeight60"
          data-sitekey="6LfSH4kUAAAAADvUZitB5GPueUtXiSL0SBZKcCPR">
          </div>
        </div>
        <div>
          <input type="submit" value="Log In"
          class="primarySubmit">
        </div>
        <input type="hidden" name="gotoURL" value="">
        <input type="hidden" name="failCount" value="0">
        <input type="hidden" name="captchaPresent" value="0">
      </form>
    </div>
    <div class="forgotPassword">
      <a>
        Forgot Password?
      </a>
    </div>
  </div>
  <div class="loading">
    <div>
      Please Wait...
    </div>
    <div>
      <img src="/images/largeLoader.gif">
    </div>
  </div>
  <div class="passwordRequest">
    <div class="border">
      <div class="publicOverlayClose">
        X
      </div>
      <div class="headWrapper">
        <div class="mainHead">
          <h4>
            Forgot Password?
          </h4>
        </div>
        <div class="subHead">
          <h6>
            Enter Username Below to Reset
          </h6>
        </div>
      </div>
      <div class="alert-warning">
      </div>
      <form class="noSubmit">
        {{csrf_field()}}
        <div class="fieldDiv">
          <input type="text" name="agtPswdReset"
          class="field" placeholder="Your Username">
        </div>
        <div class="g-recaptcha transformSmall
        inlineBlock maxWidth235 maxHeight60"
        data-sitekey="6LfSH4kUAAAAADvUZitB5GPueUtXiSL0SBZKcCPR">
        </div>
        <div class="submitDiv">
          <input type="submit" value="Submit"
          class="formSubmit">
        </div>
        <input type="hidden" name="resetFailCount" value="0">

      </form>
    </div>
  </div>
  <div class="resetComplete">
    <div class="border">
      <div class="headWrapper">
        <h3 class="noMargin noPad">
          Request Received!
        </h3>
      </div>
      <div class="message">
        If an account was found, You will receive
        an email at:
      </div>
      <div class="resetRequest">
      </div>
      <div class="message">
        Please Check Your Email & click the link inside
        to complete the process
      </div>
      <div class="okButton">
        OK
      </div>
    </div>
  </div>
</div>
