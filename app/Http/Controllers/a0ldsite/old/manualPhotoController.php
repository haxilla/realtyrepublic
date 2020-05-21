<?php

namespace App\Http\Controllers;

use Auth;
use Request;
use App\propflyer;
use App\propmeta;
use App\propphoto;
use App\propremark;


class manualPhotoController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:web');
  }

  public function addNewPhotos($id){

    $umid=Auth::user()->id;

    $otherFlyers=propflyer::select('xFullStreet',
      'officeID','agtPhoto','agtLogo','startDate','xListPrice',
      'xxBeds','xxBaths','xxSqft','xCity','xState','xxZip','zipDir',
      'mlsDir','photoName','agtFullName')
    ->leftJoin('propflyerstats',
      'propflyerstats.propflyer_id','=','propflyers.id')
    ->leftJoin('propphotos',
      'propphotos.propflyer_id','=','propflyers.id')
    ->leftJoin('propmetas',
      'propmetas.propflyer_id','=','propflyers.id')
    ->leftJoin('propagents',
      'propagents.id','=','propflyers.propagent_id')
    ->whereNotNull('xAgtSent')
    ->where('resized','=','500')
    ->where('def','=','1')
    ->where('orient','=','wide')
    ->orderBy('creationDate','desc')
    ->get()
    ->take(10);

    $propInfo=propflyer::select('xFullStreet','xCity','xState','xZip',
      'xCountyName','xBeds','xBaths','xSqft','xYrBuilt','xPoolPvt','xParking',
      'xListPrice','xMlsNum')
    ->where('id','=',"$id")
    ->where('propagent_id','=',"$umid")
    ->first();

    $propMetas=propmeta::select('zipDir','mlsDir')
    ->where('propflyer_id','=',"$id")
    ->where('propagent_id','=',"$umid")
    ->first();

    $propRemarks=propremark::where('propflyer_id','=',"$id")
    ->where('propagent_id','=',"$umid")
    ->first();

    $propPhotos=propphoto::where('propflyer_id','=',"$id")
    ->where('propagent_id','=',"$umid")
    ->where('resized','=','500')
    ->get();

    $defPhotoName=$propPhotos->where('def','=','1')
    ->pluck('photoName')
    ->first();

    $zipDir=$propMetas['zipDir'];
    $mlsDir=$propMetas['mlsDir'];

    return view('members.create.addPhotos',[
       'otherFlyers'  => $otherFlyers,
       'id'           => $id,
       'propInfo'     => $propInfo,
       'propPhotos'   => $propPhotos,
       'propRemarks'  => $propRemarks,
       'defPhotoName' => $defPhotoName,
       'zipDir'       => $zipDir,
       'mlsDir'       => $mlsDir
    ]);

   }

   public function uploadNewPhotos($id){

      include(app_path() . '/functions/dzupload.php');

   }

   public function resizeNewPhotos($id){

      include(app_path() . '/functions/resizePhotos.php');

      //take back & display
      return redirect()->route('flyerDash', ['id' => $id]);

   }

}
