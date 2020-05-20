$(function(){
  //determines page position
  //on load and changed menu color
  navMenuCheck();
  //background change on scroll
  $(window).scroll(function () {
    //alert($( window ).width());
    $('.landingMenu').hide();
    // set distance user needs to scroll before we start fadeIn
    if ($(this).scrollTop() > 25) {
      //blue if > 25
      $(".public.navBase").addClass('navBorderBottom');
      $(".public.navBase").addClass('backgroundPrimary');
      $(".public.navBase").removeClass('backgroundTrans');
    } else {
      //clear if top of page
      $('.public.navBase').removeClass('navBorderBottom');
      $('.public.navBase').removeClass('backgroundPrimary');
      $('.public.navBase').addClass('backgroundTrans');
    };
  });

  //monitor scrolling overlays
  //positioning of close overlay
  $('.overlayWrapper').on("scroll", function() {
    var container = $(".overlayWrapper");
    var contHeight = container.height();
    var contTop = container.scrollTop();
    var contBottom = contTop + contHeight;
    console.log(contHeight,contTop,contBottom);
    if(contTop>50){
      //show close on agtURLbar
      $('.agentURLbar .publicOverlayClose').show();
    }else{
      //hide close on agtURLbar
      $('.agentURLbar .publicOverlayClose').hide();
    }
  });

  //format list prices
  $.fn.digits = function(){
      return this.each(function(){
          $(this).text( $(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") );
      });
  }

  //navMenuIcon Click
  $('.navMenuIcon').click(function(){
    //landingMenu toggle
    $('.publicLoginWrapper').hide();
    $('.publicOverlay').hide();
    $('.landingMenu').toggle();
    //change navMenu base on page position
    navMenuCheck();
  });

  //publicSearch
  $('.publicSearch a, .landingMenu .menuButton.search').click(function(e){
    $('.publicOverlay').hide();
    $('.publicLoginWrapper').hide();
    $('.landingMenu').hide();
    $('.publicSearchForm .searchTerm').val("");
    $('.publicSearchForm .searchResults').addClass('displayNone');
    $('.publicSearchForm .render').html("");
    $('.publicSearchForm .render').addClass('displayNone');
    $('.publicSearchForm.dim').removeClass('displayNone');
    $('.publicSearchForm input.firstField').focus();
    $('body').addClass('disable-scroll');
    navMenuCheck();
  })

  //agentWall click
  $('a#agentWallPhoto').click(function(e){
    //set var
    var ajid=$(this).data( "ajid" );
    var theURL="/agentWall?ajid="+ajid;
    //ajax request html
    publicOverlay(theURL)
  });

  //join now
  $('.joinNowFree').click(function(e){
    var theURL="/joinNow";
    publicOverlay(theURL);
  });

  //emailus
  $('body').on('click', '.emailButton',function(e){
    var theURL="/emailUs";
    publicOverlay(theURL);
  });

  //privacy policy
  $('.privacyLink').click(function(e){
    var theURL="/privacyPolicy";
    publicOverlay(theURL);
  });

  //subscribe
  $('.subscribeLink').click(function(e){
    var theURL="/pubSubscribe";
    publicOverlay(theURL);
  });

  //clear errors on input click
  $('body').on('click',
  '.publicOverlay textarea, .publicOverlay input',
  function(e){
    $('.alert-danger').hide();
  });

  //overlay closed
  $('body').on('click','.publicOverlayClose, .privacyOK, .unimportableSuccessRender .primaryButton', function(e){
    $('.publicLoginWrapper input[name="failCount"]').val('0');
    $('.publicLoginWrapper input[name="captchaPresent"]').val('0');
    $('.publicLoginWrapper input[name="gotoURL"]').val("");
    $('.publicLoginWrapper .conditionalCaptcha').hide();
    $('.publicLoginWrapper .passwordRequest').hide();
    $('.publicOverlay').hide();
    $('.publicLoginWrapper').hide();
    $('.publicSearchForm').addClass('displayNone');
    $('.publicOverlay .render').html("");
    $('.publicOverlay .unimportableSuccessRender').hide();
    $("body").removeClass("disable-scroll");
    navMenuCheck();
  });

});

function publicOverlay(theURL){
  //ajax get request
  $.ajax({
    url: theURL,
    type: "GET",
    dataType: "html",
    /*
    beforeSend: function() {
      //reset perfectScrollbar
      $(".responseOverlay").perfectScrollbar("destroy");
    },
    */
    success: function(response){
      //add contents
      $('.publicOverlay').hide();
      $('.publicLoginWrapper').hide();
      $('.landingMenu').hide();
      $('.publicSearchForm').addClass('displayNone');
      $('.publicOverlay .render').html("");
      $('.publicOverlay .render').html(response);
      $('body').addClass('disable-scroll');
      $('.publicOverlay').show();
      $('.overlayWrapper').scrollTop(0);
      $('.firstField').focus();
      $.getScript("https://www.google.com/recaptcha/api.js");
      $('.alert-danger').hide();
      navMenuCheck();
    },
    error: function(xhr, textStatus, errorThrown){
       alert(errorThrown);
    }
  });
}

function navMenuCheck(){
  //if popups visible
  if($('.landingMenu').is(":visible")||
  $('.publicOverlay').is(":visible")||
  $('.publicLoginWrapper').is(":visible")||
  $('.publicSearchForm').is(":visible")){
    //even if top of page
    if(window.pageYOffset < 25){
      //change navbar color
      $('.public.navBase').addClass('navBorderBottom');
      $('.public.navBase').addClass('backgroundPrimary');
      $('.public.navBase').removeClass('backgroundTrans');}

  }else{

    //no visible popups
    //& top of page
    if(window.pageYOffset<25){
      //make clear
      $('.public.navBase').addClass('backgroundTrans');
      $('.public.navBase').removeClass('backgroundPrimary');
      $('.public.navBase').removeClass('navBorderBottom');

    }else{
      //make primary
      $('.public.navBase').removeClass('backgroundTrans');
      $('.public.navBase').addClass('backgroundPrimary');
      $('.public.navBase').addClass('navBorderBottom');}

    }
}
