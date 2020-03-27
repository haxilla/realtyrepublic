<?php

namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;
use App\models\admin\adminTable;
use Request;
use Validator;
use Auth;

class adminProfileController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:admin');
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

  public function deleteProfilePhoto(){
    //get umid
    $adminID=Auth::guard('admin')->user()->id;
    //error if nonen
    if(!$adminID){
       //setup values
       $idArray = array(
          "status"            => "Failed",
          "message"           => "Issue with adminID",);

       //echo and exit
       echo json_encode($idArray);
       exit();}

    //query for photo
    $getPhoto=adminTable::where('id','=',$adminID)
    ->select('adminPhoto')
    ->first();

    //set photo
    $adminPhoto=$getPhoto['adminPhoto'];

    //file
    $fullPath="images/admin/profilePhotos/$adminPhoto";

    //check it exists
    if(file_exists($fullPath)){
      $exists="1";
    }else{
      $exists=null;}

    //delete if it does
    if($exists && unlink($fullPath)){
      $status="Success";
      $message="Admin Photo Deleted";
    }else{
      $status="Fail";
      $message="Error Finding or Deleting Admin Photo";}

    //remove photo values
    adminTable::where('id','=',$adminID)
    ->update([
       'adminPhoto'           => null,
    ]);

    //setup values
    $idArray = array(
       "status"            => $status,
       "message"           => $message,);

    //echo and exit
    echo json_encode($idArray);
    exit();

  }

  public function profileUpdate(Request $request){

    //get umid
    $adminID=Auth::guard('admin')->user()->id;

    //validate
    $validator = Validator::make($request::all(), [
      'adminFirst'    => 'bail|required|min:3',
      'adminLast'     => 'bail|required|min:3',
      'adminHandle'   => 'bail|required|min:3|max:13',
      'adminPosition' => 'bail|required|min:3',
      'adminPhone'    => 'bail|required|min:7|max:12',
      'adminEmail'    => 'bail|required|email',
    ]);

    //if fails return back
    if ($validator->fails()){
      return response()->json([
        'errors'=>$validator->errors()->all()
      ]);}

    adminTable::where('id','=',$adminID)
    ->update([
      'adminFirst'    =>request('adminFirst'),
      'adminLast'     =>request('adminLast'),
      'adminHandle'   =>request('adminHandle'),
      'adminPosition' =>request('adminPosition'),
      'adminPhone'    =>request('adminPhone'),
      'adminEmail'    =>request('adminEmail'),
    ]);

    //setup values
    $idArray = array(
       "status"            => "Success",
       "adminName"         => request("adminHandle"),
    );

    //echo and exit
    echo json_encode($idArray);
    exit();

  }

}