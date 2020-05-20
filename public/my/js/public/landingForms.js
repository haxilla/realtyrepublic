$(function(){

  /*
    //clear error outlines
    $('input').focus(function() {
      //$('input').css({'border':'none'});
      $('.errorLabel').hide();
    });

    $('body').on('focus','input',function(e){
      $('.alert-warning').html("");
      $('.alert-warning').hide();
      $('.errorLabel').hide();
    });
  */
  //use noSubmit class
  //to prevent default form submissions
  $('body').on('submit','.noSubmit',function(e){
    e.preventDefault();
    return false;
  });

  $('body').on('submit','.publicLoginForm',
  function(e){
    theURL='/member/ajaxLoginSubmit';
    formData=$('.publicLoginForm').serialize();
    ajaxLoginSubmit(theURL,formData);
  });

  //landingPage joinNow form submission
  $('body').on('submit','.joinNow form',function(e){
    $('.joinNow .mainContent').hide();
    $('.joinNow .loading').show();
    theURL='/joinNowSubmit'
    formData=$('.joinNow form').serialize();
    ajaxPost(theURL,formData);
  });

  $('body').on('click',
  '.navLI.publicLogin a, .menuButton.publicLogin a, .resetComplete .okButton',
  function(e){
    $('.landingMenu').hide();
    $('.publicLoginWrapper .resetComplete').hide();
    $('.publicLoginWrapper .publicLoginContent').hide();
    $('.publicLoginWrapper .passwordRequest').hide();
    $('.publicLoginWrapper .loading').show();
    $('.publicLoginWrapper').show();
    $('.alert-warning').html("")
    $('.alert-warning').hide();
    ajaxLoginCheck();
  });

  $('body').on('click','.publicLoginWrapper .forgotPassword a'
  ,function(e){
    $('.publicLoginWrapper .publicLoginContent').hide();
    $('.publicLoginWrapper .loading').hide();
    $('.publicLoginWrapper .passwordRequest').show();
    $('.publicLoginWrapper .passwordRequest input[name="agtUname"]').val("");
    //zero based index for grecaptcha id
    //first recaptcha for login creds is 0
    grecaptcha.reset(1);
  });

  $('body').on('click','.publicLoginWrapper .passwordRequest .formSubmit',
  function(e){
    theURL='/member/passwordRequest';
    formData=$('.publicLoginWrapper .passwordRequest form').serialize();
    passwordResetAjax(theURL,formData);
  });

  //landingPage freeTrial form submit
  $('.freeTrial form').submit(function(e){
    e.preventDefault();
    //get data
    formData=$('.freeTrial form').serialize();
    // process the form
    $.ajax({
      type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
      url         : '/freeTrialSubmit', // the url where we want to POST
      data        : formData, // our data object
      dataType    : 'json', // what type of data do we expect back from the server
      encode      : true
    })
    .done(function(data) {
    //report errors
      if (data.errors){
      //must be EXACT MATCH to error shown

      //default reason
      reason=0;

      //already exists
      if(jQuery.inArray("Account Already Exists with this Username!", data.errors) != -1){
        thisError="alreadyExists";
        reason=reason+1;
        errorOverlay(thisError);}

      //valid Email
      if(jQuery.inArray("Please Enter a Valid Email", data.errors) != -1){
        reason=reason+1;
        $('input[name=theEmail]').css({'border':'1px solid #900',});
        $('.errorLabel.theEmail').css({'display':'block'});}

      //trial Address
      if(jQuery.inArray("The Trial Address field is required", data.errors) != -1){
        reason=reason+1;
        $('input[name=trialAddress]').css({'border':'1px solid #900'});
        $('.errorLabel.trialAddress').css({'display':'block'});}

      if(reason<1){
        alert('something else went wrong');
        return false;}

      }else if(data.status=='unimportable'){

        //send manual sign up form
        var key=data.key;
        theURL='/newAccessRequest?key='+key;
        publicOverlay(theURL);

      }else if(data.status=='Success'){

        //set key
        var key=data.key;
        //change key
        $('#jqKey').val(theKey);
        //show success modal
        $('#trialSuccessModal').modal();}

    })
    // using the fail promise callback
    .fail(function(data) {
      // show any errors
      // best to remove for production
      alert('error-line33-landingForms.js');
    });
  });

  $('body').on('click','.unimportableButton',function(e){
    e.preventDefault()
    var formData=$('.unimportableForm').serialize();
    unimportableSubmit(formData);
  });

});


function ajaxPost(theURL,formData){
  //
  $.ajax({
      type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
      url         : theURL, // the url where we want to POST
      data        : formData, // our data object
      dataType    : 'json', // what type of data do we expect back from the server
      encode      : true
  })
  .done(function(data) {
    //less than 3 fails
    if(data.errors && data.failCount<3){
      failCount=data.failCount;
      $('.joinNow input[name="failCount"]').val(failCount);
    }
    //greater than or equals 3 fails
    if(data.errors && data.failCount>=3){
      failCount=data.failCount;
      $('.joinNow input[name="failCount"]').val(failCount);
      $('.joinNow input[name="captchaPresent"]').val('1');
    }
    //must use recaptcha
    if(data.captchaPresent>0){
      $('.joinNow .g-recaptcha').removeClass('displayNone');
      $('.joinNow .g-recaptcha').addClass('inlineBlock');
    }
    //success with validation
    if(data.status=='success'){
      alert('all good!');
    }else if(data.status=='unimportable'){
      //send manual sign up form
      var key=data.key;
      theURL='/trialFormShow?key='+key;
      publicOverlay(theURL);

    }else if(data.status=='error'){
      //clear previous
      $('.joinNow .alert-warning').html("");
      $('.joinNow .mainContent').show();
      $('.joinNow .loading').hide();
      //append error lines
      $.each(data.errors, function(key, value){
        $('.joinNow .alert-warning').append('<li>'+value+'</li>');});

      $('.joinNow .alert-warning').show();

    }else{
      alert('error-line138-landingForm.js');}

  })
  .fail(function(data){
    alert('error-line136-landingForms.js');
  });
}

function ajaxLoginCheck(){
  $.ajax({
    type        : 'POST',
    dataType    : 'json',
    url         : '/member/navbarLogin',
    encode      : true,
    headers     : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  })
  .done(function(data){
    if(data.status=='loginRequired'){
      //show loginForm
      $('.publicLoginWrapper .publicLoginContent').show();
      $('.publicLoginWrapper .loading').hide();
      $('.publicLoginWrapper').show();
      $('body').addClass('disable-scroll');
      navMenuCheck();
    }else if(data.status=='loginOK'){
      window.location.href = "/member/dashboard";
      //window.location.replace("/member/dashboard");
    }else{
      alert('error-line223-landingForms.js');
    }
  })
  .fail(function(data){
    alert('error-line227-landingForms.js');
  });

}

function ajaxLoginSubmit(theURL,formData){
  $.ajax({
    type        : 'POST',
    dataType    : 'json',
    data        : formData,
    url         : theURL,
    encode      : true,
    headers     : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  })
  .done(function(data){
    //set redirect
    gotoURL=data.gotoURL;
    //if errors
    if(data.errors){
      //increment failCount
      failCount=data.failCount;
      //set on form
      $('.publicLoginWrapper input[name="failCount"]').val(failCount);
      if(failCount>3){
        grecaptcha.reset();
        $('.publicLoginWrapper input[name="captchaPresent"]').val('1');
        $('.publicLoginWrapper .conditionalCaptcha').show();
      }
      //clear previous
      $('.publicLoginWrapper .alert-warning').html("");
      //append error lines
      $.each(data.errors, function(key, value){
        $('.publicLoginWrapper .alert-warning')
        .append('<li>'+value+'</li>');});
      //show errorDiv
      $('.publicLoginWrapper .alert-warning').show();}

    if(data.status=='success'){
      //redirect
      window.location.href = gotoURL;}

  })
  .fail(function(data){
    alert('error-line270-landingForms.js');
  });
}

function unimportableSubmit(formData){

  $('input').focus(function() {
    $('.alert-warning').hide();
    $('input').css({"border":"none"});
  });

  $.ajax({
    type: "POST",
    url: '/trialFormSubmit',
    data: formData,
  })
  .done(function(data){

    //report errors
    if (data.errors){
      //clear any contents
      $('.unimportable .alert-warning').html("");
      //append error lines
      $.each(data.errors, function(key, value){
        $('.unimportable .alert-warning').append('<li>'+value+'</li>');});
      //show error div
      $('.unimportable .alert-warning').show();
      //scroll to errors
      //as anchor click
      $('#errorAnchor')[0].click();

      //firstName
      if(jQuery.inArray("Please Enter Your First Name",data.errors) != -1){
        $('.agtFirst.field').css({"border":"1px solid #900"});}
      //lastName
      if(jQuery.inArray("Please Enter Your Last Name",data.errors) != -1){
        $('.agtLast.field').css({"border":"1px solid #900"});}
      //Phone
      if(jQuery.inArray("Please Enter Your Phone Number",data.errors) != -1){
        $('.yourPhone.field').css({"border":"1px solid #900"});}
      //officeName
      if(jQuery.inArray("Please Enter Your Office Name",data.errors) != -1){
        $('.officeName.field').css({"border":"1px solid #900"});}
      //officeAddress
      if(jQuery.inArray("Please Enter Your Office Address",data.errors) != -1){
        $('.officeAddress.field').css({"border":"1px solid #900"});}
      //officeCity
      if(jQuery.inArray("Please Enter Your Office City",data.errors) != -1){
        $('.officeCity.field').css({"border":"1px solid #900"});}
      //officeState
      if(jQuery.inArray("Please Enter Your Office State",data.errors) != -1){
        $('.officeState.field').css({"border":"1px solid #900"});}
      //abbreviation only
      if(jQuery.inArray("Please Enter 2 Letter State Abbreviation Only",data.errors) != -1){
        $('.officeState.field').css({"border":"1px solid #900"});}
      //officeZip
      if(jQuery.inArray("Please Enter Your Office Zip",data.errors) != -1){
        $('.officeZip.field').css({"border":"1px solid #900"});}
      //digits only
      if(jQuery.inArray("The office zip must be 5 digits.",data.errors) != -1){
        $('.officeZip.field').css({"border":"1px solid #900"});}

    }else if(data.success){

      //close trialRequestDiv
      $('.publicOverlay').hide();
      $('.publicOverlay .render').html("");
      //clear form vals
      $('input[type=text]').val("");
      //Open new window indicating success
      $('.publicOverlay').show()
      $('.publicOverlay .unimportableSuccessRender').show();
      //send email notice

      //to admin

      //to user

    };

  }).fail(function(data) {

     alert('error-line163-landingForms.js');

  });
}

function errorOverlay(thisError){
  //ajax get request
  $.ajax({
    url: '/trialError?reason='+thisError,
    type: "GET",
    dataType: "html",
    success: function(response){
      //add contents
      $('.publicOverlay').hide();
      $('.publicOverlay .render').html("");
      $('.publicOverlay .render').html(response);
      $('body').addClass('disable-scroll');
      $('.publicOverlay').show();
      $('.firstField').focus();
      $.getScript("https://www.google.com/recaptcha/api.js");
      $('.alert-danger').hide();
    },
    error: function(xhr, textStatus, errorThrown){
       alert(errorThrown);
    }
  });
}

function passwordResetAjax(theURL,formData){
  $.ajax({
    type        : 'POST',
    dataType    : 'json',
    data        : formData,
    url         : theURL,
    encode      : true,
    headers     : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  })
  .done(function(data){

    //if errors
    if(data.errors){
      var resetFailCount=data.resetFailCount;
      grecaptcha.reset(1);
      $('.passwordRequest input[name="resetFailCount"]').val(resetFailCount);
      $('.alert-warning').html("");
      $('.publicLoginWrapper .passwordRequest .alert-warning').show();
      $.each(data.errors, function(key, value){
        $('.publicLoginWrapper .passwordRequest .alert-warning')
        .append('<li>'+value+'</li>');
      });}

    //if success
    if(data.status=='success'){
      $('.publicLoginWrapper .passwordRequest').hide();
      $('.publicLoginWrapper .resetComplete').show();
      $('.publicLoginWrapper .resetComplete .resetRequest')
      .html(data.resetRequest);
    }

  })
  .fail(function(data){

  });

}
