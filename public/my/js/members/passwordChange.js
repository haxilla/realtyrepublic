$(function(){

  //to prevent default form submissions
  $('body').on('submit','.noSubmit',function(e){
    e.preventDefault();
    return false;
  });

  //clears validation errors
  $('input[type="text"], input[type="password"]').on('keyup',function(e){
    $('input[type="text"]').css({"border":"1px solid #ccc"});
    $('input[type="password"]').css({"border":"1px solid #ccc"});
    $('.errorLabel').hide();
  })

  //form validation
  $('.passwordChange .formSubmit').click(function(e){
    var hasErrors=null;
    var newPassword=$('input[name="newPassword"]').val();
    var newPassword_conf=$('input[name="newPassword_confirmation"]').val();

    if(newPassword.length<4){
      var hasErrors=1;
      $('input[name="newPassword"]').focus()
      .val('').val(newPassword)
      .css({"border":"1px solid #900"})
      .next('.errorLabel').show().closest('.fieldDiv')
      .css({"margin-bottom":"25px"});
    }

    if(newPassword !== newPassword_conf
    || newPassword.length<4){
      var hasErrors=1;
      $('input[name="newPassword_confirmation"]')
      .focus().val('').val(newPassword_conf)
      .css({"border":"1px solid #900"})
      .next('.errorLabel').show();
    }

    if(!hasErrors){
      theURL='/member/passwordChange';
      formData=$('.passwordChange form').serialize();
      passwordChangeSubmit(theURL,formData);}

  });

});

function passwordChangeSubmit(theURL,formData){

  // process the form
  $.ajax({
    type      : 'POST',
    url       : theURL,
    data      : formData,
    dataType  : 'json',
    headers   : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    encode    : true
  })
  // using the done promise callback
  .done(function(data){
    if(data.status=='success'){
      alert('all good!');
    }else{
      alert('issues!!!');}
  })
  .fail(function(data){
    alert('error-line68-members/passwordReset.js');
  });


}
