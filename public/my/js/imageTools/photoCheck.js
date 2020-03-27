$(document).ready(function(){
  // Looping through all image elements
  $("img").each( function (){
    //set element
    var element = $(this);

    $.ajax({
      url:$(this).attr('src'),
      type:'get',
      async: false,
      error:function(response){

        var replace_src = "/images/noimage.png";
        // Again check the default image
        $.ajax({
          url: replace_src,
          type:'get',
          async: false,
          success: function(){
            $(element).attr('src', replace_src);
          },
          error:function(response){
            $(element).hide();
          }
        });
      }
    });
  });
});
