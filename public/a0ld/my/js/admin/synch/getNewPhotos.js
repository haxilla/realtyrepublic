$(function() {

   $('#flyer_getNewPhotos').click(function(e){
      //turn on modal
      $('#synchPhoto_w1000modal').modal('toggle');
      //start request
      var theURL='/admin/flyer_getNewPhotos';
      ajaxGetPhotos(theURL);
   });

   function ajaxGetPhotos(theURL){

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
            var totalRecords     = jsonObject.totalRecords;
            var existCheck       = jsonObject.existCheck;
            var notFound         = jsonObject.notFound;
            var localFound       = jsonObject.localFound;
            var remoteFound      = jsonObject.remoteFound;
            var remoteURL        = jsonObject.remoteURL;
            var localURL         = jsonObject.localURL;
            var photoID          = jsonObject.photoID;
            //change display
            $('#w1000_status').text('status: '+status);
            $('#w1000_totalRecords').text('totalRecords: '+totalRecords);
            $('#w1000_existCheck').text('existCheck: '+existCheck);
            $('#w1000_notFound').text('notFound: '+notFound);
            $('#w1000_localFound').text('localFound: '+localFound);
            $('#w1000_remoteFound').text('remoteFound: '+remoteFound);
            $('#w1000_remoteURL').text('remoteURL: '+remoteURL);
            $('#w1000_localURL').text('localURL: '+localURL);
            $('#w1000_photoID').text('photoID: '+photoID);
            //totalRecords MUST be included and used in json reply
            //if any records found its not done
            if(totalRecords>0 && status=='success'){
               ajaxGetPhotos(theURL);
            }else{
               $('#w1000_status').text('CHECK Status: '+status);
            }
         }

      });
   }

});
