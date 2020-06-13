<?php

if ($_FILES["formFile"]["error"] == UPLOAD_ERR_OK)
{
	$currentName=$_FILES["formFile"]["name"];
	$ext = pathinfo($currentName, PATHINFO_EXTENSION);

	if($ext=='zip'){
		$uploadPath='my/uploads/adre/zipFile/';
	}elseif($ext=='txt'){	
		$uploadPath='my/uploads/adre/files/';
	}else{
		dd('error-line13-adre/uploads/newFileUpload.php');}

	if(strpos($currentName,"Individual")!==false){
		$newName="Individuals.zip";
		$extName="Individuals.txt";
	}else{
		dd('error-line19-adre/uploads/newFileUpload.php');}

	//set variables
	$newPath=$uploadPath.$newName;
    $theFile = $_FILES["formFile"]["tmp_name"];
    // now you have access to the file being uploaded
    //perform the upload operation.
    $moved=move_uploaded_file($theFile,"$newPath");
}

if($moved && $ext=='zip'){

	//prep
	$zip = new ZipArchive;
	//open zip
	if ($zip->open($newPath) === TRUE) {

		//set path
		$extractPath='my/uploads/adre/zipExtract';
	    //extract
	    $extracted=$zip->extractTo($extractPath);
	    //close
	    $zip->close();

	    if($extracted){
	    	include(app_path().'/adre/uploads/loadDataInfile.php');}

	} else {
	    dd('error-line49-adre/uploads/newFileUpload.php');}

}else{
	dd('error-line40-adre/uploads/newFileUpload.php');}

/* for jquery
if($moved){
	
	$idArray=array(
		'ext'			=> $ext,
		'uploadPath'	=> $uploadPath,
		'currentName'	=> $currentName,
		'newName'		=> $newName,
	);

	echo json_encode($idArray);
	exit();
}

dd('error uploading!');

*/