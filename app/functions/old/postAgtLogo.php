<?php
$target_dir = "hqoffice/$officeID/logos/";
$target_file = $target_dir . uniqid() .'-'. basename($_FILES["agtLogo"]["name"]);
$newFileName=basename($target_file);
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

//if directory doesnt exist create it
 if (!is_dir("hqoffice/$officeID/logos")) {
     mkdir("hqoffice/$officeID/logos", 0777, true);
 }

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {

    $check = getimagesize($_FILES["agtLogo"]["tmp_name"]);

    if($check !== false) {
        $uploadmsg="ok";
        $uploadmsg2=0;
        $uploadOk = 1;
    } else {
        $uploadmsg= "File is not an image.";
        $uploadmsg2=0;
        $uploadOk = 0;
    }

}

// Check if file already exists
if (file_exists($target_file)) {
    $uploadmsg='Sorry, file already exists.';
    $uploadmsg2=0;
    $uploadOk = 0;
}


// Check file size
//if ($_FILES["agtPhoto"]["size"] > 500000) {
//    echo "Sorry, your file is too large.";
//   $uploadOk = 0;


// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $uploadmsg="Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadmsg2=0;
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {

    $uploadmsg2="Sorry, your file was not uploaded.";

// if everything is ok, try to upload file
} else {

    if (move_uploaded_file($_FILES["agtLogo"]["tmp_name"], $target_file)) {

        $uploadmsg2=0;

    } else {

        $uploadmsg2="Sorry, there was an error uploading your file.";
    }

}
?>
