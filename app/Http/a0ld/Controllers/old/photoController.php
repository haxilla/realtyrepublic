<?php

namespace App\Http\Controllers;

use App\qcreate;
use App\propphoto;

use Illuminate\Http\Request;

class photoController extends Controller
{

   public function __construct()
   {
      $this->middleware('auth');
   }

   public function add($id){

      $getData=qcreate::select('xMlsNum','zipDir','mlsDir')
      ->where('id','=',"$id")
      ->get()
      ->first();

      $xMlsNum=$getData['xMlsNum'];
      $zipDir=$getData['zipDir'];
      $mlsDir=$getData['mlsDir'];

      return view('members.create.addPhotos',[
         'xMlsNum'   => $xMlsNum,
         'zipDir'    => $zipDir,
         'mlsDir'    => $mlsDir,
         'id'        => $id,
      ]);

   }


   public function change ($id){

      $getData=qcreate::select('xMlsNum','zipDir','mlsDir')
      ->where('id','=',"$id")
      ->get()
      ->first();

      $xMlsNum=$getData['xMlsNum'];
      $zipDir=$getData['zipDir'];
      $mlsDir=$getData['mlsDir'];

      $allPhotos=propphoto::select('photoName','orient','resized','photoID','ord')
      ->where('propflyer_id','=',"$id")
      ->where('def','=','0')
      ->where('resized','=','500')
      ->orderBy('ord')
      ->get();

      $defPhoto=propphoto::where('def','=','1')
      ->where('propflyer_id','=',"$id")
      ->where('resized','=','500')
      ->pluck('photoName')
      ->first();

      $defPhotoName=$defPhoto; //this is set because fromURL needs that variable

      include(app_path() . '/functions/fromURL.php');

      return view('members.create.changePhotos',[
         'xMlsNum'   => $xMlsNum,
         'zipDir'    => $zipDir,
         'mlsDir'    => $mlsDir,
         'allPhotos' => $allPhotos,
         'id'        => $id,
         'defPhoto'  => $defPhoto,
         'fromURL'   => $fromURL
      ]);
   }

   public function qDeletePhoto($photoID){

      $oldfilename=propphoto::where('photoID','=',"$photoID")
      ->pluck('oldfilename')
      ->first();

      $deleteID=propphoto::where('oldfilename','=',"$oldfilename")
      ->get();

      $propflyer_id=propphoto::where('photoID','=',"$photoID")
      ->pluck('propflyer_id')
      ->first();

      $zipDir=qcreate::where('id','=',"$propflyer_id")
      ->pluck('zipDir')
      ->first();

      $mlsDir=qcreate::where('id','=',"$propflyer_id")
      ->pluck('mlsDir')
      ->first();

      foreach($deleteID as $di){

         $filePath="hqphotos/$zipDir/$mlsDir/$di->photoName";

         if(file_exists($filePath)){
            //delete file
            unlink($filePath);
            //delete from database
            $thePhoto = propphoto::find($di->photoID);
            $thePhoto->delete();
         }else{
            //delete from database
            $thePhoto = propphoto::find($di->photoID);
            $thePhoto->delete();
         }

      }

      //reorder photos to
      $reOrder=propphoto::where('propflyer_id','=',"$propflyer_id")
      ->orderBy('ord')
      ->get();

      $newCount=1;
      foreach($reOrder as $ro){

         propphoto::where('photoID','=',"$ro->photoID")
         ->update([
            'ord' =>$newCount
         ]);

         $newCount++;
      }

      return back();
   }

   public function saveOrder(){

      include(app_path() . '/functions/photoSaveOrder.php');

   }

   public function makeDef($id){

      include(app_path() . '/functions/makeDefPhoto.php');

      return back();

   }

   public function resize($id){

      include(app_path() . '/functions/resizePhotos.php');

      return redirect()->route('changePhotos', ['id' => $id]);

   }

}
