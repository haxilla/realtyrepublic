$(function(){

	$('.xMlsNumModalInput').click(function(e){
		$('.alert-danger').hide();
	});

	$('.openCreateNewFlyerModal').click(function(e){
		$('.xMlsNumModalInput').val("");
		$('.alert-danger').hide();
	});

	$('.memberCreateFlyer').click(function(e){
		//prevent default
		e.preventDefault();
		//change modal visuals
		$('.newFlyerModalForm').hide();
		$('.newFlyerModalLoading').show();
		//serialize form & set formData
		var formData=$('.memberNewFlyerForm').serialize();
		// process the form
		$.ajax({
		   type        : 'POST', 						 // define the type of HTTP verb
		   url         : '/member/createNewFlyer', // the url where we to POST
		   data        : formData, 					 // our data object
		   dataType    : 'json', 						 // data to expect from server
		   encode      : true
		})
		// using the done promise callback
		.done(function(data){
			//report errors
         if (data.errors){
         	//show
				$('#createNewFlyerModal .alert-danger').show();
				$('.newFlyerModalForm').show();
				//hide
				$('.newFlyerModalLoading').hide();
				//clear
				$('.alert-danger').html("");
				//append error lines
				$.each(data.errors, function(key, value){
					$('.alert-danger').append(value);
				});
         }else{
     			//all good
     			var importable=data.importable
     			if(importable==1){
     				
     			}else{
     				//redirect to manual flyer creation
     			}
         }

		})
		// using the fail promise callback
		.fail(function(data) {
			// show any errors
			// best to remove for production
			alert('failed!');
		});

	});

});