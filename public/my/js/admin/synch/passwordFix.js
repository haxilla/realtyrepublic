$(function(){

  $('body').on('click','.passwordFix .scriptStartButton',
  function(e){
    //rotate icon
    $('.scriptStartButton .ticon').addClass("rotating");

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
    
  });

});
