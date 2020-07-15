$(function() {

   $('body').on('click','.synchAll', function(e){
      //preventDefault
      e.preventDefault();
      //scroll to top of div
      $('.responseOverlay').scrollTop(0);
      //turn on progress div
      $('.synchCounts').show();
      $('.propAgent.synchCounts').hide()
      $('.synchProgress').hide();
      $('.propAgent.synchProgress').show();
      //start request
      var theURL='/admin/synchStart';
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
            //
            console.log(jsonObject);
            //begin variables
            var status=jsonObject.status;
            var next=jsonObject.next;
            var message1=jsonObject.message1;
            var message2=jsonObject.message2;
            //error out if not success
            if(status!=='success'){
               alert('error-line30-oneClickSynch.js')
               return false;}

            //read description and reply
            if(next=='resetAgent'){
               //set variable
               var progressURL='/synch/progress?table=propagent';
               //check progress
               checkProgress(progressURL);
               //set URL
               var theURL='/synch/flyer/resetAgent';
            }else if(next=='resetOffice'){
               var theURL='/synch/flyer/resetOffice';
               //update modal status,next,message
               $('#synchStatusModalDiv').text(status);
               $('#synchDescModalDiv').text(next);
               $('#synchMessage1ModalDiv').text(message1);
               $('#synchMessage2ModalDiv').text(message2);
            }else if(next=='resetFlyer'){
               var theURL='/synch/flyer/resetFlyer';
               //update modal status,next,message
               $('#synchStatusModalDiv').text(status);
               $('#synchDescModalDiv').text(next);
               $('#synchMessage1ModalDiv').text(message1);
               $('#synchMessage2ModalDiv').text(message2);
            }else if(next=='resetMeta'){
               var theURL='/synch/flyer/resetFlyerMeta';
               //update modal status,next,message
               $('#synchStatusModalDiv').text(status);
               $('#synchDescModalDiv').text(next);
               $('#synchMessage1ModalDiv').text(message1);
               $('#synchMessage2ModalDiv').text(message2);
            }else if(next=='resetMapping'){
               var theURL='/synch/flyer/resetFlyerMapping';
               //update modal status,next,message
               $('#synchStatusModalDiv').text(status);
               $('#synchDescModalDiv').text(next);
               $('#synchMessage1ModalDiv').text(message1);
               $('#synchMessage2ModalDiv').text(message2);
            }else if(next=='resetRemarks'){
               var theURL='/synch/flyer/resetFlyerRemarks';
               //update modal status,next,message
               $('#synchStatusModalDiv').text(status);
               $('#synchDescModalDiv').text(next);
               $('#synchMessage1ModalDiv').text(message1);
               $('#synchMessage2ModalDiv').text(message2);
            }else if(next=='resetStat'){
               var theURL='/synch/flyer/resetFlyerStat';
               //update modal status,next,message
               $('#synchStatusModalDiv').text(status);
               $('#synchDescModalDiv').text(next);
               $('#synchMessage1ModalDiv').text(message1);
               $('#synchMessage2ModalDiv').text(message2);
            }else if(next=='resetStyle'){
               var theURL='/synch/style/resetStyle';
               //update modal
               $('#synchStatusModalDiv').text(status);
               $('#synchDescModalDiv').text(next);
               $('#synchMessage1ModalDiv').text(message1);
               $('#synchMessage2ModalDiv').text(message2);
            }else if(next=='resetPhoto'){
               var theURL='/synch/photo/resetPhoto'
               //update modal
               $('#synchStatusModalDiv').text(status);
               $('#synchDescModalDiv').text(next);
               $('#synchMessage1ModalDiv').text(message1);
               $('#synchMessage2ModalDiv').text(message2);
            }else if(next=='resetDeliv'){
               var theURL='/synch/deliv/resetDeliv'
               //update modal
               $('#synchStatusModalDiv').text(status);
               $('#synchDescModalDiv').text(next);
               $('#synchMessage1ModalDiv').text(message1);
               $('#synchMessage2ModalDiv').text(message2);
            }else if(next=='resetDelivNow'){
               var theURL='/synch/delivNow/resetDelivNow'
               //update modal
               $('#synchStatusModalDiv').text(status);
               $('#synchDescModalDiv').text(next);
               $('#synchMessage1ModalDiv').text(message1);
               $('#synchMessage2ModalDiv').text(message2);
            }else if(next=='reset_orders'){
               var theURL='/synch/order/resetOrder'
               //update modal
               $('#synchStatusModalDiv').text(status);
               $('#synchDescModalDiv').text(next);
               $('#synchMessage1ModalDiv').text(message1);
               $('#synchMessage2ModalDiv').text(message2);
            }else if(next=='reset_emailRemovals'){
               var theURL='/synch/emailRemoval/resetEmailRemoval'
               //update modal
               $('#synchStatusModalDiv').text(status);
               $('#synchDescModalDiv').text(next);
               $('#synchMessage1ModalDiv').text(message1);
               $('#synchMessage2ModalDiv').text(message2);
            }else if(next=='etrack2018'){
               var theURL='/synch/etrack/etrack2018'
               //update modal
               $('#synchStatusModalDiv').text(status);
               $('#synchDescModalDiv').text(next);
               $('#synchMessage1ModalDiv').text(message1);
               $('#synchMessage2ModalDiv').text(message2);
            }else if(next=='complete'){
               //update modal
               alert('all done!');
               $('#synchStatusModalDiv').text(status);
               $('#synchDescModalDiv').text(next);
               $('#synchMessage1ModalDiv').text(message1);
               $('#synchMessage2ModalDiv').text(message2);
               //turn off modal
               //$('#clickSynchModal').modal('toggle');
               return false;
            }else{
               alert('error-line142-oneClickSynch.js');}

            //if here, go to next one
            //synchStart(theURL);
         }

      });
   }

   function checkProgress(progressURL){
      console.log('ajax started')
      $.ajax({
         type: "GET",
         url: progressURL,
         dataType: "json",
         //success
         success: function(data) {
            //stringify to decode object and make it parseable
            var response=JSON.stringify(data);
            //Parse response
            var jsonObject=JSON.parse(response);
            //
            console.log(jsonObject)
         }
      })
      console.log('ajax done')
   }

});
