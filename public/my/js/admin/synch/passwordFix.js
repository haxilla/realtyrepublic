$(function(){

  $('body').on('click','.passwordFix .scriptStartButton',
  function(e){
    $('.scriptStartButton .ticon').addClass("rotating");
    $('.scriptStartBUtton .ticon').css({
      "background":"#000",
      "opacity":".5",
      "color":"#464555",
    });
  });

});
