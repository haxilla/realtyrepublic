@if(session()->has('contactError'))
    <script>
        $('html, body').animate({scrollTop:$(document).height()}, 'fast');
    </script>
@endif
@if(session()->has('contactSuccess'))
    @include('mdbxPublic.modals.contactSuccessModal')
    <script>
        $('#contactSuccessModal').modal();
    </script>
@endif
@if(session()->has('passwordChangeSent'))
    @include('mdbxPublic.modals.passwordChangeSentModal')
    <script>
        $('#passwordChangeSentModal').modal();
    </script>
@endif
@if(session()->has('passwordResetModalError')
||session()->has('passwordResetCaptchaError')
||session()->has('passwordRequestFailed'))
    <script>
        $('#passwordChangeRequestModal').modal();
    </script>
@endif
@if(session()->has('loginModalError')
||session()->has('loginModalCaptchaError'))
    <script>

        //set error message
        var errorMessage="{{session('loginModalError')}}";
        //require captcha
        if(errorMessage.includes("Must be Logged in")==false){
            //change fromForm hidden value
            $('input[id=loginModalFromForm]').val('loginCaptchaModal');
            //show captcha
            $('.loginCaptchaRequired').show();
            //hide normal message
            $('.loginModalMessage').hide();
            //show error message
            $('.loginModalError').show();} 

        //popup login modal
        $('#loginModal').modal();

    </script>
@endif
@if(session()->has('joinNowError'))
    @if($errors->has('theEmail'))
        <script>
            $('showErrors').show();
            $(function(){
                //color missing field red
                $('input[name=theEmail]').css({'border':'1px solid #900'});
            });
        </script>
    @endif
    <script>
        $('#joinNowModal').modal();
    </script>
@endif
@if(session()->has('trialFormError'))
    @include('mdbxPublic.modals.trialErrorModal')
    @if($errors->has('theEmail'))
        <script>
            $(function(){
                //color missing field red
                $('input[name=theEmail]').css({'border':'1px solid #900'});
            });
        </script>
    @endif
    @if($errors->has('trialAddress'))
        <script>
            $(function(){
                //color missing field red
                $('input[name=trialAddress]').css({'border':'1px solid #900'});
            });
        </script>
    @endif
    <script>
        $(function(){
            //scroll to section
            $('html, body').animate({
                scrollTop: $("#freeTriali").offset().top
            }, 'fast');
            $('#trialErrorModal').modal();
        });
    </script>
@endif
@if(session()->has('confirmEmail'))
    @include('mdbxPublic.includes.modals.pendingConfirmationModal')
    <script>
        $('#pendingConfirmationModal').modal();
    </script>
@endif
@if(session()->has('trialEmailConfirmed'))
    @include('mdbxPublic.modals.emailConfirmedModal')
    <script>
        $(function(){
            key="{{session()->get('trialEmailConfirmed')}}";
            $('input[name=pendingTrialKey]').val(key);
            $('#emailConfirmedModal').modal();
        });
    </script>
@endif
@if(session()->has('purchaseDup'))
    @include('mdbxPublic.modals.trialErrorModal')
    <script>
        $('#trialDuplicateError').show();
        $('#trialErrorModal').modal();
    </script>
@endif
