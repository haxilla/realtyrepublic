// ** THIS IS THE JS IN USE FOR W1000 ** //

$(function() {

   $('#resizePhoto_w1000Link').click(function(e){
      //turn on modal
      $('#synchPhoto_w1000modal').modal('toggle');
      //start request
      var theURL='/admin/resizePhoto_w1000';
      ajaxGet_resizePhoto_w1000(theURL);
   });

   function ajaxGet_resizePhoto_w1000(theURL){

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
            var status              = jsonObject.status;
            var loopCount           = jsonObject.loopCount;
            var totalRecords        = jsonObject.totalRecords;
            var totalFlyerRecords   = jsonObject.totalFlyerRecords;
            var thisTotalPhotos     = jsonObject.thisTotalPhotos;
            var thisPhotoCount      = jsonObject.thisPhotoCount;
            var existCheck          = jsonObject.existCheck;
            var notFound            = jsonObject.notFound;
            var localFound          = jsonObject.localFound;
            var remoteFound         = jsonObject.remoteFound;
            var remoteURL           = jsonObject.remoteURL;
            var localURL            = jsonObject.localURL;
            var localPath           = jsonObject.localPath;
            var photoID             = jsonObject.photoID;
            //change display
            $('#w1000_status').text('status: '+status);
            $('#w1000_totalFlyerRecords').text('totalFlyerRecords: '+totalFlyerRecords);
            $('#w1000_thisTotalPhotos').text('thisTotalPhotos: '+thisTotalPhotos);
            $('#w1000_thisPhotoCount').text('thisPhotoCount: '+thisPhotoCount);
            $('#w1000_existCheck').text('existCheck: '+existCheck);
            $('#w1000_notFound').text('notFound: '+notFound);
            $('#w1000_localFound').text('localFound: '+localFound);
            $('#w1000_remoteFound').text('remoteFound: '+remoteFound);
            $('#w1000_remoteURL').text('remoteURL: '+remoteURL);
            $('#w1000_localURL').text('localURL: '+localURL);
            $('#w1000_photoID').text('photoID: '+photoID);
            //totalRecords MUST be included and used in json reply
            //if any records found its not done
            if(thisTotalPhotos>0 && status=='success'){
               ajaxGet_resizePhoto_w1000(theURL);
            }else{
               $('#w1000_status').text('CHECK Status: '+status);
            }
         }

      });
   }

});
