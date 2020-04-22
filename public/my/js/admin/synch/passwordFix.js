$(function(){

  $('body').on('click','.passwordFix .startNow',
  function(e){
    //rotate icon
    $('.scriptStartButton .ticon').addClass("rotating");
    //remove startNow
    $('.scriptStartButton').removeClass('startNow');
    //icon css
    $('.scriptStartButton .ticon').css({
      "color":"#464555",
      "opacity":".5",
    });
    //button css
    $('.scriptStartButton').css({
      "background":"#000",
      "opacity":".5",
    });
    //progressWait show
    $('.passwordFix .progressWait').show();

    //run passwordFix script
    passwordFix();

  });

});

function passwordFix(){

  // process the form
  $.ajax({
     type        : 'GET', 						  // type of HTTP request
     url         : '/synch/agtPswdFix', // the url to navigate to
     dataType    : 'json', 						  // data to expect from server
     encode      : true
  })

  // using the done promise callback
  .done(function(data){
    if(data.status=='success'){
      alert('all good');
    }else{
      alert('something fishy');
    }
  })
  
  // using the fail promise callback
  .fail(function(data){
    alert('error');
  });
}
