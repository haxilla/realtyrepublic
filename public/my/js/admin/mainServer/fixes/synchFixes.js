$(function(){

  $('body').on('click','.fix .startNow',
  function(e){
    //set vars
    var fixtype=$('.fix').data("fixtype");
    var fixCount=$(this).data("fixcount");
    //
    if(fixtype=='password'){
      theURL='/synch/agtPswdFix?fixCount='+fixCount;
    }else if(fixtype=='sk1'){
      theURL='/synch/sk1Fix?fixCount='+fixCount;
    }else{
      alert('error-line12-passwordFix.js');}

    //rotate icon
    $('.scriptStartButton .ticon').addClass("rotating");
    //remove startNow
    $('.scriptStartButton').removeClass('startNow');
    //icon css
    $('.scriptStartButton .ticon').css({
      "color":"#464555",
      "opacity":".5",});
    //button css
    $('.scriptStartButton').css({
      "background":"#000",
      "opacity":".5",});

    //progressWait show
    $('.fix .progressWait').show();
    $('.fix .progress').hide();


    //run passwordFix script
    theFix(theURL);

  });

});

function theFix(theURL){

  // process the form
  $.ajax({
     type        : 'GET', 						  // type of HTTP request
     url         : theURL, // the url to navigate to
     dataType    : 'json', 						  // data to expect from server
     encode      : true
  })

  // using the done promise callback
  .done(function(data){
    if(data.status=='success'){
      //get vars from reply
      fixCount=data.fixCount;
      thisCount=data.thisCount;
      thisPercent=data.thisPercent+'%';
      //continue if more
      if(thisCount>0){
        $('.fix span.theCount').text(thisCount);
        $('.fix .progressWait').hide();
        $('.fix .progress').show();
        $('.fix .progress-bar').css({"width":thisPercent,})
        theFix(theURL);
      }else{
        alert('Fixes Complete!');}

    }else{
      alert('error-line69-synchFixes.js');
    }
  })

  // using the fail promise callback
  .fail(function(data){
    alert('error-line75-synchFixes.js');
  });
}
