@extends('layouts.rosemary.master')

@section('theHeader')
  @include('mdbxPublic.otherHeaders.rosemary.pubHeader')
@endsection

@section('pubNav')
  @include('mdbxPublic.otherNavigation.rosemary.pubNavTop')
@endsection

@section('showCaseHomes')
  @include('mdbxPublic.otherIncludes.rosemary.showcaseHomes')
@endsection

@section('leftcol')
   @include('mdbxPublic.otherIncludes.rosemary.flyerAd')
@endsection

@section('rightcol')
   @include('mdbxPublic.otherIncludes.rosemary.mostViewsList')
@endsection

@section('lowerPromo')
   <!-- @ include('layouts.partials.remHelped') -->
@endsection

@section('contactFooter')
   <div style="background-color:#fff;">
      @include('mdbxPublic.otherIncludes.rosemary.contactUs')
   </div>
@endsection

@section('pubScripts')
   @include('mdbxPublic.otherScripts.rosemary.pubScripts')
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
