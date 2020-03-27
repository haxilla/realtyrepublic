$(function(){
	//settings
    $('.listingSlide').slick({
        infinite: true,
        nextArrow: '<span class="ti-angle-right customNext hidden"></span>',
        prevArrow: '<span class="ti-angle-left customPrev hidden"></span>',
        slidesToShow: 5,
        centerMode:true,
        responsive: [{
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                centerMode:false,
            }
        }]
    });

	// to fix issue with carousel not showing in inactive tab
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		$('.topViewSlide').slick('setPosition',0);
        $('.newAddSlide').slick('setPosition',0);
	});

    //show arrows when stage hovered
	$('.slick-stage').hover(function(e){
		theID=$(this).attr("id");
		$('#'+theID+' .slickLeft').toggleClass('hidden');
		$('#'+theID+' .slickRight').toggleClass('hidden');
		$('#'+theID+' .customPrev').toggleClass('hidden');
		$('#'+theID+' .customNext').toggleClass('hidden');
	});

	//show arrows if placed in tab
	$('.tab-pane').hover(function(e){
		theID=$(this).attr("id");
		$('#'+theID+' .slickLeftLight').toggleClass('hidden');
		$('#'+theID+' .slickRightLight').toggleClass('hidden');
		$('#'+theID+' .customPrev').toggleClass('hidden');
		$('#'+theID+' .customNext').toggleClass('hidden');
	});

	//grow on img hover
	$('.indexListing img').hover(function(e){

		var firstSlide;
		var lastSlide;
		var otherSlide;
		var notFirst=$(this).closest('.slick-active').prev('.slick-active').length;
		var notLast=$(this).closest('.slick-active').next('.slick-active').length;

		if(!notFirst && notLast){
			//first active slide
			firstSlide=1;}

		if(notFirst && !notLast){
			//last active slide
			lastSlide=1;}

		if(!firstSlide && !lastSlide){
			//all other slides
			otherSlide=1;}

		//set variables
		var currentImg=$(this);
		var currentIndex=$(this).closest('.slick-active');
		var currentDiv=currentIndex.children('.defaultPhotoDiv');
		var nextDiv=currentIndex.nextAll().children('.defaultPhotoDiv');
		var prevDiv=currentIndex.prevAll().children('.defaultPhotoDiv');

		// if slick-active class currentIndex will have length
		// center-mode has images that are not slick-active on sides
		if(currentIndex.length){
			currentImg.addClass('height200');
			currentIndex.addClass('pad0');
			currentDiv.addClass('height200');}

		//only for non-first&last
		if(otherSlide){
			currentDiv.addClass('spread50');
			nextDiv.addClass('moveRight50');
			prevDiv.addClass('moveLeft50');}
		//only if first & has slick-active
		if(firstSlide){
			currentDiv.addClass('spread100right moveRight100 padLeft1');
			nextDiv.addClass('moveRight100');}
		//only if last
		if(lastSlide){
			currentDiv.addClass('spread100left moveLeft100 padRight1');
			prevDiv.addClass('moveLeft100');}
		
	},function(e){

		var currentImg=$(this);
		var currentIndex=$(this).closest('.slick-active');
		var currentDiv=currentIndex.children('.defaultPhotoDiv');
		var nextDiv=currentIndex.nextAll().children('.defaultPhotoDiv');
		var prevDiv=currentIndex.prevAll().children('.defaultPhotoDiv');

		currentImg.removeClass('height200');
		currentDiv.removeClass('spread50 height200 spread100right spread100left');
		currentDiv.removeClass('moveLeft100 moveRight100 padLeft1 padRight1');
		currentIndex.removeClass('pad0');
		nextDiv.removeClass('moveRight50 moveRight100');
		prevDiv.removeClass('moveLeft50 moveLeft100');

	});

});