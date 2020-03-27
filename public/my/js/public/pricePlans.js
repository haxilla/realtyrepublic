$(function(){

  $('.overlayClick').click(function(){
    thisClick=$(this).data("thisclick");
    theURL='/publicOverlay?populate='+thisClick;
    publicOverlay(theURL);
  });

  $('body').on('click','.publicOverlayClose', function(e){
    $('.publicOverlay').hide();
    $('.publicOverlayClose').hide();
    $("body").removeClass("disable-scroll");
  });

  //****************************//
	//* Populate publicOverlay *//
	//****************************//
	function publicOverlay(theURL){
		//ajax get request
		$.ajax({
			url: theURL,
			type: "GET",
			dataType: "html",   //expect html to be returned
			success: function(response){
        //add contents
        $('.render').html(response);
        $('.publicOverlay').show();
        $('.publicOverlayClose').show();
        $("body").addClass("disable-scroll");
			},
			error: function(xhr, textStatus, errorThrown){
				alert(errorThrown);
			}

		});

	}

});
