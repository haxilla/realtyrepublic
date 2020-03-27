$(function(){
	//on change event
	$('#myfile').change(function(evt) {
        //set formdata  
	    formdata = new FormData();
	    type="POST";
	    theURL	 = '/admin/adre/fileUpload';
	    //if file present
	    if($(this).prop('files').length > 0){
	        file =$(this).prop('files')[0];
        	formdata.append("formFile", file);
	    //otherwise error & quit
	    }else{
	    	alert('no file')
	    	return false;}

	    //send data via ajax
	    sendFile(formdata,theURL,type);

    });

	function sendFile(formdata,theURL,type){
		$.ajax({
		    url: theURL,
		    type: type,
		    data: formdata,
		    dataType: "json",
		   	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		    processData: false,
		    contentType: false,
		    success: function (data) {
		        //stringify to decode object and make it parseable
				var response=JSON.stringify(data);
				//Parse response
				var jsonObject=JSON.parse(response);
				var theStatus=jsonObject.theStatus;
				alert(theStatus);
		    },
		    error: function(xhr, textStatus, errorThrown){
		    	// error
		    	alert(errorThrown);
		    }
		});
	}

});