$(function(){

  //clear error outlines
  $('input').focus(function() {
    $('input').css({'border':'none'});
    $('.errorLabel').hide();
  });

  $('#freeTrialAddressSubmit').click(function(e){
      e.preventDefault();
      //get data
      formData=$('#freeTrialAddressForm').serialize();
      // process the form
      $.ajax({
          type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
          url         : '/trialAccount', // the url where we want to POST
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
              var key=data.key;
              //change key
              $('#jqKey').val(theKey);
              //show success modal
              $('#trialSuccessModal').modal();
          }
      })
      // using the fail promise callback
      .fail(function(data) {
          // show any errors
          // best to remove for production
          alert('error-line33-landingForms.js');
      });
  });

  $('body').on('submit','form',function(e){
    return false;
  });

  $('body').on('click','.unimportableButton',function(e){
    e.preventDefault()
    var formData=$('.unimportableForm').serialize();
    unimportableSubmit(formData);
  });

});

function unimportableSubmit(formData){

  $('input').focus(function() {
    $('.alert-warning').hide();
    $('input').css({"border":"none"});
  });

  $.ajax({
  type: "POST",
  url: '/newAccessSubmit',
  data: formData, // serializes the form's elements.
  }).done(function(data){

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

     alert('error-line136-landingForms.js');

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

/* old
$('#freeTrialAddressSubmit').click(function(e){
    e.preventDefault();
    //get data
    formData=$('#freeTrialAddressForm').serialize();
    // process the form
    $.ajax({
        type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
        url         : '/trialAccount', // the url where we want to POST
        data        : formData, // our data object
        dataType    : 'json', // what type of data do we expect back from the server
        encode      : true
    })
    .done(function(data) {
        //report errors
        if (data.errors){
            var allErrors=data.errors;
            $('#trialEmailError').hide();
            $('#trialAddressError').hide();
            $('#trialDuplicateError').hide();
            //if Email Error
            if(jQuery.inArray("Please Enter Your Email", data.errors) != -1) {
                $('#trialEmailError').show();
                $('input[name=theEmail]').css({'border':'1px solid #900'});}
            if(jQuery.inArray("Please Enter a Valid Email", data.errors) != -1){
                $('#trialEmailError').show();
                $('input[name=theEmail]').css({'border':'1px solid #900'});}
            //if Address Error
            if(jQuery.inArray("The Trial Address field is required", data.errors) != -1) {
                $('#trialAddressError').show();
                $('input[name=trialAddress]').css({'border':'1px solid #900'});}
            if(jQuery.inArray("The Trial Address field appears invalid", data.errors) != -1) {
                $('#trialAddressError').show();
                $('input[name=trialAddress]').css({'border':'1px solid #900'});}
            //Duplicate Error - Main Account Found
            if(allErrors.indexOf("Duplicate") != -1) {
                $('#trialDuplicateError').show();}
            //CaptchaV2 errors
            if(data.errors=='CaptchaError'){
                $('#trialCaptchaError').show();}
            if(data.errors=='CaptchaMissing'){
                $('#trialCaptchaMissing').show();}

            //Duplicate Import found
            if(data.errors=='DupImport'){
                var theKey=data.theKey;
                //change key
                $('#jqKey').val(theKey);
                //show success modal
                $('#trialSuccessModal').modal();}

            //** REDIRECT **
            //Not Found - New Entry with Key
            if (allErrors.indexOf("Keyed") != -1){
                theKey=data.theKey;
                window.location = "/mdbx/newTrialRequest?key="+theKey;}
            //scroll to section
            $('html, body').animate({
                scrollTop: $("#freeTriali").offset().top
            }, 'fast');
            //show error modal in every case but DupImport
            if(data.errors!='DupImport'){
                $('#trialErrorModal').modal();}


        }else if(data.status=='Success'){
            var theKey=data.theKey;
            //change key
            $('#jqKey').val(theKey);
            //show success modal
            $('#trialSuccessModal').modal();
        }
    })
    // using the fail promise callback
    .fail(function(data) {
        // show any errors
        // best to remove for production
        alert('failed!');
    });
});
*/
