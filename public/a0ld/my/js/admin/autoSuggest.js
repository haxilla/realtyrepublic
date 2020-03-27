$(function(){


   $('.searchTerm').keyup(function(){
      //default
      var showLarge;
      //try large searchTerm
      var searchTerm=$('.largeScreen.searchTerm').val();
      //check medium next
      if(!searchTerm){
         searchTerm=$('.mediumScreen.searchTerm').val();}

      var searchTerm=searchTerm.trim();
      var category
      //set category
      if($(this).hasClass('searchAll')){
         var category='all';};

      if($(this).hasClass('largeScreen')){
         var showLarge=1;}
      
      if(searchTerm && category){
         //set URL
         var theURL='/admin/autoSuggest?searchTerm='
         +searchTerm+'&category='+category;
         //send for data
         ajaxAutoSuggest(theURL);
         //show results
         if(showLarge){
            $('.largeScreen.autoResults').show();
         }else{
            $('.mediumScreen.autoResults').show();
         }


      //if no searchTerm or category   
      }else{
         //hide if none
         console.log(searchTerm+' '+category);
         $('.autoResults').hide();
      }

   });

   $('.searchTerm').focus(function(e){
      $('.inputIcon').hide();
   });

   $('.searchTerm').blur(function(e){
      $('.searchTerm').val("");  
      $('.autoResults').hide();
      $('.dim').hide();
      $('.inputIcon').show();
   });

   $('.responsiveSearch').click(function(e){
      $('.mediumSearch').show();
   });

   $('.mediumSearch .searchClose').click(function(e){
      $('.mediumSearch').hide();
   });

   function ajaxAutoSuggest(theURL){
      $.ajax({
         url: theURL,
         type: "GET",
         dataType: "html",   //expect html to be returned
            beforeSend: function() {
               $(".autoResults").perfectScrollbar("destroy");
               //$(".autoResults").mCustomScrollbar("destroy"); //Destroy
               $('.autoResults').html('<div class="loading">Loading ...</div>'); //clear html because it will show normal scroll bar
            },
            success: function(response){
               $(".autoResults").html(response);
               $(".autoResults").perfectScrollbar();
               /*
               $(".autoResults").mCustomScrollbar({
                  autoHideScrollbar: true,
               });
               */
               $(".dim").show();
            }
      });
   }



});