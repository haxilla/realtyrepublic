$(function(){

	$('.jqclick').click(function(e){
		thisClick=$(this).data("thisclick");
		if(thisClick=='addRets'){
			$('.'+thisClick+'Div').toggleClass('jqhide');
		}else if(thisClick=='retsSubmit'){
			formVal=$('.addRetsForm').serialize();
			retsID=$(this).data("retsid");
			if(retsID){
				theURL='/rets/retsAdd?retsEdit='+retsID;
			}else{
				theURL='/rets/retsAdd';}
			
			retsTask(theURL,formVal);

		}else if(thisClick=='retsEdit'){
			//hide Add Button
			$('.jqclick.retsButton').text('Edit RETS')
			//get data values
			retsID=$(this).data("retsid");
			retsSystem=$(this).data("retssystem");
			retsVersion=$(this).data("retsversion");
			mlsName=$(this).data("mlsname");
			retsURL=$(this).data("retsurl");
			retsUname=$(this).data("retsuname");
			retsPswd=$(this).data("retspswd")
			//set retsID on deletebutton
			$('.retsDeleteLink').data("retsid",retsID);
			//fill in field values
			$('input[name="retsID"]').val(retsID);
			$('input[name="retsSystem"]').val(retsSystem);
			$('input[name="retsVersion"]').val(retsVersion);
			$('input[name="mlsName"]').val(mlsName);
			$('input[name="retsURL"]').val(retsURL);
			$('input[name="retsUname"]').val(retsUname);
			$('input[name="retsPswd"]').val(retsPswd);
			//change submit to showEdit
			$('.formSubmit .theButton').data("retsid",retsID);

			//show Edit Form
			$('.addRetsDiv').toggleClass('jqhide');
			//hide delete button unless its an edit
			if (!$('.addRetsDiv').hasClass('jqhide')){
				$('.retsDeleteLink').removeClass('displayNone');
			}else{
				$('.retsDeleteLink').addClass('displayNone');}
		}else if(thisClick=='retsdelete'){
			retsID=$(this).data("retsid");
			$('#areyousureModal').modal('show');
			$('#areyousureModal .modalAccept').data("retsid",retsID);
		}else if(thisClick=='retsdeleteOK'){
			retsID=$(this).data("retsid");
			type='POST';
			theURL='/rets/retsDelete?retsID='+retsID;
			retsTask(theURL,type);
		}else if(thisClick=='retsSynch'){
			retsID=$(this).data("retsid");
			type='GET';
			progressURL='/rets/retsProgress?monitor=synch&retsID='+retsID;
			synchURL='/rets/retsSynch?retsID='+retsID;
			overlayURL='/rets/retsOverlay?retsID='+retsID;
			retsOverlay(overlayURL,type);
			retsProgress(progressURL,type);
			retsSynch(synchURL,type);
		}else if(thisClick=='retsCompare'){
			type='GET';
			retsID=$(this).data("retsid");
			progressURL="/rets/retsProgress?monitor=compare&retsID="+retsID;
			compareURL="/rets/retsCompare?retsID="+retsID;
			retsProgress(progressURL,type);
			retsCompare(compareURL,type);
		}else{
			alert('error-line55-retsMain.js');}
	});

	//if errors are there hide when clicking input
	$('.addRetsForm .roundedInputBar').focus(function(e){
		$('.formErrorDiv').hide();
	});

	function retsTask(theURL,type,formVal){
		$.ajax({
			headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type        : type, 						 
			url         : theURL, 
			data        : formVal,
			dataType    : 'json', 						 
			encode      : true
		})
		// using the done promise callback
		.done(function(data){

			//report errors
			if (data.errors){
				//show
				$('.formErrorDiv').show();
				//clear
				$('.formErrorDiv').html("");
				//append error lines
				$.each(data.errors, function(key, value){
					$('.formErrorDiv')
					.append('<div>'+value+'</div>');
				});
			}else{
				alert('Entry Submitted Successfully');
				location.reload(true);
			}

		}).fail(function(xhr, textStatus, errorThrown){
			console.log(errorThrown);
			return false;
		});
	}

	function retsProgress(progressURL,type){

		$.ajax({
			headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type        : type, 						 
			url         : progressURL, 
			dataType    : 'json', 						 
			encode      : true
		})
		// using the done promise callback
		.done(function(data){
			
			//variables
			theStatus=data.theStatus;
			thisCount=data.thisCount;
			thisTotal=data.thisTotal;
			thisProcess=data.thisProcess;
			thisPercent=data.thisPercent;
			thisClass=data.thisClass;
			retsID=data.retsID;
			logID=data.logID;
			monitor=data.monitor;

			//progress indication
			$('.rets_thisMonitor').html(monitor);
			$('.rets_thisCount').html(thisCount);
			$('.rets_thisTotal').html(thisTotal);
			$('.rets_thisPercent').html(thisPercent+'%');
			$('.rets_thisProcess').html(thisProcess);
			$('.rets_thisClass').html(thisClass);

			//progress bar
			$('.rets_progress').show();
            $('.rets_progress-bar').css({'width':thisPercent+'%'});

			//theStatus
			if(theStatus=='synchComplete'){
				return false;}

			//theStatus
			if(theStatus=='Complete'){
				return false;}

			//set logID if known
			if(retsID != null && logID !=null){
				//set url
				progressURL="/rets/retsProgress?retsID="+retsID
				+"&logID="+logID+'&monitor='+monitor;}
			
			//continue
			retsProgress(progressURL,type);

		})
		.fail(function(xhr, textStatus, errorThrown){
			console.log(errorThrown);
			return false;
		});

	}

	function retsCompare(compareURL,type){

		$.ajax({
			headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type        : type, 						 
			url         : compareURL, 
			dataType    : 'json', 						 
			encode      : true
		})
		// using the done promise callback
		.done(function(data){

			//variables
			theStatus=data.theStatus;
			
			//terminate if complete
			if(theStatus=='Complete'){
				
				// removes progress Overlay & sends alert
				// dims all but navbar
				$('.dim').removeClass('dimResponseOverlay');
				// bumps dim over navBar
				$('.dim').hide();
				// show response
				$('.responseOverlay').hide();

				alert('Manual Synch Complete!');
				return false;}

			//continue
			retsCompare(compareURL,type);

		})
		.fail(function(xhr, textStatus, errorThrown){
			console.log(errorThrown);
			return false;
		});

	}

	function retsSynch(synchURL,type){

		$.ajax({
			headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type        : type, 						 
			url         : synchURL, 
			dataType    : 'json', 						 
			encode      : true
		})
		// using the done promise callback
		.done(function(data){
			//set vars
			theStatus=data.theStatus;
			retsID=data.retsID;
			logID=data.logID;
			nextSynch=data.nextSynch;

			//if compare
			if(theStatus=='Compare'){			
				//sent to compareURL
				type="GET";
				progressURL="/rets/retsProgress?monitor=compare&retsID="
				+retsID;
				compareURL="/rets/retsCompare?retsID="+retsID;
				retsProgress(progressURL,type);
				retsCompare(compareURL,type);
				//stop
				return false;}

			//terminate if complete
			if(theStatus=='Complete'){
				alert('retsSynch Complete!');
				return false;}

			retsSynch(synchURL,type);		
			
		})
		.fail(function(xhr, textStatus, errorThrown){
			console.log(errorThrown);
			return false;
		});
	}

	function retsOverlay(overlayURL,type){
		//ajax get request
		$.ajax({
			url: overlayURL,
			type: type,
			dataType: "html",   //expect html to be returned
			beforeSend: function() {
				//reset perfectScrollbar
            	$(".responseOverlay").perfectScrollbar("destroy");
            },
			success: function(response){
				//add contents
				$('.responseOverlayContent').html(response);
				//add scrollbar
				$('.responseOverlay').perfectScrollbar();
				//show response
				$('.responseOverlay').show();
				//dims all but navbar
				$('.dim').show();
				//bumps dim over navBar
				$('.dim').addClass('dimResponseOverlay');
			}
		});
	}

});