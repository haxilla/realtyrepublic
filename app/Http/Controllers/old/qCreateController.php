<?php

namespace App\Http\Controllers;

use Request;
use App\bbremailflyer;
use App\bbphotoimports;
use App\propphoto;
use App\qcreate;
use Validator;

class qCreateController extends Controller
{

   //members only
   public function __construct(){
      $this->middleware('auth');
   }

  //import text form
  public function create($xMlsNum){

    //query the table where the data is stored
    $getBBs = bbremailflyer::where('agiMlsNum','=',"$xMlsNum")->first();

    if(!$getBBs){
      dd('error resuming this flyer, please delete and re-create');
    }

    //set variables
    $xListPrice =  $getBBs['bbPrice'];
    $xBeds      =  $getBBs['bbBeds'];
    $xBaths     =  $getBBs['bbBaths'];
    $xSqft      =  $getBBs['bbSqft'];
    $xYrBuilt   =  $getBBs['bbYrBuilt'];
    $bbVT       =  $getBBs['bbVT'];
    $pubRemarks =  $getBBs['bbRemarks'];

    //get the address fields from initial form
    $qAddress      = qcreate::where('xMlsNum','=',"$xMlsNum")->first();
    $xFullStreet   = $qAddress['xFullStreet'];
    $xIntersection = $qAddress['xIntersection'];
    $xCity         = $qAddress['xCity'];
    $xState        = $qAddress['xState'];
    $xZip          = $qAddress['xZip'];
    $zipDir        = $qAddress['xZip'];
    $xPoolPvt      = $qAddress['xPoolPvt'];
    $xParking      = $qAddress['xParking'];
    $f             = $qAddress['id'];
    $mlsDir        = $xMlsNum;

    //get newKey equivalent to find photos
    $newKey     = $getBBs['newKey'];

    //find default photos
    $defPhotos  = bbphotoimports::where('def','=','1')
                ->where('newKey','=',"$newKey")
                ->get();

    if( !$defPhotos->first() ){
      dd('Error resuming this flyer please delete & re-create!');
    }

    if (!is_dir("hqphotos/$zipDir/$mlsDir")) {
        mkdir("hqphotos/$zipDir/$mlsDir", 0777, true);
    }

    foreach($defPhotos as $dp){

      //set paths
      $remoteFile=$dp->bbPhotoURL;
      $photoName=$dp->photoName;
      $localFile="hqphotos/$zipDir/$mlsDir/$photoName";

      //copy file
      if(!file_exists($localFile)){

        //move over
        copy("$remoteFile","$localFile");

        //insert to local DB to avoid remote connection in future
        propphoto::create([
          'photoName'       => $dp->photoName,
          'propflyer_id'    => $f,
          'propagent_id'    => $dp->m,
          'importID'        => $dp->importID,
          'photoDate'       => $dp->photoDate,
          'photoURL'        => $dp->photoURL,
          'sysID'           => $dp->sysID,
          'domain'          => $dp->domain,
          'bbPhotoCount'    => $dp->bbPhotoCount,
          'urlPhotoCount'   => $dp->urlPhotoCount,
          'ord'             => $dp->ord,
          'def'             => $dp->def,
          'clean'           => $dp->clean,
          'exif1'           => $dp->exif1,
          'exif2'           => $dp->exif2,
          'width'           => $dp->width,
          'height'          => $dp->height,
          'ratio'           => $dp->ratio,
          'orient'          => $dp->orient,
          'resized'         => $dp->resized,
          'resize_h'        => $dp->resize_h,
          'resize_w'        => $dp->resize_w,
          'oldFileSize'     => $dp->oldFileSize,
          'newFileSize'     => $dp->newFileSize,
          'oldFileName'     => $dp->oldFileName,
          'agtX'            => $dp->agtX,
          'agtXDate'        => $dp->agtXDate
        ]);
      }
    }

    bbphotoimports::where('newKey','=',"$newKey")
    ->where('photoName','=',"$photoName")
    ->update(['moved' => 1]);

    //return view of populated form data
    return view('members.textImport_view',
    [
       'xListPrice'   => $xListPrice,
       'xMlsNum'      => $xMlsNum,
       'xFullStreet'  => $xFullStreet,
       'xIntersection'=> $xIntersection,
       'xCity'        => $xCity,
       'xState'       => $xState,
       'xZip'         => $xZip,
       'xBeds'        => $xBeds,
       'xBaths'       => $xBaths,
       'xSqft'        => $xSqft,
       'xYrBuilt'     => $xYrBuilt,
       'zipDir'       => $zipDir,
       'mlsDir'       => $xMlsNum,
       'bbVT'         => $bbVT,
       'pubRemarks'   => $pubRemarks,
       'photoName'    => $dp->photoName
    ]);

  }

  //validate and save input
  public function store(Request $request) {

    $validator = Validator::make($request::all(), [
      'xMlsNum'         => 'Required|Numeric|digits_between:2,15',
      'xIntersection'   => 'Required',
      'xListPrice'      => 'Required|Numeric',
      'xFullStreet'     => 'Required',
      'xCity'           => 'Required',
      'xState'          => 'Required|size:2|string',
      'xZip'            => 'Required|Numeric|digits:5|',
      'xBeds'           => 'Required|Numeric',
      'xBaths'          => 'Required|Numeric',
      'xSqft'           => 'Required|Numeric',
      'xYrBuilt'    => 'Required|Numeric|digits:4',
      'xPoolPvt'    => 'Required|notIn:Select',
      'xParking'    => 'Required|notIn:Select'
    ]);

    //set variables to use from form
    $xMlsNum        = $request::input('xMlsNum');
    $xIntersection  = $request::input('xIntersection');
    $xListPrice     = $request::input('xListPrice');
    $xFullStreet    = $request::input('xFullStreet');
    $xCity          = $request::input('xCity');
    $xState         = $request::input('xState');
    $xZip           = $request::input('xZip');
    $xBeds          = $request::input('xBeds');
    $xBaths         = $request::input('xBaths');
    $xSqft          = $request::input('xSqft');
    $xYrBuilt       = $request::input('xYrBuilt');
    $xPoolPvt       = $request::input('xPoolPvt');
    $xParking       = $request::input('xParking');
    $xPubRemarks    = $request::input('xPubRemarks');

    //if it passes update record and share variables
    if ($validator->passes()) {

      $update=qcreate::where('xMlsNum', "$xMlsNum")
      ->update([
        'xListPrice'    => $xListPrice,
        'xIntersection' => $xIntersection,
        'xBeds'         => $xBeds,
        'xBaths'        => $xBaths,
        'xSqft'         => $xSqft,
        'xYrBuilt'      => $xYrBuilt,
        'xPoolPvt'      => $xPoolPvt,
        'xParking'      => $xParking,
        'xPubRemarks'   => $xPubRemarks

      ]);

      $sk1=qcreate::where('xMlsNum','=',"$xMlsNum")
      ->pluck('sk1')->first();

      $zipDir=qcreate::where('xMlsNum','=',"$xMlsNum")
      ->pluck('zipDir')->first();

      $mlsDir=qcreate::where('xMlsNum','=',"$xMlsNum")
      ->pluck('mlsDir')->first();

      $pCount=bbphotoimports::where('newKey','=',"$sk1")
      ->where('def','=','1')
      ->pluck('urlPhotoCount')
      ->first();

      $bbPhotoURL=bbphotoimports::where('newKey','=',"$sk1")
      ->where('def','=','1')
      ->pluck('bbPhotoURL')
      ->first();

       $photoName=bbphotoimports::where('newKey','=',"$sk1")
      ->where('def','=','1')
      ->pluck('photoName')
      ->first();

      $photoLeft=bbphotoimports::where('newKey','=',"$sk1")
      ->where('DL','=','0')
      ->count();

      return response()->json([
        'xMlsNum'     => $xMlsNum,
        'xFullStreet' => $xFullStreet,
        'xCity'       => $xCity,
        'xState'      => $xState,
        'xZip'        => $xZip,
        'pCount'      => $pCount,
        'bbPhotoURL'  => $bbPhotoURL,
        'photoLeft'   => $photoLeft,
        'sk1'         => $sk1,
        'zipDir'      => $zipDir,
        'mlsDir'      => $mlsDir,
        'photoName'   => $photoName
      ]);
    }

    //back to form with errors
    return response()->json(['error'=>$validator->errors()->all()]);

  }

}
