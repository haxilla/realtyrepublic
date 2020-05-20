$(function(){

  $('body').on('submit','.noSubmit',function(e){
    e.preventDefault();
    return false;
  });

  $('body').on('submit','.profileForm form',function(e){
    formData=$('.profileForm form').serialize();
    alert(formData);
  });

  $('.ticon-more').click(function(e){
    $('.member.overlay').hide();
    $('.subMenuSearch').hide();
    $('.subMenu').toggle();
  });

  $('.dropMenu .ajax a').click(function(e){
    var thisClick=$(this).data("thisclick");
    $('.member.overlay .titleBar .pageTitle').html(thisClick);
    thisURL="/member/nav?link="+thisClick;
    memberNav(thisURL)
  });

  $('.subMenu .navSearch').click(function(e){
    $('.subMenu').hide();
    $('.subMenuSearch').show();
    $('.subMenuSearch .searchResults').html("");
    $('.subMenuSearch input').val("");
    $('.subMenuSearch input').focus();
  });

  //close overlay
  $('body').on('click', '.titleBar .close, .formCancel',function(e){
    $('.member.overlay').hide();
  });

  $('body').on('click', '.subMenuSearch .searchClose',function(e){
    $('.subMenuSearch').hide();
    $('.subMenu').show();
  });

  $('body').on('keyup','input.flyerSearch',function(e){
    //get searchTerm
    searchTerm=$('.subMenuSearch .flyerSearch').val();

    //set css
    $('.subMenuSearch .flyerSearch').css({
      "background":"rgba(255,255,255,1)",
      "border"    :"2px solid #8c8c8c",
    });

    //remove icon if no values
    if(searchTerm.length>0){
      $('.subMenuSearch .fixedLabel i').hide();
      //ajax post for results
      formData=$('.subMenuSearch form').serialize();
      flyerNavSearch(formData);
    }else{
      //set css
      $('.subMenuSearch .fixedLabel i').show();
      $('.subMenuSearch .flyerSearch').css({
        "background"  :"#efedff",
        "border"      :"none",
      });
      //hide if blank field;
      $('.subMenuSearch .searchResults').hide();}

  });

})

function flyerNavSearch(searchTerm){
  $.ajax({
    url       : '/member/flyerNavSearch',
    type      : "post",
    data      : formData,
    dataType  : "html",
    encode    : true,
    headers   : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
    .attr('content')},
  })
  .done(function(data){

    $('.subMenuSearch .searchResults').show();
    $('.subMenuSearch .searchResults').html("");
    $('.subMenuSearch .searchResults').html(data);

  })
  .fail(function(data){

  });
}

function memberNav(thisURL){
  //ajax get request
  $.ajax({
    url: thisURL,
    type: "GET",
    dataType: "html",
  })
  .done(function(data){
    $('.member.overlay .render').html(data);
    $('.member.overlay').show();
    $('.member.overlay .mainWrapper').scrollTop(0);

    //finds & fixes floating labels
    fixInputs();
  })
  .fail(function(data){
    alert('error-line33-member/navigation.js');
  });
}
