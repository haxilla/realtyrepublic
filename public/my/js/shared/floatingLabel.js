$(function(){

  checkInputs()

  $('body').on('click','.label',function(e){
    $(this).next('input').focus();
    $(this).removeClass('unfocused').addClass('focused');
  });

  $('body').on('focus','input',function(e){
    $(this).prev('.label').removeClass('unfocused').addClass('focused');
  });

  $('body').on('blur','input',function(e){
    if( $(this).val()==""){
      $(this).prev('.label').addClass('unfocused').removeClass('focused');
    }
  });

});

// runs on page load
// when available in DOM
function checkInputs(){
  $('input').each(function(){
    if( $(this).val()==""){
      $(this).prev('.label').addClass('unfocused').removeClass('focused');
    }else{
      $(this).prev('.label').addClass('focused').removeClass('unfocused');
    }
  });
}

// run when needed
// for elements loaded after DOM
function fixInputs(){
  theseInputs=$('body').find('.profileForm input');
  theseInputs.each(function(){
    if( $(this).val()==""){
      $(this).prev('.label').addClass('unfocused').removeClass('focused');
    }else{
      $(this).prev('.label').addClass('focused').removeClass('unfocused');
    }
  });
}
