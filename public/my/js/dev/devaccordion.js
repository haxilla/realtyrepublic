$(function(){

	$(".taskBox").on("click",".accordionTab", function(e){
		//set menuClick
		menuclick=$(this).data("menuclick");
		// Hack to make sure the focus 
		// is called after the event has been handled
		setTimeout(function() { 
			$('input[name='+menuclick+']').focus();
		});

	});

});


