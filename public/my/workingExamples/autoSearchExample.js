$(function(){

   $('#rosterAutoCompleteField').keyup(function(){
      var formVal=$('#rosterAutoCompleteField').val();
      var formVal=formVal.trim();
      var theURL='/admin/roster/rosterSearch?formVal='+formVal;
      if(formVal){
         ajaxGet_myAutoComplete(theURL);
         $('.rosterResults').show();
      }else{
         $('.rosterResults').hide();
      }
   });

   $('#rosterAutoCompleteField').focus(function(){
      var formVal=$("#rosterAutoCompleteField").val();
      if(formVal){
         $('.rosterResults').show();}
   });
   //hide results on blur
   $('#rosterAutoCompleteField').blur(function(e){
      $('.rosterResults').hide();
   });
   //EXCEPT if mouse is clicking on link inside rosterResults
   $(".rosterResults").mousedown(function(e){
      e.preventDefault();
   })
   //ajax call
   function ajaxGet_myAutoComplete(theURL){
   $.ajax({
      url: theURL,
      type: "GET",
      dataType: "html",   //expect html to be returned
         success: function(response){
            $(".rosterResults").html(response);
         }
      });
   }

});
