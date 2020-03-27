@extends('layouts.elehu.master')

@section('theHeader')
  @include('mdbxPublic.otherHeaders.elehu.pubHeader')
  <link rel="stylesheet" type="text/css" href="/otherCSS/elehu/mycss/public/mostViews.css">
  <link rel="stylesheet" type="text/css" href="/otherCSS/elehu/corecss/mdb/mdb.min.css">
@endsection

@section('pubNav')
  @include('mdbxPublic.otherNavigation.elehu.pubNavTop')
@endsection

@section('showCaseHomes')
  @include('mdbxPublic.otherIncludes.elehu.indexes.showcaseHomes')
@endsection

@section('eflyerAd')
  <div class="container">
    @include('mdbxPublic.otherIncludes.elehu.indexes.flyerAdLateral4')
  </div>
@endsection

@section('topOfTheWeek')
  @include('mdbxPublic.otherIncludes.elehu.indexes.mostViewsList')
  @include('mdbxPublic.otherIncludes.elehu.indexes.testimonials')
@endsection

@section('lowerPromo')

@endsection

@section('contactFooter')
   <div style="background-color:#fff;">
      @include('mdbxPublic.otherIncludes.elehu.contactUs')
   </div>
@endsection

@section('pubScripts')
   @include('mdbxPublic.otherScripts.elehu.pubScripts')
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="/otherJS/elehu/corejs/popper.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="/otherJS/elehu/corejs/mdb.min.js"></script>
    <script>
      //Animation init
      new WOW().init();
    </script>
@endsection

@section('errors')
  @if($errors->first())
    <script>
      $('#login').modal();
    </script>
  @endif
  @if(session('contactSuccess'))
    <script>
      $('#contactSuccess').modal();
    </script>
  @endif
  @if(session('message'))
    @if ( strpos(session('message'), 'Password Request Fail') !== false )
      <script>
        $('#passwordResetFail').modal();
      </script>
    @elseif( strpos(session('message'), 'Password Request Sent') !== false )
      <script>
        $('#passwordResetSuccess').modal();
      </script>
    @elseif(strpos(session('message'), 'Trial Account Created') !== false)
      <script>
        $('#trialAccountSuccessModal').modal();
      </script>
    @elseif(strpos(session('message'), 'Trial Account Pending') !== false)
      <script>
        $('#trialAccountPendingModal').modal();
      </script>
    @elseif(strpos(session('message'), 'Confirm Before Purchase') !== false)
      <script>
        $('#confirmBeforePurchaseModal').modal();
      </script>
    @elseif(strpos(session('message'), 'Invalid Link') !== false)
      <script>
        $('#linkFail').modal();
      </script>
    @elseif(strpos(session('message'), 'Email Confirmation Success') !== false)
      <script>
        $('#emailConfirmSuccess').modal();
      </script>
    @endif
  @endif
@endsection
