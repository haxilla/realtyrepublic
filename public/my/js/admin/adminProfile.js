$(function() {

	//when change photo is clicked
	$('body').on('click','.adminPhotoButton', function(e){
		e.preventDefault();
		//hide
		$('.photoLogoDiv').hide();
		$('.adminPhotoPreviewDiv').hide();
		$('.adminPhotoDeleteDiv').hide();
		//show
		$('.addAdminPhotoDiv').show();
		$('.adminPhotoFormDiv').show();
		$('.photoCancelDiv').show();
		//reset
		$("#adminPhotoChoice").val(null);

	});

	//when file selected
	$('body').on('change','#adminPhotoChoice', function(e){
		//check for valid file type
		var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
		//error if incorrect type
		if ($.inArray($(this).val().split('.')
			.pop().toLowerCase(), fileExtension) == -1) {
			//alert
			alert("Only formats are allowed : "+fileExtension.join(', '));
			//revert to original state
			$("#adminPhotoChoice").val(null);
			//show
			$('.photoLogoDiv').show();
			//hide
			$('.addProfilePhotoDiv').hide();
		}else{
			//otherwise ok, show preview
			$('.profileImageLoading').show();
			$('.adminPhotoFormDiv').hide();
			$('.photoCancelDiv').hide();
			adminPhotoPreview(this);
		}
	});

	$('body').on('click','.cancelPhotoLogo', function(e){
		//reset value
		$("#adminPhotoChoice").val(null);
		//show
		$('.photoLogoDiv').show();
		//hide
		$('.addAdminPhotoDiv').hide();
	});

	//deletePhoto
	$('body').on('click','.deletePhotoButton', function(e){
		e.preventDefault();
		//hide
		$('.photoLogoDiv').hide();
		$('.adminPhotoFormDiv').hide();
		$('.adminPhotoPreviewDiv').hide();
		//show
		$('.addAdminPhotoDiv').show();
		$('.adminPhotoDeleteDiv').show();
	});

	$('body').on('click','.photoDeleteConfirm', function(e){

		e.preventDefault();
		//make ajax request to delete
		var ajax = new XMLHttpRequest();

		// Setup our listener to process completed requests
		ajax.onload = function () {
			// Process our return data
			if (ajax.status >= 200 && ajax.status < 300) {
				// Runs when the request is successful
				var response 	= JSON.parse(ajax.responseText);
				var status 		= response.status
				var message    	= response.message;
				alert(status+'! '+message)
				//jquery
				if(status=='Success'){

					var agtPhotoURL='images/admin/profilePhotos/noProfilePhoto3.jpg'
					$('.photoLogoDiv').show();
					$('.addAdminPhotoDiv').hide();
					$('.adminPhotoDisplay').attr('src', agtPhotoURL);
					$('.hasPhoto').hide();
					//$('.agentPhotoPresent').show();
					//$('.agentPhotoDeleted').hide();
				}else{
					alert('error');
				}

			} else {
				// Runs when it's not
				alert('error');
			}
		};

		//url to send to
		ajax.open("GET", "/admin/deleteProfilePhoto");
		ajax.send();

	});

	//preview agtPhoto
	function adminPhotoPreview(input) {
		//check input for files
		if (input.files && input.files[0]){
			//set reader
			var reader = new FileReader();
			//change source
			reader.onload = function(e){
				$('.adminPhotoPreview').attr('src', e.target.result);
				$('.profileImageLoading').hide();
				$('.adminPhotoPreviewDiv').show();}

			//preview
			reader.readAsDataURL(input.files[0]);}
	}

	//photo upload confirmed
	$('body').on('click','.photoUploadConfirm', function(e){
		//get input
		var input 	 = document.getElementById('adminPhotoForm');
		var thisFile = input['file'].files[0];
		//set formData
		var formData1 = new FormData();
		//set resize
		ImageTools.resize(thisFile, {
         width: 500, // maximum width
         height: 500// maximum height
       },
       function(blob, didItResize) {
         //set originalName
         originalName=thisFile.name;
         // didItResize will be true if it managed to resize it,
         // otherwise false (and will return the original file as 'blob')
         if(didItResize){
           blobname='r500-'+originalName;
         }else{
           blobname='o-'+originalName;}
         //append blob
         formData1.append('fileSelect',blob,blobname);
         formData1.append('originalName',originalName)
         //send now function
         sendAdminPhoto(formData1)
       });
	});

	//send agtPhoto
	function sendAdminPhoto(formData){
		//open new request
		var ajax = new XMLHttpRequest();
		//set token
		token = document.querySelector('meta[name="csrf-token"]').content;
		//post
      ajax.open("POST", "/admin/addProfilePhoto");
      //send token
      ajax.setRequestHeader('X-CSRF-TOKEN', token);
      //send data
      ajax.send(formData);
      //listener for load complete
      ajax.addEventListener("load", function (e) {
		if (ajax.status === 200){
			//set response
			var response = JSON.parse(ajax.responseText);
			//set variables
			status=response.status;
			//check status
			if(status=='Success'){
				var agtPhotoURL='/'+response.newFilePath
				$('.photoLogoDiv').show();
				$('.addAdminPhotoDiv').hide();
				$('.adminPhotoDisplay').attr('src', agtPhotoURL);
				$('.hasPhoto').removeClass('displayNone');
				//$('.agentPhotoPresent').show();
				//$('.agentPhotoDeleted').hide();
			}else{
				alert('error');
			}
		}else{
			alert('error');}
		});
	}

	$('body').on('click','.adminProfileSubmit',function(e){
		//prevent default
		e.preventDefault();
		//set vars
		theForm=$('#adminProfileForm').serialize();
		theURL="/admin/profileUpdate";
		//send
		ajaxSubmitForm(theURL,theForm);

	});

	function ajaxSubmitForm(theURL,theForm){
		// process the form
		$.ajax({
		   type        : 'POST', 						 // define the type of HTTP verb
		   url         : theURL, // the url where we to POST
		   data        : theForm, 					 // our data object
		   dataType    : 'json', 						 // data to expect from server
		   encode      : true
		})
		// using the done promise callback
		.done(function(data){

			var response=JSON.stringify(data);
            //Parse response
            var jsonObject=JSON.parse(response);
            //begin variables
            var adminName=jsonObject.adminName;
			//report errors
			if (data.errors){
				//clear
				$('.alert-danger').show();
				$('.alert-danger').html("");
				//append error lines
				$.each(data.errors, function(key, value){
					$('.alert-danger').append(value+'<BR>');
				});
			}else{
				$('.alert-danger').hide();
				$('.adminName').html(adminName);
				alert('Information Saved Successfully!');}

		})
		// using the fail promise callback
		.fail(function(data) {
			// show any errors
			// best to remove for production
			alert('failed!');
		});

	}

});
