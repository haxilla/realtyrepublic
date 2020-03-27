$(function() {

   //stops screen from disappearing if you are clicking delete
   //since otherwise on blur hides the edit div
   $(".deleteCommentLink").mousedown(function(e){
      e.preventDefault();
   })

   $(".addCommentButton").click( function(e){
      e.preventDefault();
      var taskID=$(this).attr('id');
      $('#comment'+taskID).toggle();
   });

   $(".taskWizardButton").click( function(e){
      e.preventDefault();
      var taskID=$(this).attr('id');
      $(".taskWizard"+taskID).toggle();
      $(".taskMetaDiv"+taskID).toggle();
   });

   $(".taskPriorityButton").click( function(e){
      e.preventDefault();
      //set variables
      var taskID=$(this).attr('id');
      var taskView=$('input[name="taskView"]').val();
      var taskPriority=$("input[name='taskPriority" +taskID+ "']").val();
      var taskPriorityCount=$('.taskPriorityCount').text();

      //visuals for flag green=on / white=off
      if($(".taskPriorityButton"+taskID).hasClass("white-text")){
         //change flag to green
         $(".taskPriorityButton"+taskID).removeClass("white-text").addClass("green-text");
         var addPriority=1;
         newPriorityCount=parseInt(taskPriorityCount)+1;
         if(newPriorityCount==1){
            $(".journalHref").attr("href", "/dev/journal?taskPriority=1");}
      }else if($(".taskPriorityButton"+taskID).hasClass("green-text")){
         //change flag to white
         $( ".taskPriorityButton"+taskID).removeClass("green-text").addClass("white-text");
         var addPriority=0;
         var newPriorityCount=taskPriorityCount-1;
         if(newPriorityCount < 0){
            newPriorityCount=0;}}

      //change count on menu
      $('.taskPriorityCount').text(newPriorityCount);
      //if its zero then make default Journal Link on navbar go to taskType=new
      //instead of taskPriority
      if(newPriorityCount===0){
         $(".journalHref").attr("href", "/dev/journal?taskType=new");
         window.location.href = "/dev/journal?taskType=new";
      }

      //save to database
      var url='/dev/autoSavePriority?taskID='+taskID+'&addPriority='+addPriority;
      autoSaveGet(url);
      //remove from the list
      $('.fullTask'+taskID).hide();

   });

   $( ".taskShow" ).dblclick(function() {
      var taskID=$(this).attr('id');
      $('.taskShow'+taskID).hide();
      $('.taskEdit'+taskID).show();
      $('.taskTimeBadge'+taskID).hide();
      $(".taskDesc"+taskID).focus();
   });

   $( ".commentShow" ).dblclick(function(e){
      var commentID=$(this).attr('id');
      $('.commentShow'+commentID).hide();
      $('.commentEdit'+commentID).show();
      $('.commentTimeBadge'+commentID).hide();
      $("input[name='taskComment']").focus();
   });

   $( ".taskTypeShow" ).dblclick(function(){
      var taskID=$(this).attr('id');
      $('.taskTypeShow'+taskID).hide();
      $('.taskTypeEdit'+taskID).show();
      $('select[name="taskType"]').focus();
   });

   $('.taskSubmit').blur(function(e){
      var taskID=$(this).attr('id');
      var taskDesc=$('.taskDesc'+taskID).val();
      $('.taskEdit'+taskID).hide();
      $('.taskShow'+taskID).text(taskDesc);
      $('.taskShow'+taskID).show();
   });

   $('.commentSubmit').blur(function(e){
      var commentID=$(this).attr('id');
      var taskComment=$('.taskComment'+commentID).val();
      $('.commentEdit'+commentID).hide();
      $('.commentShow'+commentID).text(taskComment);
      $('.commentShow'+commentID).show();
      $('.commentTimeBadge'+commentID).show();
   });

   $('.taskTypeSelect').blur(function(e){
      var taskID=$(this).attr('id');
      var taskView=$('input[name="taskView"]').val();
      var selection=$('.taskTypeSelect'+taskID).val();
      //taskView is what page they are viewing
      //selection is the category chosen on mouse release
      //if not equal take off screen
      if(taskView !== selection){
         $('.fullTask'+taskID).hide();
      }
      $('.taskTypeSelect'+taskID[value=selection]).prop('selected', true);
      $('.taskTypeEdit'+taskID).hide();
      $('.taskTypeBadge'+taskID).text(selection);
      $('.taskTypeShow'+taskID).show();
   });

   $( ".taskTypeSelect" ).change(function() {
      var taskID=$(this).attr('id');
      var selection=$('.taskTypeSelect'+taskID).val();
      var url="/dev/autoSaveTaskType?taskID="+taskID;
      var formData=$("#saveTaskType"+taskID).serialize();

      autoSaveTask(url,formData);
      $('.taskTypeEdit'+taskID).hide();
      $('.taskTypeBadge'+taskID).text(selection);
      $('.taskTypeShow'+taskID).show();
   });

   $('.taskSubmit').bind("keyup", function(e){
      e.preventDefault();
      var taskID=$(this).attr('id');
      //upon hitting enter key change view
      //and value of taskShow div
      if ( e.keyCode == 13){
         var taskDesc=$('.taskDesc'+taskID).val();
         $('.taskEdit'+taskID).hide();
         $('.taskShow'+taskID).text(taskDesc);
         $('.taskShow'+taskID).show();
      }

      var url='/dev/autoSaveTask?taskID='+taskID;
      var formData=$("#autoSaveTask"+taskID).serialize();

      autoSaveTask(url,formData);

   });

   $('.commentSubmit').bind("keyup", function(e){

      e.preventDefault();
      var commentID=$(this).attr('id');
      //upon hitting enter key change view
      //and value of taskShow div
      if ( e.keyCode == 13){
         var taskComment=$('.taskComment'+commentID).val();
         $('.commentEdit'+commentID).hide();
         $('.commentShow'+commentID).text(taskComment);
         $('.commentShow'+commentID).show();
      }

      var url='/dev/autoSaveComment?commentID='+commentID;
      var formData=$("#autoSaveComment"+commentID).serialize();

      autoSaveTask(url,formData);

   });

   $('.wizardSubmit').bind("keyup", function(e){
      e.preventDefault();
      var wizardID=$(this).attr('id');

      if ( e.keyCode == 13){
         $(".taskWizard"+wizardID).toggle();
         $(".taskMetaDiv"+wizardID).toggle();
      }

      var url='/dev/autoSaveWizard?wizardID='+wizardID;
      var formData=$("#autoSaveWizard"+wizardID).serialize();

      autoSaveTask(url,formData);

   });

   //prevents autosave form from refreshing page and losing spot after edit
   $('.noSubmitForm').on('keyup keypress', function(e) {
     var keyCode = e.keyCode || e.which;
     if (keyCode === 13) {
       e.preventDefault();
       return false;
     }
   });

   //ajax request for autosave on key stroke
   function autoSaveTask(url,formData){

      $.ajax({
         url:        url,
         type:       "POST",
         dataType:   "json",
         data:       formData,
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         success: function(s) {
            console.log('success!');
         }
      });

   }

   //ajax request for autosave on key stroke
   function autoSaveGet(url){

      $.ajax({
         url:        url,
         type:       "GET",
         dataType:   "json",
         success: function(s) {
            console.log('success!');
         }
      });

   }

});
