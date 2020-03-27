<!--Navigation bar-->
<nav class="navbar navbar-xs navbar-default navbar-fixed-top" 
style="border:none !important;box-shadow:none !important;background:#fff !important;">
  <div class="container" style="padding-top:5px;padding-bottom:0;">
    <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse"
    data-target="#myNavbar">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" style="font-size:24px;color:#090"
    href="/"><img src="/images/remlogo.png" style="max-height:30px;
    display:inline-block;">
      REALTY<span>EMAILS.</span>COM
    </a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
          <li><a style="color:#6e6c4a" href="/pricing">Pricing</a></li>
          <li><a style="color:#6e6c4a" href="/slides">Search Flyers</a></li>
          <li><a style="color:#6e6c4a"href="/faq">FAQ</a></li>
          <li>
            <a href="#" data-target="#freeTrialModal"
            style="color:#6e6c4a" 
            data-toggle="modal">
              Free Trial
            </a>
          </li>
          <li class="btn-trial"><a href="#" data-target="#login"
          data-toggle="modal">Sign in</a></li>
      </ul>
    </div>
  </div>
</nav>
@include('modals.modLogin')
@include('modals.mdbxForgotPasswordModal')
@include('modals.freeTrialModal')
@include('modals.passwordResetSuccess')
@include('modals.passwordResetFail')
@include('modals.linkFail')
@include('modals.emailConfirmSuccess')
@include('modals.trialSuccess')
@include('modals.trialPending')
@include('modals.confirmBeforePurchase')
@include('modals.contactSuccess')

