$(document).ready(function(e){

	$('.submenuNav,.navTopDrop').click(function(e){
		//get droptitle
		var menuClass=$(this).data("droptitle");		
		var dropArrow=$(this).children('a.dropTitle').children('i.dropArrow');
		var dropTitle=$(this).children('a.dropTitle');
		//hide all
		$('.dropItems').hide();
		$('.dropArrow').removeClass('hidden');
		$('.dropTitle').removeClass('fontBold');
		//if its active hide
		if($(this).children('ul'+'.'+menuClass).hasClass('itsActive')){
			$(this).css({"background":"none"});
			$('.'+menuClass+'.dropItems').hide();
			$('.'+menuClass+'.dropItems').removeClass('itsActive')
			dropTitle.removeClass('fontBold')
			dropArrow.removeClass('hidden')
		}else{

			if ($(this).hasClass('navTopDrop')){
				$(this).css({"background":"rgba(0, 0, 0, .3)"});
			}else{
				$(this).css({"background":"rgba(255, 255, 255, .6)"});}

			$('.dropItems').removeClass('itsActive');
			$('.'+menuClass+'.dropItems').addClass('itsActive')
			$('.'+menuClass+'.dropItems').show();
			dropTitle.addClass('fontBold');
			dropArrow.addClass('hidden');
		}
	});
    
	//toggle side menu
	$('.menuIcon').click(function(e){
		$('.responsiveMenu').toggle();
		$('.menuIcon i').toggleClass('ti-menu')
		$('.menuIcon i').toggleClass('ti-close')
		$('.dropTitle').removeClass('fontBold');
	});

	//opens smallAdminMenu on smaller screens
	$('.moreIcon').click(function(e){
		$('.smallAdminNavbar').toggle();
		$(document).scrollTop('0');
	});

	//for links that open responseOverlays
	$('.overlayLink').click(function(e){
		//get menuClass
		var menuClass=$(this).data("menuclass");
		//set url
		var theURL='/admin/populateOverlay?menuClass='+menuClass;
		//clear html because it will show normal scroll bar
		$('.responseOverlayContent')
		.html('<div class="loading"><span class="spinner-grow"></span> Loading ...</div>');
		//dims all but navbar
		$('.dim').show();
		//bumps dim over navBar
		$('.dim').addClass('dimResponseOverlay');
		//show response
		$('.responseOverlay').show();
		//send request
		populateOverlay(theURL);
	});

	//close overlay
	$('.closeOverlay').click(function(e){
		$('.responseOverlay').hide();
		$('.dim').removeClass('dimResponseOverlay');
		$('.dim').hide();
	});

	//****************************//
	//* Populate responseOverlay *//
	//****************************//
	function populateOverlay(theURL){
		//ajax get request
		$.ajax({
			url: theURL,
			type: "GET",
			dataType: "html",   //expect html to be returned
			beforeSend: function() {
				//reset perfectScrollbar
            	$(".responseOverlay").perfectScrollbar("destroy");
            },
			success: function(response){
				//add contents
				$('.responseOverlayContent').html(response);
				//add scrollbar
				$('.responseOverlay').perfectScrollbar();
				//show response
				$('.responseOverlay').show();
				//dims all but navbar
				$('.dim').show();
				//bumps dim over navBar
				$('.dim').addClass('dimResponseOverlay');
			}
		});
	}

	//**************************************//
	//*  adjust on screen changes & clicks *//
	//**************************************//

	//when page clicked outside submenu hide divs
	$(document).mouseup(function(e){
		//set container
		var container = $(".dropItems");
		// if the target of the click isn't the container 
		// nor a descendant of the container
		if (!container.is(e.target) 
		&& container.has(e.target).length === 0){
			container.hide();
			$('.submenuNav').css({"background":"none"});
			$('.dropArrow').removeClass('hidden');
			$('.dropTitle').removeClass('fontBold');
		}
	}); 

	//on window scroll
	//hide any open dropdowns with scrollHide
	$(window).scroll(function() {
		if ($(document).scrollTop() > 100){
          	$('.dropItems').hide();
          	$('.dropArrow').removeClass('hidden');
          	$('.dropTitle').removeClass('fontBold');
			$('.submenuNav').css({"background":"none"});
        }
	});

	// checks menus on window resize
    // testing for window size does not
    // work due to differences in css3 media query
    // and jquery $window.width()

    // on window resize
    // run test on initial page load
    checkSize();

    // run test on resize of the window
    $(window).resize(checkSize);

	//Function to the css rule
	function checkSize(){
		//revert menu icons to default
		$('.menuIcon i').addClass('ti-menu');
		$('.menuIcon i').removeClass('ti-close');
		//hide menu if smaller screen
	    if ($(".navTop .container-fluid").css("text-align") == "center" ){
	        $('.responsiveMenu').hide();
	    }else{
	    	$('.responsiveMenu').show();
	    }
	}

});