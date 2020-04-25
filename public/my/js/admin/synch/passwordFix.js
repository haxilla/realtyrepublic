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

    var fixCount=$(this).data("fixcount");
    //run passwordFix script
    passwordFix(fixCount);

  });

});

function passwordFix(fixCount){

  // process the form
  $.ajax({
     type        : 'GET', 						  // type of HTTP request
     url         : '/synch/agtPswdFix?fixCount='+fixCount, // the url to navigate to
     dataType    : 'json', 						  // data to expect from server
     encode      : true
  })

  // using the done promise callback
  .done(function(data){
    if(data.status=='success'){
      fixCount=data.fixCount;
      thisCount=data.thisCount;
      thisPercent=data.thisPercent+'%';

      if(thisCount>0){
        $('.passwordFix span.theCount').text(thisCount);
        $('.passwordFix .progressWait').hide();
        $('.passwordFix .progress').show();
        $('.passwordFIx .progress-bar').css({"width":thisPercent,})
        passwordFix(fixCount);
      }else{
        alert('Fixes Complete!');}

    }else{
      alert('something fishy');
    }
  })

  // using the fail promise callback
  .fail(function(data){
    alert('error');
  });
}
