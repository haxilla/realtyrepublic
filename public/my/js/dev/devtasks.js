$(function(){

// * fixed menu
	// * New task
	$(".devTask.fixedMenu").on("keypress",".taskaddField", function(e){
		//if enter key, exit
		if (e.keyCode == 13){
			e.preventDefault();
			$('.taskadd.inlineBlock').addClass('circle');
			$('.taskadd.dropMenuBox').hide();
			var theURL='/dev/taskAjax';
			var formVal=$(".taskaddForm").serialize();
			taskAjax(theURL,formVal);}});

	// * clickable
	$('.devTask.fixedMenu .devMenu.clickable').click(function(e){
		//variables
		menuClick=$(this).data("menuclick");
		thisMenuBox=$(this).children('.dropMenuBox');
		//hide all and selectively turn back on
		$('.devTask.fixedMenu .dropMenuBox').hide();
		//toggle
		if(thisMenuBox.hasClass('itsActive')){
			//remove itsActive if already active
			thisMenuBox.removeClass('itsActive');
		}else{
			//show if not active
			$('.devTask.fixedMenu .dropMenuBox').removeClass('itsActive');
			thisMenuBox.addClass('itsActive');
			thisMenuBox.show();}});

	//* devInput
	$('.devTask.fixedMenu .devMenu.devInput').click(function(e){
		menuClick=$(this).data("menuclick");
		thisMenuBox=$(this).children('.dropMenuBox');
		$('.dropMenuBox').removeClass('itsActive').hide();
		thisMenuBox.addClass('itsActive').show();
		$('.'+menuClick+'Field').focus();});

// * tasks
	// * taskshow click
	$(".taskBox").on("click",".taskShow", function(e){
		taskID=$(this).closest('.taskboxFrame').data("taskid");
		taskField=$('.taskEditForm'+taskID+' .taskEditField');
		taskDesc=taskField.val();
		textLength=taskDesc.length;
		if(textLength>57){
			taskField.addClass('largerField');}
		$('.taskShow'+taskID).hide();
		$('.taskEdit'+taskID).show();
		$('.taskEditField').focus();});

	// * taskEditField blur
	$(".taskBox").on("blur",".taskEditField", function(e){
		$(this).removeClass('largerField');
		taskDesc=$(this).val();
		taskID=$(this).closest('.taskboxFrame').data("taskid");
		$('.taskShow'+taskID+' .taskDescSpan').text(taskDesc);
		$('.taskShow'+taskID).show();
		$('.taskEdit'+taskID).hide();});

	// * taskEditField keyup
	$(".taskBox").on("keyup",".taskEditField", function(e){
		// * preventDefault
		e.preventDefault();
		// * get commentID
		var taskID=$(this).closest('.taskboxFrame').data("taskid");
		// * get value in field
		taskDesc=$(this).val();
		// * if enter key, exit
		if ( e.keyCode == 13){
			$('.taskEdit').hide();
			$('.taskShow'+taskID+' .taskDesc').text(taskDesc);
			$('.taskShow'+taskID).show();}
		// * autosave comment
		var url='/dev/taskAjax?taskID='+taskID;
		var formVal=$(".taskEditForm"+taskID).serialize();
		// * send ajax
		taskAjax(url,formVal);});

// * Deletes
	// using mousedown stops screen from disappearing when
	// clicking delete otherwise blur hides the edit div

	// * commentDeleteButton
	$(".taskBox").on("mousedown",".commentDeleteButton", function(e){
		e.preventDefault();
		commentID=$(this).closest('.taskComment').data("commentid");
		theURL='/dev/commentAjax?softDelete=1&commentID='+commentID;
		commentAjax(theURL);
		$(this).closest('.taskComment').remove();});

	// * taskDeleteButton
	$(".taskBox").on("mousedown",".taskDeleteButton", function(e){
		e.preventDefault();
		taskID=$(this).closest('.taskboxFrame').data("taskid");
		theURL='/dev/taskAjax?taskDeleteSoft=1&taskID='+taskID;
		$(this).closest('.taskboxFrame').remove();
		taskAjax(theURL);});

	// * linkDeleteButton
	$(".taskBox").on("mousedown",".linkDeleteButton", function(e){
		e.preventDefault();
		taskID=$(this).closest('.taskboxFrame').data("taskid");

		linkID=$('.linkFields'+taskID).data("linkid");
		theURL='/dev/linkAjax?softDelete=1&linkID='+linkID;
		linkAjax(theURL);
		$('.inputDiv').hide();
		$('.linkTitle,.linkURL').val("");
		$('.tasklink'+linkID).remove();});

// * taskOptions Menu
	$('.taskOptions .inlineBlock').click(function(e){
		taskClick=$(this).data("taskclick");
		taskID=$(this).closest('.taskboxFrame').data("taskid");
		thisTaskBoxFrame=$(this).closest('.taskboxFrame');
		thisTaskBox=$('.taskBox'+taskID);

		if(taskClick=='commentadd'){
			$('.commentAdd'+taskID).show();
			$('.commentAddField').val("");
			$('.commentAddField').focus();}

		if(taskClick=='linkadd'){
			$('.linkFields'+taskID).data('linkid','new');
			$('.linkFields'+taskID).show();
			$('.linkTitle').val("");
			$('.linkURL').val("");
			$('.linkTitle').focus();}

		if(taskClick=='taskcomplete'){
			theURL='/dev/taskAjax?taskComplete=1&taskID='+taskID;
			taskAjax(theURL);}

		if(taskClick=='taskcompleterestore'){
			theURL='/dev/taskAjax?taskCompleteRestore=1&taskID='+taskID;
			taskAjax(theURL);}

		if(taskClick=='taskdeleterestore'){
			theURL='/dev/taskAjax?taskDeleteRestore=1&taskID='+taskID;
			taskAjax(theURL);}

		if(taskClick=='tasksnooze'){
			$(this).toggleClass('circle');
			$(this).children('.dropMenuBox').toggle();}

		if(taskClick=='taskunsnooze'){
			theURL='/dev/taskAjax?taskUnSnooze=1&taskID='+taskID;
			taskAjax(theURL);}

		if(taskClick=='tasksticky'){
			theURL="/dev/taskAjax?tasksticky=1&taskID="+taskID;
			taskAjax(theURL);}

		if(taskClick=='taskbump'){
			theURL='/dev/taskAjax?taskBump=1&taskID='+taskID;
			taskAjax(theURL);}

		if(taskClick=="taskatomopen"){
			theURL='/dev/taskAjax?taskAtomOpen=1&taskID='+taskID;
			taskAjax(theURL);}
			
		if(taskClick=='taskwizard'){
			//remove all but this div
			$('.taskboxFrame').not(thisTaskBoxFrame).remove();
			// * Hide
			// * hide header & footer menus
			$('.taskBox'+taskID+' .taskheaderMenu').hide();
			$('.taskBox'+taskID+' .taskfooterMenu').hide();
			//$('.taskBox'+taskID).addClass('fullVH');
			$('.taskPaginate').hide();
			$('.scrollTop').hide();
			// * Show
			// * show taskSteps
			$('.taskBox'+taskID+' .taskstepFrame').show();
			// * show authLevel menu
			$('.taskheaderMenu'+taskID+' .taskauthlevel')
			.css({"display":"inline-block"});
			// * show backarrow
			$('.devTask .taskback').show();
			// * focus taskstepField first
			$('input[name=taskstep]').focus();
			//center taskDesc
			$('.taskShow'+taskID+'.taskDesc')
			.addClass('text-center');}});

// * taskComments
	// * commentShow click
	$(".taskBox").on("click",".commentShow", function(e){
		commentID=$(this).closest('.taskComment').data("commentid");
		$(this).closest('.taskComment').removeClass('roundedResponsive');
		$('.commentShow'+commentID).hide();
		$('.commentEdit'+commentID).show();
		$('.commentEditField').focus();});

	// * commentEditField keyup
	$(".taskBox").on("keyup",".commentEditField", function(e){
		//preventDefault
		e.preventDefault();
		//get commentID
		var commentID=$(this).closest('.taskComment')
		.data("commentid");
		//get value in field
		taskComment=$(this).val();
		//if enter key, exit
		if ( e.keyCode == 13){
			// * hide commentEdit
			$('.commentEdit').hide();
			// * add contents of taskComment
			$('.commentShow'+commentID+' .taskCommentSpan')
			.text(taskComment);
			// * show commentShow
			$('.commentShow'+commentID).show();}
		// * autosave comment
		var theURL='/dev/commentAjax?commentID='+commentID;
		var formVal=$(".commentEditForm"+commentID).serialize();
		// * send ajax
		commentAjax(theURL,formVal);});

	// * commentAddField Keyup
	$(".taskBox").on("keyup",".commentAddField", function(e){
		//on enter hide input key
		if ( e.keyCode == 13){
			$('.inputDiv').hide();}});

	// * commentEditField Blur
	$(".taskBox").on("blur",".commentEditField", function(e){
		taskComment=$(this).val();
		commentID=$(this).closest('.taskComment').data("commentid");
		$(this).closest('.taskComment').addClass('roundedResponsive');
		$('.commentShow'+commentID+' .taskCommentSpan').text(taskComment);
		$('.commentShow'+commentID).show();
		$('.commentEdit'+commentID).hide();});

	// * commentAddField Blur
	$('.commentAddField,.linkField')
	.blur(function(e){
		//set text & ID
		theText=$(this).val();
		taskID=$(this).closest('.taskboxFrame').data("taskid");
		theclass=$(this).closest('.frame').data("theclass");
		formVal=$('.'+theclass+'AddForm'+taskID).serialize();
		theURL='/dev/'+theclass+'Ajax?taskID='+taskID;
		//submit form
		if(theclass=='comment'){
			//send ajax request
			commentAjax(theURL,formVal);
			//hide input
			$('.inputDiv').hide();
		}else if(theclass=='link'){
			//what is focused element
			focused=$(e.relatedTarget);
			//if field is not title or URL
			if(!focused.hasClass('linkTitle')
			&& !focused.hasClass('linkURL')){
				linkAjax(theURL,formVal);
				$('.inputDiv').hide();
			}

		}else{
			alert('error-line230-devtask.js');}});

	// * When clicking on link icon to edit
	$(".taskBox").on("click",".smaller.circle.linkEdit", function(e){

		taskID=$(this).closest('.taskboxFrame').data("taskid");
		linkID=$(this).closest('.tasklinkDiv').data("linkid");
		thelinkTitle=$(this).next('a').text().trim();
		thelinkURL=$(this).next('a').attr('href').trim();

		$('.linkFields'+taskID).data("linkid",linkID);
		$('.linkFields'+taskID+' input.linkTitle').val(thelinkTitle);
		$('.linkFields'+taskID+' input.linkURL').val(thelinkURL);

		$('.linkFields'+taskID).toggle();

	});


	// * linkAdd, linkEdit Keyup
	$(".taskBox").on("keyup",".linkField", function(e){
		//preventDefault
		e.preventDefault();
		taskID=$(this).closest('.taskboxFrame').data("taskid");
		linkID=$(this).closest('.inputDiv').data("linkid");
		thisField=$(this).prop("name");
		//field values
		linkTitle=$('.linkForm'+taskID+' input[name="linkTitle"]').val().trim();
		linkURL=$('.linkForm'+taskID+' input[name="linkURL"]').val().trim();
		console.log(linkID,linkTitle,linkURL);
		//if new must be added
		if(linkID=='new'){
			//if enter pressed with both fields filled
			if (linkTitle.length && linkURL.length && e.keyCode==13){
				formVal=$(this).closest('form').serialize();
				theURL='/dev/linkAjax?taskID='+taskID;
				linkAjax(theURL,formVal);}

		//if linkID present, then edit
		}else if(linkTitle.length && linkURL.length){
			formVal=$(this).closest('form').serialize();
			theURL='/dev/linkAjax?linkID='+linkID;
			thisVal=$(this).val();
			linkAjax(theURL,formVal);
			if(thisField=='linkTitle'){
				$('.tasklink'+linkID+' a').text(thisVal)
			}else if(thisField=='linkURL'){
				$('.tasklink'+linkID+' a').attr('href',thisVal)
			}else{
				dd('error-line291-devtasks.js');}

		}

		if(e.keyCode==13){
			$('.inputDiv').hide();}

	});


	// * comment checkboxes
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
		}});

// * Header Menu
	// * taskflag
	$('.taskFlag.inlineBlock').click(function(e){
		var taskID=$(this).closest('.taskboxFrame').data("taskid");
		if($(this).hasClass('bg-red')){
			$(this).removeClass('bg-red').addClass('lighter2');
			theURL='/dev/taskAjax?taskUnflag=1&taskID='+taskID;
			taskAjax(theURL);
		}else{
			$(this).removeClass('lighter2').addClass('bg-red');
			theURL='/dev/taskAjax?taskFlag=1&taskID='+taskID;
			taskAjax(theURL);}});

	// * tasksection
	$('.tasksection.inlineBlock').click(function(e){
		menuClick=$(this).data("menuclick");
		$(this).children('.lighter2').toggleClass('rounder');
		taskID=$(this).closest('.taskboxFrame').data('taskid');
		thisMenuBox=$('.'+menuClick+taskID+'.dropMenuBox');
		thisMenuBox.toggle();});

	// * taskauthlevel
	$('.taskauthlevel.inlineBlock').click(function(e){
		menuclick=$(this).data("menuclick");
		$(this).children('.lighter2').toggleClass('circle');
		taskID=$(this).closest('.taskboxFrame').data('taskid');
		thisMenuBox=$('.'+menuclick+taskID+'.dropMenuBox');
		thisMenuBox.toggle();});

// * Footer menu
	//* tasktype
	$('.tasktype.inlineBlock').click(function(e){
	menuclick=$(this).data("menuclick");
	$(this).children('.dropMenu').toggleClass('rounder');
	taskID=$(this).closest('.taskboxFrame').data('taskid');
	thisMenuBox=$('.'+menuclick+taskID+'.dropMenuBox');
	thisMenuBox.toggle();});

// * MenuItems Header
	// * tasksection
	$('.taskheaderMenu .tasksection .menuItem a').click(function(e){
		// * prevent Default
		e.preventDefault();
		// * get menuclick
		menuclick=$(this).data("menuclick");
		// * taskID
		taskID=$(this).closest('.taskboxFrame').data("taskid");
		// * listRef
		listRef=$(this).closest('.taskboxFrame').data("listref");
		// * status
		taskstatus=$(this).closest('.taskboxFrame').data("taskstatus");
		// * set theURL
		var theURL='/dev/taskAjax?taskSection='+menuclick+'&taskID='+taskID+
		'&listRef='+listRef+'&taskstatus='+taskstatus;
		//send ajax request
		taskAjax(theURL);});

	// * taskauthlevel
	$('.taskheaderMenu .taskauthlevel .menuItem a').click(function(e){
		e.preventDefault();
		// * menuClick
		menuclick=$(this).data("menuclick");
		// * taskID
		taskID=$(this).closest('.taskboxFrame').data("taskid");
		// * set theURL
		var theURL='/dev/taskAjax?taskauthlevel='+menuclick+'&taskID='+taskID;
		// * send ajax request
		taskAjax(theURL);});

//* MenuItems Footer
	// * tasktype
	$('.taskBox .tasktype .menuItem a').click(function(e){
		// * prevent default
		e.preventDefault();
		menuclick=$(this).data("menuclick");
		taskID=$(this).closest('.taskboxFrame').data("taskid");
		listRef=$(this).closest('.taskboxFrame').data("listref");
		taskstatus=$(this).closest('.taskboxFrame').data("taskstatus");
		// set theURL
		var theURL='/dev/taskAjax?taskType='+menuclick+'&taskID='+taskID+
		'&listRef='+listRef+'&taskstatus='+taskstatus;
		// send ajax request
		taskAjax(theURL);});

	// * taskSnooze
	$('.taskSnooze.dropMenuBox .menuItem a').click(function(e){
		// * prevent Default
		e.preventDefault();
		// * get snoozeTimer
		var snoozeTimer=$(this).data("snoozetimer");
		// * taskID
		var taskID=$(this).closest('.taskboxFrame')
		.data("taskid");
		// * the URL
		theURL='/dev/taskAjax?taskSnooze=1&taskID='
		+taskID+'&snoozeTimer='+snoozeTimer;
		// * send ajax
		taskAjax(theURL);});



// * misc
	// * devInputClose
	$('.devInputClose').click(function(e){
		// * use stopPropagation since its within devInput
		// * which would also run and cause the div to show
		e.stopPropagation();
		$(this).closest('.dropMenuBox').removeClass('itsActive').hide();});

	$('.reloadPage.inlineBlock').click(function(e){

		var taskstatus=$(this).data("taskstatus");
		window.location.replace("/dev/index?taskstatus="+taskstatus);

	});

// * Scroll
	// * scroll to top when clicked
	$('.devTask .scrollTop').click(function(e){
		$(document).scrollTop('0');});

// * Mouse Up
    // * when page clicked outside of dropmenus
	$(document).mouseup(function(e){
		// * set container
		var container = $(".dropMenuBox");
		var taskRounder=$('.tasksection .lighter2, .tasktype .dropMenu');
		var taskCircle=$('.taskOptions .small, .taskauthlevel .small');

		// * if the target of the click isn't the container
		// * nor a descendant of the container
		if (!container.is(e.target)
		&& container.has(e.target).length === 0){
			container.hide();
			taskRounder.addClass('rounder');
			taskCircle.addClass('circle');
			container.removeClass('itsActive');
		}
	});


// * FUNCTIONS
// * taskAjax
	// * handles all task modifications
	function taskAjax(theURL,formVal){
		// * start ajax call
		$.ajax({
		url:        theURL,
		type:       "POST",
		dataType:   "json",
		data:       formVal,
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			success: function(data){
				//stringify to make it parseable
				var response=JSON.stringify(data);
				//Parse response
				var jsonObject=JSON.parse(response);
				var status=jsonObject.status;
				var taskoption=jsonObject.taskoption;
				var taskstatus=jsonObject.taskstatus;
				var tasktype=jsonObject.tasktype;
				var oldBadge=jsonObject.oldBadge;
				var newBadge=jsonObject.newBadge;
				var tasksection=jsonObject.tasksection;
				var taskauthlevel=jsonObject.taskauthlevel;
				var taskID=jsonObject.taskID;
				var reload=jsonObject.reload;
				var redirect=jsonObject.redirect;

				// reload if new
				if(status=='reload'||reload==1){
					location.reload(true);}

				// if redirect set
				if(redirect=='Tip'){
					window.location.replace("/dev/index?taskstatus=Tips");}
				if(redirect=='Excuse'){
					window.location.replace("/dev/index?taskstatus=Excuses");}
				if(redirect=='Task'){
					window.location.replace("/dev/index?taskstatus=Active");}

				//change sectionBadge
				if(taskoption=='tasksection'){
					$('.tasksection .dropMenu'+taskID).text(tasksection);}
				if(taskoption=='taskauthlevel'){
					$('.taskauthlevel .dropMenu'+taskID).text(taskauthlevel);}
				if(taskoption=='tasktype'){
					$('.tasktype .dropMenu'+taskID)
					.text(tasktype)
					.addClass(newBadge)
					.removeClass(oldBadge);}
				//if changed to clear
				if(newBadge=='taskBadgeNew'){
					$('.tasktype .dropMenu'+taskID)
					.text('New!');}
				if(newBadge=='taskBadgeNone'){
					$('.tasktype .dropMenu'+taskID)
					.html('<span class="mr15">'+
						'<i class="ti-help-alt"></i>'+
					'</span>'+
					'<span class="angleDown">'+
						'<i class="ti-angle-down"></i>'+
					'</span>')
					.addClass(newBadge)
					.removeClass(oldBadge);}
			},
			error: function(xhr, textStatus, errorThrown){
				alert(errorThrown);
			}
		});

	}

// * commentAjax
	// * handles all comment modifications
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

				if(newComment==1){

					//get date
					var d = new Date();
					var curr_day = d.getDate();
					var curr_month = d.getMonth()+1;
					var curr_year = d.getFullYear();
					if(curr_month<10){
						curr_month='0'+curr_month;}

					//append div
					$('.ajaxNewComment'+taskID).prepend("<div "+
					"class='taskComment taskCommentNew roundedResponsive' "+
					"id='taskComment"+commentID+"' data-taskid='"+taskID+"'"+
					"data-commentid='"+commentID+"'>"+
						"<div class='commentShow commentShow"+commentID+"'>"+
							"<div class='taskCommentCheck inlineBlock'>"+
								"<label class='checkContainer'>"+
								  "<input type='checkbox' checked='checked' name='taskCheck'>"+
								  "<span class='checkmark'></span>"+
								"</label>"+
							"</div>"+
							"<div class='taskCommentText inlineBlock'>"+
								"<span style='opacity:.7'>"+
									curr_year+'-'+curr_month+'-'+curr_day+' '+
								"</span><span class='taskCommentSpan'>"+
									taskComment+
								"</span>"+
							"</div>"+
						"</div>"+
						"<div class='commentEdit commentEdit"+commentID+"'>"+
							"<div class='commentEditDiv'>"+
								"<form class='commentEditForm"+commentID+"' id='"+commentID+"'>"+
									"<textarea name='taskComment' class='commentEditField"+
									" noScroll noResize'>"+taskComment+"</textarea>"+
								"</form>"+
							"</div>"+
							"<div class='commentDeleteDiv'>"+
								"<div class='commentDeleteButton' data-toggle='tooltip' title='Delete Comment'>"+
									"<i class='ti-close'></i>"+
								"</div>"+
							"</div>"+
						"</div>"+
					"</div>")

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

// * linkAjax
	// * handles all link modifications
	function linkAjax(theURL,formVal){

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
				var newLink=jsonObject.newLink;
				var linkTitle=jsonObject.linkTitle;
				var linkURL=jsonObject.linkURL;
				var linkID=jsonObject.linkID;
				var taskID=jsonObject.taskID;
				if(newLink==1){
					$('.taskBox'+taskID+' .linksFrame')
					.append(
						'<div class="tasklinkDiv tasklink'+linkID+'"'+
						'data-menuclick="tasklink" data-linkid='+linkID+'>'+
							'<div class="inlineBlock smaller circle '+
							'linkEdit bg-white m5 ml0" style="color:#223e94;'+
							'font-size:.80em;">'+
								'<i class="ti-link"></i>'+
							'</div>'+
							'<a class="inlineBlock" href='+linkURL+'>'+
								linkTitle+
							'</a>'+
						'</div>'
					)
				}

			},
			error: function(xhr, textStatus, errorThrown){
				alert(errorThrown);
			}
		});

	}

});
