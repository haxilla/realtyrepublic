@if (\Session::has('msg')||$errors->any())
  <script>
    $('.publicLoginWrapper').show();
    $('body').scrollTop(0);
    $('body').addClass('disable-scroll');
    navMenuCheck();
  </script>
@endif
@if(\Session::has('failCount'))
  <script>
    //get failCount
    failCount="<?php echo \Session::get('failCount'); ?>"
    $('input[name="failCount"]').val(failCount);
    //if failCount > 3 require captcha
    if(failCount>3){
      $('input[name="captchaPresent"]').val('Yes');
      $('.publicLoginWrapper .conditionalCaptcha').show();}
  </script>
@endif
@if(\Session::has('url'))
  <script>
    var thisURL = "<?php echo \Session::get('url');  ?>";
    $('input[name="gotoURL"]').val(thisURL);
  </script>
@endif
