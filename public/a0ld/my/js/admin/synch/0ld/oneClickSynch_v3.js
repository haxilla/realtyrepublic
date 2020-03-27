$(function() {

   $('body').on('click','.synchAll', function(e){
      //preventDefault
      e.preventDefault();
      //scroll to top of div
      $('.responseOverlay').scrollTop(0);
      //reset
      $('.synchCounts').show();
      $('.synchProgress').hide();
      //start request
      var theURL='/synch/synchStart?next=new';
      //start function
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
            var status=jsonObject.status;
            var next=jsonObject.next;
            var synchID=jsonObject.synchID;
            //error out if not success
            if(status=='success'||status=='resume'){
               //main url
               theURL='/synch/synchStart?next='+next;
               //progress url
               progressURL='/synch/synchProgress?table='+next+'&synchID='+synchID;
               //check progress
               checkProgress(progressURL);
               //retrieve next 
               synchStart(theURL);
            }else{
               alert('error-line30-oneClickSynch.js');
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
            var thisClass=jsonObject.thisClass;
            var nextClass=jsonObject.nextClass;

            //hide counts & show progress
            $('.'+thisClass+'.synchCounts').hide();
            $('.'+thisClass+'.synchProgress').show();
            $('.'+thisClass+' .progress').hide();

            //report percentage
            if(percentComplete!=100 && percentComplete > 0){

               //shows progress bar when > 0
               percentComplete=percentComplete+'%';
               $('.'+thisClass+' .progressWait').hide();
               $('.'+thisClass+' .progress').show();
               $('.'+thisClass+' .progress-bar').css({'width':percentComplete});
               $('.'+thisClass+' .progressText').html(thisClass+' '+percentComplete)
               checkProgress(progressURL);

            }else if(percentComplete!=100){

               //nothing done, loading message stays
               checkProgress(progressURL);

            }else if(percentComplete==100){

               //complete thisClass
               $('.'+thisClass+' .progress-bar').css({'width':'100%'});
               $('.'+thisClass+' .progressText').html(thisClass+' 100% complete!');
               $('.'+thisClass+' .progressWait').show();
               $('.'+thisClass+' .progress').hide();
               $('.'+thisClass).hide();
               
               //next class
               $('.'+nextClass+'.synchCounts').hide();
               $('.'+nextClass+'.synchProgress').show();
               $('.'+nextClass+' .progressWaitText').html("Now Preparing "+nextClass+" ...")
               $('.'+nextClass+' .progressWait').show();
               $('.'+nextClass+' .progress').hide();
               $('.'+nextClass+' .progress-bar').css({'width':0});

            }
         }
      })
   }

});
