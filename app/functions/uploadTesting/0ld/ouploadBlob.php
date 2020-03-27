<?php

if(isset($_FILES)){

   //temporary location
   $temp = $_FILES['fileSelect']['tmp_name'];
   $blobID=$_FILES['fileSelect']['name'];

   echo json_encode(array(
      'temp'=>$temp,
      'blobID'=>$blobID,
   ));
};
