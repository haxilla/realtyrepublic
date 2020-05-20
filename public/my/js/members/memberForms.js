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
    //get formData
    var input = $('.profileForm .uploadOptions form');
    var thisFile = input[0]['chooseNew'].files[0];
    var formData1 = new FormData();
		//set resize
		ImageTools.resize(thisFile, {
      width: 500, // maximum width
      height: 500// maximum height
    },function(blob, didItResize) {
      //set originalName
      originalName=thisFile.name;
      // didItResize will be true if it managed to resize it,
      // otherwise false (and will return the original file as 'blob')
      if(didItResize){
        blobname='r500-'+originalName;
      }else{
        blobname='o-'+originalName;}
      //append blob
      formData1.append('fileSelect',blob,blobname);
      formData1.append('originalName',originalName);
      formData1.append('imageType',imageType);
      //send now function
      profileUpload(formData1);
    });
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

function profileUpload(formData){

  //open new request
  var ajax = new XMLHttpRequest();
  //set token
  token = document.querySelector('meta[name="csrf-token"]').content;
  //post
  ajax.open("POST", "/member/profileUpload");
  //send token
  ajax.setRequestHeader('X-CSRF-TOKEN', token);
  //send data
  ajax.send(formData);
  //listener for load complete
  ajax.addEventListener("load", function(e){
    if(ajax.status === 200){
      //set response
      var response = JSON.parse(ajax.responseText);
      //set variables
      status=response.status;
      //check status
      if(status=='Success'){
        //get variables from response
        newFilePath=response.newFilePath;
        imageType=response.imageType;
        if(imageType=='photo'){
          $('.agtPhoto .imageDiv img').attr('src',newFilePath)
        }else if(imageType=='logo'){
          $('.agtLogo .imageDiv img').attr('src',newFilePath)
        }else{
          alert('error-line157-memberForms.js');}

        //show main page with form fields and photo changed
        //fields
        $('.row.uploadForm').hide();
        $('.profileForm .uploadConfirm').hide();
        $('.row.inputFields').show();
        $('.row.agtUpload').show();
        $('.profileForm .uploadItem').show();
        $('.pageTitle').html("Your Profile");

      }else{

        //response error
        alert('error-line155-memberForms.js');}

    }else{

      //ajax error
      alert('error-line161-memberForms.js');}

  });

}
