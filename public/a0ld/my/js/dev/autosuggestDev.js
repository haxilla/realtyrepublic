$(function(){

	$('.tasksearchField').keyup(function(e){

		//get val from field
		tasksearch=$(this).val();
		tasksearch=tasksearch.trim();

		//send request if not blank
		if(tasksearch){
			//set URL
			var theURL='/dev/autoSuggest?tasksearch='+tasksearch;
			//send for data
			autosuggestDevAjax(theURL);
		}else{
			//blank if empty
			$('.tasksearchResults').html("");}

	});

	function autosuggestDevAjax(theURL){
		//ajax call
		$.ajax({
			//parameters
			url: theURL,
			type: "GET",
			dataType: "html",   //expect html
			//on success
			success: function(response){
				$(".tasksearchResults").html(response);
			},
			//on error
			error: function(xhr, textStatus, errorThrown){
				alert(errorThrown);
			}
		});
	}

});