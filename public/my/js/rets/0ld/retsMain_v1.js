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
				theURL='/rets/retsAdd';
			}
			
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
			type='POST';
			theURL='/rets/retsSynch?retsID='+retsID;
			retsTask(theURL,type);
		}else if(thisClick=='retsCompare'){
			type='GET';
			retsID=$(this).data("retsid");
			theURL="/rets/retsCompare?retsLoop=homePrice&retsID="+retsID;
			retsTask(theURL,type);
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
			}else if(data.ajaxResponse){
				status=data.status
				retsID=data.retsID;
				retsLoop=data.retsLoop;
				lowerCount=data.lowerCount;
				raiseCount=data.raiseCount;
				nextRecord=data.nextRecord;
				homePriceCount=data.homePriceCount;
				//if finished, exit
				if(status=='Complete'){
					alert('allDone!');
					return false;}
				//set URL
				type='GET';
				theURL='/rets/retsCompare?retsID='+retsID+
				'&lowerCount='+lowerCount+'&raiseCount='+raiseCount+
				'&retsLoop='+retsLoop+'&thisRecord='+nextRecord;
				retsTask(theURL,type);
			}else{
				alert('Entry Submitted Successfully');
				location.reload(true);
			}

		}).fail(function(xhr, textStatus, errorThrown){
			alert(errorThrown);
		});
	}

});