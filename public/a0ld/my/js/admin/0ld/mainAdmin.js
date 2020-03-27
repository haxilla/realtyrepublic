$(function(){

	//when action clicked
	$('.action-icons a').click(function(e){
		e.preventDefault();
		//set vars
		theID=$(this).data("id");
		theAction=$(this).data("action");
		
		if(theAction=='edit'){
			window.location.replace('/admin/flyerEdit?id='+theID);}

	});

});
