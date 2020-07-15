$(function() {

   $('body').on('click','.startSynch', function(e){
      //preventDefault
      e.preventDefault();

      //get class
      var currentSynch=$(this).children('div').attr('class');
      
      //check if single or all
      if($(this).hasClass('synchOne')){
         var synchType='synchOne';
      }else if($(this).hasClass('synchAll')){
         var synchType='synchAll';
         $('.responseOverlay').scrollTop(0);
      }else{
         alert('error-line15-synchStart.js');
         return false;}

      //set URL
      var theURL='/synch/synchStart?synchType='+
      synchType+'&currentSynch='+currentSynch;
      //reset
      $('.synchCounts').show();
      $('.synchProgress').hide();
      //reset opacity
      $('.synchTable tr').css({"opacity":"1"});
      $('.synchTable .synchRow').css({"background":"none"});
      //highlight active
      $('.synchTable tr').not('.tableLegend')
      .not('.'+currentSynch).css({"opacity":".3"});
      $('.'+currentSynch+'.synchRow').css({"background":"#fff"});
      //disable hovers
      $('.synchTable .hover').addClass('no-hover');
      //disable startSynch
      $('.synchTable .hover').removeClass('startSynch');
      //start request
      synchStart(theURL);
   });

   function synchStart(theURL){

      $.ajax({
      type: "GET",
      url: theURL,
      dataType: "json",

         success: function(data) {
            //stringify to decode object and make it parseable
            var response=JSON.stringify(data);
            //Parse response
            var jsonObject=JSON.parse(response);
            //begin variables
            var status           = jsonObject.status;
            var synchID          = jsonObject.synchID;
            var synchType        = jsonObject.synchType;
            var currentSynch     = jsonObject.currentSynch;
            var partialSynch     = jsonObject.partialSynch;
            var partialNext      = jsonObject.partialNext;
            var partialComplete  = jsonObject.partialComplete;
            //error out if not success
            if(status=='complete'){

               return false;

            }else if(status=='new'||status=='resume'){

               //main url
               theURL='/synch/synchStart?synchType='+synchType+
               '&currentSynch='+currentSynch;
               //progress url
               progressURL='/synch/synchProgress?synchID='+synchID;
               //check progress
               checkProgress(progressURL);
               //retrieve next 
               synchStart(theURL);
               
            }else{

               alert('error-line63-synchStart.js');
               return false;

            }        
         }

      });
   }

   function checkProgress(progressURL){

      $.ajax({
         type: "GET",
         url: progressURL,
         dataType: "json",
         //success
         success: function(data){

            //stringify to decode object and make it parseable
            var response=JSON.stringify(data);

            //Parse response
            var jsonObject=JSON.parse(response);
            var percentComplete=jsonObject.percentComplete;
            var currentSynch=jsonObject.currentSynch;
            var synchComplete=jsonObject.synchComplete;
            var tableDropName=jsonObject.tableDropName;
            var tableArchiveName=jsonObject.tableArchiveName;
            var progressMessage=jsonObject.progressMessage;

            //hide counts
            $('.'+currentSynch+'.synchCounts').hide();
            $('.'+currentSynch+' .progress').hide();
            //show progress
            $('.'+currentSynch+'.synchProgress').show();

            //report percentage
            if(percentComplete!=100 && percentComplete > 0){

               percentComplete=percentComplete+'%';
               //shows progress bar when > 0
               $('.'+currentSynch+' .progressWait').hide();
               $('.'+currentSynch+' .progress').show();
               $('.'+currentSynch+' .progress-bar').css({'width':percentComplete});

               //main table
               if(tableDropName!=null){
                  $('.'+currentSynch+' .progressText').html(progressMessage+
                  ' - '+percentComplete+' - '+tableDropName);}

               //archive
               if(tableArchiveName!=null){
                  $('.'+currentSynch+' .progressText').html('Adding Archive '+
                  tableArchiveName+' - '+percentComplete+' - '+currentSynch);}

               checkProgress(progressURL);

            }else if(synchComplete==null){

               //nothing done, loading message stays
               $('.'+currentSynch+' .progressWait').show();
               checkProgress(progressURL);

            }else if(synchComplete!==null){

               //complete currentSynch
               $('.'+currentSynch+' .progress-bar').css({'width':'100%'});
               $('.'+currentSynch+' .progressText')
               .html(currentSynch+' 100% complete!');
               //reset opacity
               $('.synchTable tr').css({"opacity":"1"});
               $('.synchTable .synchRow').css({"background":"none"});
               //shade completed
               $('.synchTable .'+currentSynch).css({"opacity":".3"});
               $('.'+currentSynch+' .progressWait').hide();
               $('.'+currentSynch+' .progress').show();
               //disable hovers
               $('.synchTable .hover').removeClass('no-hover');
               //disable startSynch
               $('.synchTable .hover').addClass('startSynch');
               //remove rotation
               $('.'+currentSynch+'.synchProgress a').removeClass('rotating');
               //change icon
               $('.'+currentSynch+'.synchProgress i').removeClass('ti-reload');
               $('.'+currentSynch+'.synchProgress i').addClass('ti-check');


            }else{
               alert('error-line130-synchStart.js');
            }
         }
      })
   }

});
