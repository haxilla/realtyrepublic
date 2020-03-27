$(function() {
	//when change photo is clicked
	$('a.changeAgtPhoto').click(function(e){
		e.preventDefault();
		//hide
		$('.photoLogoDiv').hide();
		$('.agtPhotoPreviewDiv').hide();
		$('.agtPhotoDeleteDiv').hide();
		//show
		$('.addAgtPhotoDiv').show();
		$('.agtPhotoFormDiv').show();		
		$('.photoCancelDiv').show();
		//reset
		$("#agtPhotoChoice").val(null);

	});
	//change logo
	$('a.changeAgtLogo').click(function(e){
		e.preventDefault();
		//hide
		$('.photoLogoDiv').hide();
		$('.agtLogoPreviewDiv').hide();
		$('.agtLogoDeleteDiv').hide();
		//show
		$('.addAgtLogoDiv').show();
		$('.agtLogoFormDiv').show();		
		$('.logoCancelDiv').show();
		//reset
		$("#agtLogoChoice").val(null);

	});

	//when agtPhotoChoice select a file
	$("#agtPhotoChoice").change(function() {
		//check for valid file type
		var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
		//error if incorrect type
		if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
			//alert
			alert("Only formats are allowed : "+fileExtension.join(', '));
			//revert to original state
			$("#agtPhotoChoice").val(null);
			$("#agtLogoChoice").val(null);
			//show
			$('.photoLogoDiv').show();
			//hide
			$('.addAgtPhotoDiv').hide();
			$('.addAgtLogoDiv').hide();
		}else{
			//otherwise ok, show preview
			$('.profileImageLoading').show();
			$('.agtPhotoFormDiv').hide();
			$('.photoCancelDiv').hide();
			agtPhotoPreview(this);
		}
	});

	//when agtLogoChoice selects a file
	$("#agtLogoChoice").change(function() {
		//check for valid file type
		var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
		//error if incorrect type
		if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
			//alert
			alert("Only formats are allowed : "+fileExtension.join(', '));
			//revert to original state
			$("#agtPhotoChoice").val(null);
			$("#agtLogoChoice").val(null);
			//show
			$('.photoLogoDiv').show();
			//hide
			$('.addAgtPhotoDiv').hide();
			$('.addAgtLogoDiv').hide();
		}else{
			//otherwise ok, show preview
			$('.profileImageLoading').show();
			$('.agtPhotoFormDiv').hide();
			$('.agtLogoFormDiv').hide();
			$('.photoCancelDiv').hide();
			agtLogoPreview(this);
		}
	});

	$('.cancelPhotoLogo').click(function(e){
		//reset value
		$("#agtPhotoChoice").val(null);
		//show		
		$('.photoLogoDiv').show();
		//hide
		$('.addAgtPhotoDiv').hide();
		$('.addAgtLogoDiv').hide();
	});

	//delete agtPhoto
	$('.deleteAgtPhoto').click(function(e){
		e.preventDefault();
		//hide
		$('.photoLogoDiv').hide();
		$('.agtPhotoFormDiv').hide();
		$('.agtPhotoPreviewDiv').hide();
		//show
		$('.addAgtPhotoDiv').show();
		$('.agtPhotoDeleteDiv').show();
	});

	//delete agtLogo
	$('.deleteAgtLogo').click(function(e){
		e.preventDefault();
		//hide
		$('.photoLogoDiv').hide();
		$('.agtLogoFormDiv').hide();
		$('.agtLogoPreviewDiv').hide();
		//show
		$('.addAgtLogoDiv').show();
		$('.agtLogoDeleteDiv').show();
	});

	$('.photoDeleteConfirm').click(function(e){
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
				var message    = response.message;
				alert(status+'! '+message)
				//jquery
				//hide
				$('.agtPhotoDeleteDiv').hide();
				$('.addAgtPhotoDiv').hide();
				//show
				$('.photoLogoDiv').show();
				
				//final display
				$('.agentPhotoPresent').hide();
				$('.agentPhotoDeleted').show();
			} else {
				// Runs when it's not
				alert('error');
			}
		};

		//url to send to
		ajax.open("GET", "/member/deleteAgentPhoto");
		ajax.send();

	});

	$('.logoDeleteConfirm').click(function(e){
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
				var message    = response.message;
				alert(status+'! '+message)

				//jquery 
				//hide
				$('.agtLogoDeleteDiv').hide();
				$('.addAgtLogoDiv').hide();
				//show
				$('.photoLogoDiv').show();

				//final display
				$('.agentLogoPresent').hide();
				$('.agentLogoDeleted').show();

			} else {

				// Runs when it's not
				alert('error');

			}
		};
		
		//url to send to
		ajax.open("GET", "/member/deleteAgentLogo");
		ajax.send();

	});

	//preview agtPhoto
	function agtPhotoPreview(input) {
		//check input for files
		if (input.files && input.files[0]){
			//set reader
			var reader = new FileReader();
			//change source
			reader.onload = function(e){
				$('.agtPhotoPreview').attr('src', e.target.result);
				$('.profileImageLoading').hide();
				$('.agtPhotoPreviewDiv').show();}

			//preview
			reader.readAsDataURL(input.files[0]);}
	}
	
	//preview agtLogo
	function agtLogoPreview(input) {
		//check input for files
		if (input.files && input.files[0]){
			//set reader
			var reader = new FileReader();
			//change source
			reader.onload = function(e){
				$('.agtLogoPreview').attr('src', e.target.result);
				$('.profileImageLoading').hide();
				$('.agtLogoPreviewDiv').show();}

			//preview
			reader.readAsDataURL(input.files[0]);}
	}
	
	//photo upload confirmed
	$('.photoUploadConfirm').click(function(e){
		//get input
		var input 	 = document.getElementById('agtPhotoForm');
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
         sendAgtPhoto(formData1)
       });
	});

	//logo upload confirmed
	$('.logoUploadConfirm').click(function(e){
		//get input
		var input 	 = document.getElementById('agtLogoForm');
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
         sendAgtLogo(formData1)
       });
	});

	//send agtPhoto
	function sendAgtPhoto(formData){
		//open new request
		var ajax = new XMLHttpRequest();
		//set token
		token = document.querySelector('meta[name="csrf-token"]').content;
		//post
      ajax.open("POST", "/member/addAgentPhoto");
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
				$('.addAgtPhotoDiv').hide();
				$('.agtProfilePhoto').attr('src', agtPhotoURL);
				$('.agentPhotoPresent').show();
				$('.agentPhotoDeleted').hide();
			}else{
				alert('error');
			}
		}else{
			alert('error');}
		});
	}
	//send agtLogo
	function sendAgtLogo(formData){
		//open new request
		var ajax = new XMLHttpRequest();
		//set token
		token = document.querySelector('meta[name="csrf-token"]').content;
		//post
      ajax.open("POST", "/member/addAgentLogo");
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
				
				//logo URL
				var agtLogoURL='/'+response.newFilePath
				$('.agtProfileLogo').attr('src', agtLogoURL);

				//show
				$('.photoLogoDiv').show();
				$('.agentLogoPresent').show();

				//hide
				$('.addAgtLogoDiv').hide();
				$('.agentLogoDeleted').hide();

			}else{
				alert('error');
			}
		}else{
			alert('error');}
		});
	}


});