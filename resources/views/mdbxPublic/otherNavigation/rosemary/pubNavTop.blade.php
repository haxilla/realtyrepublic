<!--Navigation bar-->
<nav style="border-bottom:1px solid #ccc;"
 class="navbar navbar-default navbar-fixed-top">
  <div class="container" style="padding:10px;padding-left:30px;
  padding-right:30px;">
    <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse"
    data-target="#myNavbar">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" style="font-size:24px;color:#090"
    href="/">
      REALTY<span>EMAILS.</span>COM
    </a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
          <li><a href="/pricing">Pricing</a></li>
          <li><a href="/slides">Search Flyers</a></li>
          <li><a href="/faq">FAQ</a></li>
          <li>
            <a href="#" data-target="#freeTrialModal" data-toggle="modal">
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

