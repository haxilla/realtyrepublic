$(function(e){

  $('body').on('click','.profileForm img,.profileForm .photoLinks',function(e){
    //determine what was clicked
    thisImg=$(this).closest('.imageDiv').data('thisimg');
    if(thisImg=="agtPhoto"){
      thisImg="Your Photo"
      $('.logo.imagePreview').hide();
      $('.photo.imagePreview').show();
      $('input[name="imageType"]').val("photo");
      $('span.thisImg').html(thisImg)
    }else if(thisImg=="agtLogo"){
      thisImg="Your Logo"
      $('.photo.imagePreview').hide();
      $('.logo.imagePreview').show();
      $('input[name="imageType"]').val("logo");
      $('span.thisImg').html(thisImg)
    }else{
      alert('error-line11-memberForms.js');
      exit();}
    //hide original forms
    $('.row.agtUpload').hide();
    $('.row.inputFields').hide();
    $('.pageTitle').html(thisImg);
    $('.member.overlay .titleBar .close').removeClass('close')
    .addClass('uploadClose')
    //show upload form
    $('.row.uploadForm').show();

  });

  $('body').on('click','.uploadClose,.profileForm .confirmNo',function(e){
    //get current
    var currentPhoto=$('.agtPhoto .imageDiv img').attr('src');
    var currentLogo=$('.agtLogo .imageDiv img').attr('src');
    //revert to original when closed
    $('.photo.imagePreview img').attr('src',currentPhoto);
    $('.logo.imagePreview img').attr('src',currentLogo);
    //fields
    $('.row.uploadForm').hide();
    $('.profileForm .uploadConfirm').hide();
    $('.row.inputFields').show();
    $('.row.agtUpload').show();
    $('.profileForm .uploadItem').show();
    $('.pageTitle').html("Your Profile");
    $('.member.overlay .titleBar .uploadClose')
    .removeClass('uploadClose')
    .addClass('close')
  });

  //profile form chooseNew photo/logo
  $('body').on('change','#chooseNew',function(e){

    var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
    //error if incorrect type
    if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
      //alert
      alert("Only formats are allowed : "+fileExtension.join(', '));
      //revert to original state
      $("#chooseNew").val(null);

    }else{

      formData=$('.profileForm .uploadOptions form').serialize();
      imageType=$('input[name="imageType"]').val()
      //otherwise ok, show preview
      imagePreview(this,formData,imageType);
    }

  });

  $('body').on('click','.profileForm .confirmYes',function(e){
    //imageType (photo,logo);
    imageType=$(this).data("imageType");
    //javascript example has no [0]
    //var input = document.getElementById('profileUpload');
    //var thisFile = input['chooseNew'].files[0];
    // + field name ie.. ['fieldName'];

    //jquery has outer object so use [0]
    var input = $('.profileForm .uploadOptions form');
    var thisFile = input[0]['chooseNew'].files[0];


  });

});

//preview agtPhoto or logo
function imagePreview(input,formData,imageType) {
  //check input for files
  if (input.files && input.files[0]){
    //set reader
    var reader = new FileReader();
    //catches name of image before replaced;
    //oldImage=$('.imagePreview img').attr('src');
    //change source
    reader.onload = function(e){
      //change image
      $('.profileForm .uploadItem').hide();
      $('.profileForm .uploadConfirm').show();
      $('.profileForm .confirmYes').data('imageType',imageType);
      $('.'+imageType+'.imagePreview img').attr('src', e.target.result);}

    //preview
    reader.readAsDataURL(input.files[0]);

  }else{

    alert('error-line73-memberForms.js');

  }
}
