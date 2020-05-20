$(function(){
    /*
    document.body.addEventListener('touchmove',
    function(e){
      e.preventDefault();
      e.stopPropagation()});
    document.body.addEventListener('touchstart',
    function(e){
      e.preventDefault();
      e.stopPropagation()});
    document.body.addEventListener('scroll',
    function(e){
      e.preventDefault();
      e.stopPropagation()});
    */

    /*
    if(!Modernizr.cssvhunit){
      alert('no cssvhunit');}
    if(!Modernizr.objectfit){
      alert('no objectfit');}
    if(!Modernizr.flexbox){
      alert('no flexbox');}
    */
    // turn on navbar for page refresh
    // not at page start

    navMenuCheck();
    /*
    if(window.pageYOffset > 25){
      $(".public.navBase").addClass('navBottomBorder');
      $(".public.navBase").addClass('backgroundPrimary');

      //$(".public.navBase").css({
      //"box-shadow":"0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12)",
      //"background":"#223e94"});

    };
    */

    //background change on scroll
    $(window).scroll(function () {
      //alert($( window ).width());
      $('.landingMenu').hide();
      // set distance user needs to scroll before we start fadeIn
      if ($(this).scrollTop() > 25) {
        $(".public.navBase").addClass('navBorderBottom');
        $(".public.navBase").addClass('backgroundPrimary');
        $(".public.navBase").removeClass('backgroundTrans')
        /*
        $(".public.navBase").css({
        //box shadow bugs out on samsung android
        "box-shadow":"0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12)",
        //"border-bottom":"2px solid rgba(0,0,0,.2)",
        "background":"#223e94"});
        */
      } else {
        $('.public.navBase').removeClass('navBorderBottom');
        $('.public.navBase').removeClass('backgroundPrimary');
        $('.public.navBase').addClass('backgroundTrans');
        /*
        $(".public.navBase").css({
          "background":"transparent",
          "box-shadow":"none",
          "border-bottom":"none",
        });
        */
      };
    });

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

    $('a#agentWallPhoto').click(function(e){
      //set var
      var ajid=$(this).data( "ajid" );
      var theURL="/agentWall?ajid="+ajid;
      //ajax request html
      publicOverlay(theURL)
    });
    $('.joinNowFree').click(function(e){
      var theURL="/joinNow";
      publicOverlay(theURL);
    });
    /*
    $('.publicLogin').click(function(e){
      e.preventDefault();
      var theURL="/login";
      publicLogin(theURL);
    });
    */
    $('body').on('click', '.emailButton',function(e){
      var theURL="/emailUs";
      publicOverlay(theURL);
    });
    $('.privacyLink').click(function(e){
      var theURL="/privacyPolicy";
      publicOverlay(theURL);
    });
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

    $('body').on('click','.publicOverlayClose, .privacyOK, .unimportableSuccessRender .primaryButton', function(e){
      $('.publicOverlay').hide();
      $('.publicLoginWrapper').hide();
      $('.publicOverlay .render').html("");
      $('.publicOverlay .unimportableSuccessRender').hide();
      $("body").removeClass("disable-scroll");
      navMenuCheck();
    });

    //* agent form post
    $('body').on('click','#agtWallMsgSubmit',function(e){
        //prevent Default
        e.preventDefault();
        //set ajid
        var ajid=$("#ajaxAgentModalForm").attr('class');
        //get data
        formData=$('#ajaxAgentModalForm').serialize();
        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : '/postEmailAgentModal?ajid='+ajid, // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
        })
        // using the done promise callback
        .done(function(data) {
            //report errors
            if (data.errors){
                $('.alert-danger').show();
                $('.alert-danger').html("");
                $.each(data.errors, function(key, value){
                    $('.alert-danger').append('<p>'+value+'</p>');
                });
            }else{
                $(".modalMain").hide();
                $(".modalContactSuccess").show();
            }
        })
        // using the fail promise callback
        .fail(function(data) {
            // show any errors
            // best to remove for production
            alert('failed!');
        });
    });

    $('#importableTrialSubmit').click(function(e){
        e.preventDefault();
        $('#importableTrialConfirmation').show();
        $('#importableTrialSuccess').hide();
        $('#trialCaptchaError').hide();
        $('#trialCaptchaMissing').hide();
        $('#trialKeyError').hide();

        formData=$('#importableTrialForm').serialize();
        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : '/importableTrialCheck', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
        })
        .done(function(data) {
            //errors
            //unchecked robot box
            if(data.errors=="You must check the I am not a robot box!"){
                $('#trialCaptchaMissing').show();}
            //wrong key
            if(data.errors=="KeyError"){
                $('#trialKeyError').show();}

            //success
            if(data.status=='Success'){
                //set theKey
                var theKey=data.theKey;
                //change modal to show progress
                $('#importableTrialConfirmation').hide();
                $('#importableTrialSuccess').show();
                //go to URL
                window.location = "/startImport?key="+theKey;
            }
        });
    });

    $('.startPurchase').click(function(e){
        //get theID from div
        theID = $(this).attr('id');
        //regex to remove all but numeric
        amt = theID.replace(/\D/g,'');
        //create monetary representation
        theAmt='$'+amt+'.00';
        //get description
        purchaseDesc=$(this).data("desc");
        //push to div
        $('input#theAmt').val(amt);
        $('input#purchaseDesc').val(purchaseDesc)
        $('.creditAmount').html('<img src="/images/remLogoO.png"'+
        ' style="max-width:175px;">'+' - '+theAmt);
        $('.purchaseDesc').text(purchaseDesc);
        //open modal
        $('#startPurchaseModal').modal();

    });

    //join now modal click
    $('.getStartedButton').click(function(e){
        //prevent default
        e.preventDefault();
        $('.joinNowModalFullBody').hide();
        $('.joinNowModalLargeLoader').show();
        //set formData
        formData=$('#joinNowModalForm').serialize();
        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : '/trialAccount', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
        })
        .done(function(data) {
            //errors
            if(data.errors){
                $('.joinNowModalFullBody').show();
                $('.joinNowModalLargeLoader').hide();
                printErrorMsg(data.errors);
                //if duplicate
                if(jQuery.inArray("Account Already Exists with this Username!",
                data.errors) != -1){
                    //get agtUname
                    var agtUname=data.agtUname;
                    //set agtUname & password
                    $('#agtUnameLoginModal').val(agtUname);
                    $('#thePasswordLoginModal').val('');
                    //change to login form
                    $('#joinNowModalForm').hide();
                    $('.joinNowModalHeader').hide();
                    $('#joinNowModalLoginDiv').show();
                    $('.joinNowModalForgotPasswordDiv').show();
                }
            }
            if(data.status=='newAccess'){
                theKey=data.theKey;
                window.location = "/mdbx/newTrialRequest?key="+theKey;
            }
            //success
            if(data.status=='Success'){
                $('.joinNowModalLargeLoader').hide();
                $('.joinNowModalSuccessMessage').show();
            }
        });
    });

    //pendingTrialAddressSubmit
    $('.pendingTrialAddressSubmit').click(function(e){
        //prevent default
        e.preventDefault();
        //get formData
        formData=$('#pendingTrialAddressForm').serialize();
        //make ajax request
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : '/pendingTrialAddress', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
        })
        .done(function(data) {
            //errors
            if(data.errors){
                printErrorMsg(data.errors);
            }
            if(data.success){
                $('#pendingTrialAddressForm').hide();
                $('#pendingTrialAddressSuccessDiv').show()
            }
        });
    });

    function printErrorMsg (msg) {

        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display','block');
        $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
        });

    }

});
/*
function touchScroll(selector){
    var scrollStartPos = 0;
    $(selector).on('touchstart', function(event) {
      scrollStartPos = this.scrollTop + event.originalEvent.touches[0].pageY;
    });
    $(selector).on('touchmove', function(event) {
      this.scrollTop = scrollStartPos - event.originalEvent.touches[0].pageY;
    });
}
*/
/*
function publicLogin(theURL,formData){
  $.ajax({
      type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
      url         : theURL, // the url where we want to POST
      data        : formData, // our data object
      dataType    : 'json', // what type of data do we expect back from the server
      encode      : true,
      headers     : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),}
  })
  //success
  .done(function(data) {
  //errors
    if(data.status=='newLogin'){
      $('.landingMenu').hide();
      $('.publicLoginWrapper').show();
      $('.publicLoginWrapper input[name="gotoURL"]').val(data.url);
      $('body').addClass('disable-scroll');
      navMenuCheck();
    }
    else if(data.status=='loginFail'){
      alert('login failed');
    }
    else if(data.status==''){
      console.log(data);
    }
  })
  // using the fail promise callback
  .fail(function(data) {
      console.log(data);
      // show any errors
      // best to remove for production
      alert('failed!');
  });
}
*/

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
      $('.publicOverlay .render').html("");
      $('.publicOverlay .render').html(response);
      $('body').addClass('disable-scroll');
      $('.landingMenu').hide();
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
  //navmenu color based on page position
  if($('.landingMenu').is(":visible")||
  $('.publicOverlay').is(":visible")||
  $('.publicLoginWrapper').is(":visible")){

    //make blue if clear & top of page
    if(window.pageYOffset < 25){

      $('.public.navBase').addClass('navBorderBottom');
      $('.public.navBase').addClass('backgroundPrimary');
      $('.public.navBase').removeClass('backgroundTrans');
      /*
      $(".public.navBase").css({
      "box-shadow":"0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12)",
      "background":"#223e94"});
      */
    }

  }else{

    //make clear if blue & top of page
    if(window.pageYOffset<25){

      $('.public.navBase').addClass('backgroundTrans');
      $('.public.navBase').removeClass('backgroundPrimary');
      $('.public.navBase').removeClass('navBorderBottom');
      /*
      $(".public.navBase").css({
        "background":"transparent",
        "box-shadow":"none"});
      */
    }else{

      $('.public.navBase').removeClass('backgroundTrans');
      $('.public.navBase').addClass('backgroundPrimary');
      $('.public.navBase').addClass('navBorderBottom');
    }
  }
}

/*
function touchScroll(selector){
    if (variable == null) {
     // do something
    }
    var scrollStartPos = 0;
    $(selector).on('touchstart', function(event) {
      scrollStartPos = this.scrollTop + event.originalEvent.touches[0].pageY;
    });

    $(selector).on('touchmove', function(event) {
      this.scrollTop = scrollStartPos - event.originalEvent.touches[0].pageY;
    });
}

function touchCheck(){
  window.addEventListener('touchstart',function(){
    touchScroll($('.overlayWrapper'));
  });
}
*/
