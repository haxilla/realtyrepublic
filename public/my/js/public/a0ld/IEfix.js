if ( ! Modernizr['object-fit'] ) {
	//for testing
  //alert('NO OBJECT FIT')
  $('.image600hContainer').each(function () {
    //for testing//
    //alert('inside each!')
    var $container = $(this),
        imgUrl = $container.find('img').prop('src');
    if (imgUrl) {
        //for testing//
        //alert(imgUrl)
      $container
        .css('backgroundImage', 'url(' + imgUrl + ')')
        .addClass('compat-object-fit');
    }else{
      //for testing//
      //alert('no img found!');
    }
  });
  $('.image550hContainer').each(function () {
    //for testing//
    //alert('inside each!')
    var $container = $(this),
        imgUrl = $container.find('img').prop('src');
    if (imgUrl) {
        //for testing//
        //alert(imgUrl)
      $container
        .css('backgroundImage', 'url(' + imgUrl + ')')
        .addClass('compat-object-fit');
    }else{
      //for testing//
      //alert('no img found!');
    }
  });
  $('.image500hContainer').each(function () {
    //for testing//
    //alert('inside each!')
    var $container = $(this),
        imgUrl = $container.find('img').prop('src');
    if (imgUrl) {
        //for testing//
        //alert(imgUrl)
      $container
        .css('backgroundImage', 'url(' + imgUrl + ')')
        .addClass('compat-object-fit');
    }else{
      //for testing//
      //alert('no img found!');
    }
  });
  $('.image475hContainer').each(function () {
    //for testing//
    //alert('inside each!')
    var $container = $(this),
        imgUrl = $container.find('img').prop('src');
    if (imgUrl) {
        //for testing//
        //alert(imgUrl)
      $container
        .css('backgroundImage', 'url(' + imgUrl + ')')
        .addClass('compat-object-fit');
    }else{
      //for testing//
      //alert('no img found!');
    }
  });
  $('.image425hContainer').each(function () {
    //for testing//
    //alert('inside each!')
    var $container = $(this),
        imgUrl = $container.find('img').prop('src');
    if (imgUrl) {
        //for testing//
        //alert(imgUrl)
      $container
        .css('backgroundImage', 'url(' + imgUrl + ')')
        .addClass('compat-object-fit');
    }else{
      //for testing//
      //alert('no img found!');
    }
  });
  $('.image390hContainer').each(function () {
    //for testing//
    //alert('inside each!')
    var $container = $(this),
        imgUrl = $container.find('img').prop('src');
    if (imgUrl) {
        //for testing//
        //alert(imgUrl)
      $container
        .css('backgroundImage', 'url(' + imgUrl + ')')
        .addClass('compat-object-fit');
    }else{
      //for testing//
      //alert('no img found!');
    }
  });
  $('.image375hContainer').each(function () {
    //for testing//
    //alert('inside each!')
    var $container = $(this),
        imgUrl = $container.find('img').prop('src');
    if (imgUrl) {
        //for testing//
        //alert(imgUrl)
      $container
        .css('backgroundImage', 'url(' + imgUrl + ')')
        .addClass('compat-object-fit');
    }else{
      //for testing//
      //alert('no img found!');
    }
  });
  $('.image350hContainer').each(function () {
    //for testing//
    //alert('inside each!')
    var $container = $(this),
        imgUrl = $container.find('img').prop('src');
    if (imgUrl) {
        //for testing//
        //alert(imgUrl)
      $container
        .css('backgroundImage', 'url(' + imgUrl + ')')
        .addClass('compat-object-fit');
    }else{
      //for testing//
      //alert('no img found!');
    }
  });
  $('.image250hContainer').each(function () {
    //for testing//
    //alert('inside each!')
    var $container = $(this),
        imgUrl = $container.find('img').prop('src');
    if (imgUrl) {
        //for testing//
        //alert(imgUrl)
      $container
        .css('backgroundImage', 'url(' + imgUrl + ')')
        .addClass('compat-object-fit');
    }else{
      //for testing//
      //alert('no img found!');
    }
  });
  //for testing//
  //alert('outsideEach2');
}else{
  //for testing//
	//alert('YES OBJECT FIT');
}