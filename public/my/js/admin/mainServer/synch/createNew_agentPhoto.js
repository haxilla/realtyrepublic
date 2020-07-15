$(function(){

   $('#createNew_agentPhoto').click(function(){
      theURL='/admin/synch/createNew_agentPhoto';
      //open modal
      $('#synchAgentPhotoModal').modal();
      //ajax call
      ajax_createNew_agtPhoto(theURL);
   });

   function ajax_createNew_agtPhoto(theURL){
      //ajax call
      $.ajax({
         type: "get",
         dataType: "json",
         url: theURL,
         success: function (data) {
            //stringify to decode object and make it parseable
            var response=JSON.stringify(data);
            //Parse response
            var jsonObject=JSON.parse(response);
            //set variables
            var status              = jsonObject.status;
            var propagent_id        = jsonObject.propagent_id;
            var newRemID            = jsonObject.newRemID;
            var agentPhotoFix       = jsonObject.agentPhotoFix;
            var agentLogoFix        = jsonObject.agentLogoFix;
            var photoCheckCount     = jsonObject.photoCheckCount;
            var logoCheckCount      = jsonObject.logoCheckCount;
            var localPath           = jsonObject.localPath;
            var remoteAgtPhotoURL   = jsonObject.remoteAgtPhotoURL;
            var remoteAgtLogoURL    = jsonObject.remoteAgtLogoURL;
            //check photoCounts
            if(agentPhotoFix && photoCheckCount>1){
               $('#synchAgtPhoto_status').text('status: '+status);
               $('#synchAgtPhoto_propagent_id').text('propagent_id: '+propagent_id);
               $('#synchAgtPhoto_newRemID').text('newRemID: '+newRemID);
               $('#synchAgtPhoto_agentPhotoFix').text('agentPhotoFix: '+agentPhotoFix);
               $('#synchAgtPhoto_agentLogoFix').text('agentLogoFix: '+agentLogoFix);
               $('#synchAgtPhoto_photoCheckCount').text('photoCheckCount: '+photoCheckCount);
               $('#synchAgtPhoto_logoCheckCount').text('logoCheckCount: '+logoCheckCount);
               $('#synchAgtPhoto_localPath').text('local: '+localPath);
               $('#synchAgtPhoto_remoteAgtPhotoURL').text('photo: '+remoteAgtPhotoURL);
               $('#synchAgtPhoto_remoteAgtLogoURL').text('logo: '+remoteAgtLogoURL);
               ajax_createNew_agtPhoto(theURL);}
            //agtPhoto Done
            if(agentPhotoFix && photoCheckCount<1){
               alert('alldone!');}

         }
      });
   }

});
