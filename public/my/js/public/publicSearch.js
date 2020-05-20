$(function(e){

  $('body').on('keyup', '.publicSearchForm .searchTerm',
  function(e){
    //get searchTerm
    var searchTerm=$('.publicSearchForm .searchTerm').val();
    var searchTerm=searchTerm.trim();

    if(searchTerm.length && searchTerm.length<3){
      //show load
      $('.publicSearchForm .searchResults').removeClass('displayNone');
      $('.publicSearchForm .field').css({"border":"1px solid #ccc"});
      $('.publicSearchForm .loading').removeClass('displayNone');
      $('.publicSearchForm .render').html("");
      $('.publicSearchForm .render').addClass('displayNone');

    }else if(searchTerm.length >= 3){
      //set URL
      var theURL='/searchResults?searchTerm='+searchTerm;
      //visual border indicator
      $('.publicSearchForm .field').css({"border":"2px solid #ccc"})
      //send for data
      publicSearchAjax(theURL);
      //show results

    }else{
      $('.publicSearchForm .searchResults').addClass('displayNone');
      $('.publicSearchForm .field').css({"border":"1px solid #ccc"});
    }

  });

});

function publicSearchAjax(theURL){

  $.ajax({
    url: theURL,
    type: "GET",
    dataType: "html",
    beforeSend: function() {
      $(".publicSearchForm .searchResults").perfectScrollbar("destroy");
      //$(".autoResults").mCustomScrollbar("destroy"); //Destroy
      $('.publicSearchForm .render').html("");
      //clear html because it will show normal scroll bar
    },
    success: function(response){
      //remove loading message
      $('.publicSearchForm .loading').addClass('displayNone');
      $('.publicSearchForm .render').removeClass('displayNone');
      $('.publicSearchForm .render').html(response);
      $('.publicSearchForm .searchResults').perfectScrollbar();
    }
  });

}
