<?php

namespace App\Http\Controllers\member;
use App\Http\Controllers\Controller;
use Auth;

class profileController extends Controller
{

  public function __construct()
  {
     $this->middleware('auth:member');
  }

  public function profileUpload(){

    //checks Auth & returns propagentInfo & newRemID
    include(app_path().'/members/auth/getUmid.php');
    //imageType is photo or logo
    $imageType=request('imageType');
    //set path
    $folderPath = "agentPhotos/$newRemID";
    //set file info
    $tmpFile = $_FILES['fileSelect']['tmp_name'];
    $sourceProperties = getimagesize($tmpFile);
    $ext = pathinfo($_FILES['fileSelect']['name'], PATHINFO_EXTENSION);
    $imageExt = $sourceProperties[2];
    //error if not an image
    if(!$imageExt){
      //setup values
      $idArray = array(
        "status"    => 'Fail',
        "message"   => 'Unsupported Image Type');
      //echo and exit
      echo json_encode($idArray);
      exit();}

    //if directory doesnt exist create it
    if (!is_dir("$folderPath")) {
      mkdir("$folderPath", 0775, true);}

    //new file name
    $newFileName = uniqid().'-'.time().'.'.$ext;
    $newFilePath="$folderPath/$newFileName";

    //move file
    if(move_uploaded_file($tmpFile,$newFilePath)){

      if($imageType=='photo'){
        propagent::where('id','=',$umid)
        ->update([
          'agtPhoto'=>$newFileName,
        ]);
      }else if($imageType=='logo'){
        propagent::where('id','=',$umid)
        ->update([
          'agtLogo'=>$newFileName
        ]);

      }else{
        dd('error-line61-member/profileController');}

      //setup values
      $idArray = array(
         "status"            => 'Success',
         "message"           => 'Agent Photo Uploaded',
         "newFileName"       => $newFileName,
         "imageType"         => $imageType,
         "newFilePath"       => '/'.$newFilePath,);

      //echo and exit
      echo json_encode($idArray);
      exit();}

    //shouldnt be here
    dd('error-line59-member/profileController');

  }

  public function addProfilePhoto(){
    //return view('admin.adminIndex');
    $adminID=Auth::guard('admin')->user()->id;
    //get admin
    $folderPath = "images/admin/profilePhotos";
    //set file info
    $tmpFile = $_FILES['fileSelect']['tmp_name'];
    $sourceProperties = getimagesize($tmpFile);
    $ext = pathinfo($_FILES['fileSelect']['name'], PATHINFO_EXTENSION);
    $imageType = $sourceProperties[2];

    //error if not an image
    if(!$imageType){
      //setup values
      $idArray = array(
        "status"    => 'Fail',
        "message"   => 'Unsupported Image Type');
      //echo and exit
      echo json_encode($idArray);
      exit();}

    //if directory doesnt exist create it
    if (!is_dir("$folderPath")) {
      mkdir("$folderPath", 0777, true);}

    //new file name
    $newFileName = uniqid().'-'.time().'.'.$ext;
    $newFilePath=$folderPath."/$newFileName";

    //move file
    if(move_uploaded_file($tmpFile,$newFilePath)){

       //update table
       adminTable::where('id','=',$adminID)
       ->update([
          'adminPhoto'=>$newFileName,
       ]);

       //setup values
       $idArray = array(
          "status"            => 'Success',
          "message"           => 'Agent Photo Uploaded',
          "newFileName"       => $newFileName,
          "newFilePath"       => $newFilePath,);

       //echo and exit
       echo json_encode($idArray);
       exit();
    }
  }

}
