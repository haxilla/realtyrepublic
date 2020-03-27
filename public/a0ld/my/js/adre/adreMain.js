$(function(){

	$('.adreLink').click(function(e){
		var thisLink=$(this).data("thislink")
		console.log(thisLink);
		$('.'+thisLink+'.iframe').show();
	});

});