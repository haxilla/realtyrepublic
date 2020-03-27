(function ($) {
  $(document).ready(function(){
    /*
    $('#landingCarousel').bind('slide.bs.carousel', function (e) {
        console.log('slide event!');
    });
    */
    $("a#lightGradientCreate").click(function(e){
        $('#agentListModal').modal('hide');
    });
    //resets any previous red outline errors
    $('input').click(function(e){
        $('.clearForm input').css({'border':'none'});
        //clear error div
        $('.print-error-msg').find("ul").html('');
        $('.print-error-msg').hide();
        $('.showErrors').hide();
    });
    //joinNow modal clear
    $('#joinNowModalIndex').click(function(e){
        $('.showErrors').hide();
    });
    //joinNow modal clear
    $('#forgotPasswordModalIndex').click(function(e){
        $('.showErrors').hide();
    });
    //login modal
    $('input#agtUnameLoginModal').click(function(e){
        $('.loginModalMessage').show();
        $('.loginModalError').hide();
    });
    $('input#thePasswordLoginModal').click(function(e){
        $('.loginModalMessage').show();
        $('.loginModalError').hide();
    });

    // turn on navbar for page refresh
    // not at page start
    if(window.pageYOffset > 25){
      $('.navTopLogoSwap img').css({"display":"block","max-height":"30px"});
      $(".navTopSwap").css({
      "box-shadow":
      "0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12)"})
      $(".navTopSwap").css({"background":"#223e94"});}

    // fade in .navbar
    $(window).scroll(function () {
        // set distance user needs to scroll before we start fadeIn
        if ($(this).scrollTop() > 25) {
            $('.navTopLogoSwap img').css({"display":"block","max-height":"30px"});
            $(".navTopSwap").css({
            "box-shadow":
            "0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12)"})
            $(".navTopSwap").css({"background":"#223e94"});
        } else {
            $('.navTopLogoSwap img').css({"display":"none"});
            $(".navTopSwap").css({"background":"transparent","box-shadow":"none"});
        }
    });

    //format list prices
    $.fn.digits = function(){
        return this.each(function(){
            $(this).text( $(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") );
        });
    }
    //agent modal click
    $("a#agentWallPhoto").click(function(){
        //clear values
        $("input[type=text], textarea").val("");
        //reset captcha
        grecaptcha.reset();
        $('.alert-danger').html("");
        $('.alert-danger').hide();
        $(".modalMain").show();
        $(".modalContactSuccess").hide();

        //set var
        var ajid=$(this).data( "ajid" );

        //get data
        $.getJSON('/agentWebInfo?ajid='+ajid, function(data) {
            agtName=(data[0].the_agent.agtFullName);
            agtFirst=(data[0].the_agent.agtFirst);
            agtLast=(data[0].the_agent.agtLast);
            agtURL=(data[0].the_agent.agtURL);
            agtMainPhone=(data[0].the_agent.agtMainPhone);
            agtWebsite=(data[0].the_agent.agtWebsite);
            agtStartDate=(data[0].the_agent.startDate);
            memberSince=new Date(agtStartDate).getFullYear();
            agtOffice=(data[0].the_office.officeName);
            officeID=(data[0].the_office.officeID);
            officeAddress1=(data[0].the_office.officeAddress1);
            officeCity=(data[0].the_office.officeCity);
            officeState=(data[0].the_office.officeState);
            officeZip=(data[0].the_office.officeZip);
            officeCSZ=officeCity+' '+officeState+', '+officeZip
            //check newRemID
            if(data[0].the_agent.the_agent_cleanup){
                newRemID=data[0].the_agent.the_agent_cleanup.newRemID;}
            //agtPhoto
            agtPhoto=data[0].the_agent.agtPhoto;
            if(agtPhoto){
                agtPhotoURL='/agentPhotos/'+newRemID+'/'+agtPhoto;
                $("#ajaxAgentPhoto").html("<img src="+agtPhotoURL+" style='max-height:100px;'>");}
            //agtLogo
            agtLogo=data[0].the_agent.agtLogo;
            if(agtLogo){
                agtLogoURL='/officeLogos/'+officeID+'/'+agtLogo;
                $("#ajaxAgentLogo").html("<img src="+agtLogoURL+" style='max-height:65px;margin-left:25px;'>");}
            //header
            $("#ajaxAgentModalForm").attr('action', '/postEmailAgentModal?ajid='+ajid);
            $("#ajaxAgentModalForm").attr("class", ajid);
            $("#ajaxAgentName").html(agtName);
            $("#ajaxAgentJoin").html(agtName+'\'s');
            $("#ajaxSendAgentMessage").html('Send a Message to '+agtName);
            $("#ajaxAgentOffice").html(agtOffice);
            $("#ajaxAgentMainPhone").html(agtMainPhone);
            $("#ajaxAgentURL").html('RealtyEmails.com/'+agtURL);
            $("#ajaxAgentWebsite").html("");
            if(agtWebsite){
                $("#ajaxAgentWebsite").html('<div style="display:inline-block;margin-right:15px;color:#223e94;">'+
                '<span class="ti-world"></span></div><div style="display:inline-block">'+agtWebsite+'</div>');
            }
            $("#ajaxOfficeAddress1").html(officeAddress1);
            $("#ajaxOfficeCSZ").html(officeCSZ);
            $("#ajaxMemberSince").html('Premium Member Since '+memberSince);
            $("#ajaxAgentListings").html("");
            $.each(data, function(index) {
                xFullStreet=(data[index].xFullStreet);
                theID=(data[index].the_meta.sk1);
                if(xFullStreet){
                    xFullStreet = xFullStreet.replace('<br>',' ');}
                else{
                    xFullStreet = " ";}

                xCity=(data[index].xCity);
                xState=(data[index].xState);
                xZip=(data[index].xZip);
                xBeds=(data[index].xBeds);
                xBaths=(data[index].xBaths);
                xSqft=(data[index].xSqft);
                xListPrice=(data[index].xListPrice);
                if(xListPrice != null){
                    xListPrice="$"+xListPrice;
                }else{
                    xListPrice=" ";
                }
                if(!xBeds){
                    xBeds=(data[index].xxBeds);}
                if(!xBaths){
                    xBaths=(data[index].xxBaths);}
                if(!xSqft){
                    xSqft=(data[index].xxSqft);}
                if(!xZip){
                    xZip=(data[index].xxZip);}
                //add text if value
                if(xBeds){
                    xBeds=xBeds+' Beds';
                }else{
                    xBeds=" ";
                }
                if(xBaths){
                    xBaths=xBaths+' Baths';
                }else{
                    xBaths=" ";
                }
                if(xSqft){
                    xSqft=xSqft+'sqft';
                }else{
                    xSqft=" ";
                }
                if(!xCity){
                    xCity=" ";
                }else{
                    xCity=xCity+', '
                }
                if(!xState){
                    xState=" ";
                }
                if(!xZip){
                    xZip=" ";
                }
                creationDate=(data[index].creationDate);
                zipDir=(data[index].the_meta.zipDir);
                mlsDir=(data[index].the_meta.mlsDir);
                $.each(data[index].the_photos, function(k,v){
                    defURL='hqphotos/'+zipDir+'/'+mlsDir+'/'+v.photoName;
                    $("#ajaxAgentListings").append('<div class="col-lg-6">'+
                    '<div style="border:1px solid #eee;margin-bottom:15px;">'+
                        '<div style="background:#efedff;padding:10px;color:#223e94;">'
                            +xFullStreet+
                        '</div>'+
                        '<div style="float:left;">'+
                            '<a href="/propInfo?id='+theID+'">'+
                                '<img src="'+defURL+'" style="height:125px;width:200px;object-fit:cover;">'+
                            '</a>'+
                        '</div>'+
                        '<div style="float:left;padding:10px;font-size:90%;line-height:1.75em">'+
                            '<div>'+xCity+xState+' '+xZip+'</div>'+
                            '<div class="xListPrice" style="font-weight:bold;font-size:100%;">'+xListPrice+'</div>'+
                            '<div>'+xBeds+' '+xBaths+' '+xSqft+' </div>'+
                        '</div>'+
                        '<div style="clear:both;"></div>'+
                    '</div></div>');
                    if(xListPrice){
                        $('.xListPrice').digits();
                    }
                });
            });
            //open
            $("#agentWallModal").modal();
            $('#agentWallModal .modal-body').scrollTop(0);

        });
    });
    //* agent form post
    $('#ajaxAgentModalSubmit').click(function(e){
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

    $('#freeTrialAddressSubmit').click(function(e){
        e.preventDefault();
        //get data
        formData=$('#freeTrialAddressForm').serialize();
        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : '/trialAccount', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
        })
        .done(function(data) {
            //report errors
            if (data.errors){
                var allErrors=data.errors;
                //*****************//
                $('#trialEmailError').hide();
                $('#trialAddressError').hide();
                $('#trialDuplicateError').hide();
                //if Email Error
                if(jQuery.inArray("Please Enter Your Email", data.errors) != -1) {
                    $('#trialEmailError').show();
                    $('input[name=theEmail]').css({'border':'1px solid #900'});}
                if(jQuery.inArray("Please Enter a Valid Email", data.errors) != -1){
                    $('#trialEmailError').show();
                    $('input[name=theEmail]').css({'border':'1px solid #900'});}
                //****************//
                //if Address Error
                if(jQuery.inArray("The Trial Address field is required", data.errors) != -1) {
                    $('#trialAddressError').show();
                    $('input[name=trialAddress]').css({'border':'1px solid #900'});}
                if(jQuery.inArray("The Trial Address field appears invalid", data.errors) != -1) {
                    $('#trialAddressError').show();
                    $('input[name=trialAddress]').css({'border':'1px solid #900'});}
                //Duplicate Error - Main Account Found
                if(allErrors.indexOf("Duplicate") != -1) {
                    $('#trialDuplicateError').show();}
                //CaptchaV2 errors
                if(data.errors=='CaptchaError'){
                    $('#trialCaptchaError').show();}
                if(data.errors=='CaptchaMissing'){
                    $('#trialCaptchaMissing').show();}

                //Duplicate Import found
                if(data.errors=='DupImport'){
                    var theKey=data.theKey;
                    //change key
                    $('#jqKey').val(theKey);
                    //show success modal
                    $('#trialSuccessModal').modal();}

                //** REDIRECT **
                //Not Found - New Entry with Key
                if (allErrors.indexOf("Keyed") != -1){
                    theKey=data.theKey;
                    window.location = "/mdbx/newTrialRequest?key="+theKey;}
                //*******************//
                //scroll to section
                $('html, body').animate({
                    scrollTop: $("#freeTriali").offset().top
                }, 'fast');
                //show error modal in every case but DupImport
                if(data.errors!='DupImport'){
                    $('#trialErrorModal').modal();}


            }else if(data.status=='Success'){
                var theKey=data.theKey;
                //change key
                $('#jqKey').val(theKey);
                //show success modal
                $('#trialSuccessModal').modal();
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
}(jQuery));
