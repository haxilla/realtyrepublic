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

  alert('run script');

}
