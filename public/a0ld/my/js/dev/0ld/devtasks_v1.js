$(function(e){

	$('.taskOptions .inlineBlock').click(function(e){
		taskClick=$(this).data("taskclick");
		taskID=$(this).closest('.taskBox').data("taskid");
		
		if(taskClick=='addcomment'){
			$('.commentAdd'+taskID).show();
			$('.commentAddField').val("");
			$('.commentAddField').focus();}

	});

	//add comment blur
	$('.commentAddField').blur(function(e){
		//hide input
		$('.inputDiv').hide();
		//set text & ID
		theText=$(this).val();
		taskID=$(this).closest('form').attr("id");
		formVal=$('.commentAddForm'+taskID).serialize();
		theURL='/dev/commentAjax?taskID='+taskID;
		//submit form
		commentAjax(theURL,formVal);

	});

	//click to edit
	$('.commentShow').click(function(e){
		commentID=$(this).closest('.taskComment').data("commentid");
		$(this).closest('.taskComment').removeClass('roundedResponsive');
		$('.commentShow'+commentID).hide();
		$('.commentEdit'+commentID).show();
		$('.commentEditField').focus();
	});
	//click to exit
	$('.commentEditField').blur(function(e){
		taskComment=$(this).val();
		commentID=$(this).closest('.taskComment').data("commentid");
		$(this).closest('.taskComment').addClass('roundedResponsive');
		$('.commentShow'+commentID+' .taskCommentSpan').text(taskComment);
		$('.commentShow'+commentID).show();
		$('.commentEdit'+commentID).hide();
	});

	//monitor keystrokes for autosave & enter keypress
	$(".taskBox").on("keyup",".commentEditField", function(e){
		//preventDefault
		e.preventDefault();
		//get commentID
		var commentID=$(this).closest('.taskComment').data("commentid");
		//get value in field
		taskComment=$(this).val();
		//if enter key, exit
		if ( e.keyCode == 13){
			$('.commentEdit').hide();
			$('.commentShow'+commentID+' .taskCommentSpan').text(taskComment);
			$('.commentShow'+commentID).show();}

		//autosave comment
		var url='/dev/commentAjax?commentID='+commentID;
		var formVal=$(".commentEditForm"+commentID).serialize();

		commentAjax(url,formVal);

	});


	//checkboxes
	$(".taskBox").on("change","input:checkbox", function(e){
		//find closest id 
		taskDiv=$(this).closest('.taskComment').attr("id");
		taskID=$(this).closest('.taskComment').data("taskid");		
		commentID=$(this).closest('.taskComment').data("commentid");
		//if checked or not
		if ($(this).is(':checked')) {
			
			$('#'+taskDiv).prependTo('.ajaxNewComment'+taskID).addClass('taskCommentNew');
			$('.ajaxNewComment'+taskID).css({"visibility":"visible"});
			theURL='/dev/commentFlag?flag=1&commentID='+commentID;
			ajaxCommentFlag(theURL);

		}else{
			
			$('#'+taskDiv).prependTo('.ajaxComment'+taskID).removeClass('taskCommentNew');
			$('.ajaxComment'+taskID).css({"visibility":"visible"});
			theURL='/dev/commentFlag?flag=0&commentID='+commentID;
			ajaxCommentFlag(theURL);

		}

	});

	//ajax request for autosave on key stroke
	function commentAjax(theURL,formVal){

		$.ajax({
		url:        theURL,
		type:       "POST",
		dataType:   "json",
		data:       formVal,
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			success: function(data) {
				
				//stringify to decode object and make it parseable
				var response=JSON.stringify(data);
				//Parse response
				var jsonObject=JSON.parse(response);
				var newComment=jsonObject.newComment;
				var taskComment=jsonObject.taskComment;
				var commentID=jsonObject.commentID;
				var taskID=jsonObject.taskID;

				//get date
				var d = new Date();
				var curr_day = d.getDate();
				var curr_month = d.getMonth()+1;
				var curr_year = d.getFullYear();
				if(curr_month<10){
					curr_month='0'+curr_month;}

				if(newComment==1){
					//append div
					$('.ajaxNewComment'+taskID).append("<div class='taskComment taskCommentNew'"+ 
						"id='taskComment"+commentID+"' data-taskid='"+taskID+"'"+
						"data-commentid='"+commentID+"'>"+
						"<div class='taskCommentCheck inlineBlock'>"+
							"<label class='checkContainer'>"+
								"<input type='checkbox' checked='checked'>"+
								"<span class='checkmark'></span>"+
							"</label>"+
						"</div>"+
						"<div class='taskCommentText inlineBlock'>"+
							"<span style='opacity:.7'>"+
								curr_year+'-'+curr_month+'-'+curr_day+' '+
							"</span>"+taskComment+
						"</div>"+
					"</div>");

					//make visible
					$('.ajaxNewComment'+taskID).css({"visibility":"visible"});
				}

			},
			error: function(xhr, textStatus, errorThrown){
				alert(errorThrown);
			}
		});

	}

	function ajaxCommentFlag(theURL){

		$.ajax({
		url:        theURL,
		type:       "GET",
		dataType:   "json",

			success: function(data) {
				console.log('all good!')
			},
			error: function(xhr, textStatus, errorThrown){
				alert(errorThrown);
			}

		});

	}



});