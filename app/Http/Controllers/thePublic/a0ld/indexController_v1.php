<?php

namespace App\Http\Controllers\thePublic\a0ld;
use App\Http\Controllers\Controller;

use Request;

class indexController_v1 extends Controller
{

  public function __construct()
  {
    $this->middleware('auth:admin');
  }

  public function index(){

    //index query
    include(app_path().'/queries/indexQuery.php');
    include(app_path().'/queries/memberSinceQuery.php');

    //return view
    return view('mdbxPublic.index',
      [
        'newAdds'     => $newAdds,
        'mostViews'   => $mostViews,
        'memberSince' => $memberSince,
      ]);
  }

  public function contactUsPost(Request $request){
    //captcha code
    if(isset($_POST['g-recaptcha-response'])){
      $captcha=$_POST['g-recaptcha-response'];
    }else{
      $captcha = false;}

    if(!$captcha){
      /** Do something with error  **/
      return redirect()->route('public.index')
      ->with('contactError','You must check the I am not a robot box.  Your message was NOT sent!')
      ->withInput();
    }else{
      //key v3
      //$secret='6LfM_IgUAAAAAFv-xuHB1DCA9WPn25Bs6yM2YLQY';
      //key v2
      $captcha=$_POST['g-recaptcha-response'];
      $secret='6LfSH4kUAAAAAB6RGx4o13Mdfd9UDP41mtNveyy8';
      //set response
      $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
      //decode into json
      $json=json_decode($response);
      //set success
      $success=$json->success;
      //if false error
      //v2 captcha
      if($success==false){
        //Do something with error
        return redirect()->route('public.index')
        ->with('contactError','Sorry we had an issue with that request.  Your message was not sent.')
        ->withInput();
      }
    }
    // The Captcha is valid
    // you can continue with the rest of your code

    //validation fields
    $senderName     = request('senderName');
    $senderEmail    = request('senderEmail');
    $contactSubject = request('contactSubject');
    $theMsg         = request('theMsg');
    //validation rules
    $validator = \Validator::make($request::all(), [
       'senderName'       => 'Required|min:5',
       'senderEmail'      => 'Required|email',
       'theMsg'           => 'Required',
    ]);
    //if it doesnt pass redirect
    if(!$validator->passes()){
       return redirect()->route('public.index')
       ->withInput()
       ->with('contactError','Missing Information!')
       ->withErrors($validator);}

    // all validated
    // safe to continue

    //enter into database
    pubContact::create([
      'senderName'      => $senderName,
      'senderEmail'     => $senderEmail,
      'theMsg'          => $theMsg,
    ]);
    //send email to admin


    //redirect back
    return redirect()->route('public.index')
    ->with('contactSuccess','Thanks for contacting us! Your request has been submitted');

  }

  public function contactUsPage(){
    return view('mdbxPublic.fullPages.contactUsPage');
  }

  public function propInfo(){
    //get id
    $id=request('id');
    $sk1=$id;
    //error if none
    if(!$id){
      dd('error-line62-mdbxPropFlyerController');}

    //get real id
    $findSk1=propmeta::where('sk1','=',"$id")
    ->pluck('propflyer_id')
    ->first();
    //error if none
    if(!$findSk1){
      dd('error-line70-mdbxPropFlyerController');}
    //set real id
    $idFly=$findSk1;
    //maxPhotoSize
    include(app_path().'/functions/flyers/maxPhotoSize.php');

    //run query
    $getFlyer = propflyer::select('xFullStreet','propagent_id',
      'xListPrice','xBeds','xxBeds','xBaths','xxBaths','xSqft','xxSqft',
      'xYrBuilt','xxYrBuilt','xCity','xState','xxZip','xMlsNum','xParking',
      'xPoolPvt','id','xHeadline','xxHeadline')
    ->with(['thePhotos' => function($query)use($maxResize){
      $query->select('propflyer_id','photoName','def','orient')
      ->where('resized','=',"$maxResize");
    }])
    ->with(['theAgent'=>function($query){
      $query->select('id','agtFullName','agtWebsite',
      'agtMainPhone','agtPhoto','agtLogo','officeID');
    }])
    ->with(['theOffice'=>function($query){
      $query->select('officeName','propagent_id','officeID');
    }])
    ->with(['theRemarks'=>function($query){
      $query->select('propflyer_id','xb1','xb2','xb3','xb4',
        'xb5','xb6','xb7','xb8','xPubRemarks');
    }])
    ->with(['theMeta'=>function($query){
      $query->select('propflyer_id','zipDir','mlsDir','sk1');
    }])
    ->with(['theMap'=>function($query){
      $query->select('propflyer_id','googlat','googlng','xIntersection');
    }])
    ->where("id","=","$idFly")
    ->get();

    //error if not found
    if(!$getFlyer){
      dd('Sorry, no matching flyer found!');}

    //check for mapping coords
    if(!$getFlyer[0]->theMap->googlat||
    !$getFlyer[0]->theMap->googlng){
      include(app_path().'/functions/googleMaps/getSEOnames.php');
      if($xCity && $xState && $xZip && $xFullStreet){
        include(app_path().'/functions/googleMaps/getGoogleMap.php');
      }}

    //if variables not set above they are in the query
    //its done this way to pass it over the first time
    //otherwise the update is not in the query
    if(!isset($googlat)||!isset($googlng)){
      $googlat=$getFlyer[0]->theMap->googlat;
      $googlng=$getFlyer[0]->theMap->googlng;}

    if(!$googlat||!$googlng){//sendadminError
    }

    $fbURL="http://www.realtyrepublic.com/propInfo?id=$sk1";
    /*
    $twitText=urlEncode("$xFullStreet - $xCity, $xState -
    $xxBeds Beds / $xxBaths Baths $xxSqft sqft -
    $".number_format($xListPrice));
    */

    return view('mdbxPublic.fullPages.propInfo', [
      'getFlyer'  => $getFlyer,
      'googlat'   => $googlat,
      'googlng'   => $googlng,
      'fbURL'     => $fbURL,
    ]);

  }

  public function propPrint(){
    $id=request('id');
    //get id/umid
    if(!$id){
       dd('error-line120-mdbxPropFlyerController');}
    //get propflyer_id
    $getMeta=propmeta::where('sk1','=',"$id")
    ->select('propflyer_id','propagent_id')
    ->first();
    $idFly=$getMeta['propflyer_id'];
    $umid=$getMeta['propagent_id'];
    //error if none
    if(!$idFly){
       dd('error-line147-mdbxFlyerBranchController');}
    //propInfo
    $propInfo=propflyer::select(
       'xFullStreet','xCity','xState','xZip',
       'xListPrice','xxZip','xMlsNum','xMlsNum',
       'xBeds','xxBeds','xBaths','xxBaths','xSqft',
       'xxSqft','id')
    ->where('id','=',"$idFly")
    ->with(['theRemarks'=>function($q){
       $q->select('propflyer_id','propagent_id','xb1',
          'xb2','xb3','xb4','xb5','xb6','xb7','xb8',
          'xPubRemarks');
    }])
    ->where('propagent_id','=',"$umid")
    ->first();
    //error if none
    if(!$propInfo){
       dd('error-line98-mdbxFlyerBranchController');}

    $propMetas=propmeta::select('zipDir','mlsDir','sysID')
    ->where('propflyer_id','=',"$idFly")
    ->first();

    $agentInfo=propagent::select(
       'agtFullName','agtPhoto','officeID','agtMainPhone',
       'agtWebsite','agtLogo','id'
    )->where('id','=',"$umid")
    ->with(['theAgtOffice'=>function($q){
       $q->select('officeName','officeID','propagent_id',
          'officeAddress1','officeCity','officeState','officeZip');
    }])
    ->first();

    $allPhotos=propphoto::select('photoName')
    ->where('propflyer_id','=',"$idFly")
    ->where('resized','=','500');

    $accountInfo=propagent::select(
      'officeID','agtPhoto','agtFullName','agtState','agtReview',
      'accountType','remCreds','expireDate')
    ->where('id','=',"$umid")
    ->first();

    $photoInfo=propagentmeta::select('newRemID')
   ->where('propagent_id','=',"$umid")
   ->first();

    $getDef=clone $allPhotos;
    $defPhotoName=$getDef->where('def','=','1')->pluck('photoName')->first();
    $photos=$allPhotos->where('def','=','0')->get();

    include(app_path() . '/flyerVariables/mdbxCountBullets.php');

    return view ('mdbxPublic.fullPages.mdbxPrint',[
       'propInfo'     => $propInfo,
       'propMetas'    => $propMetas,
       'agentInfo'    => $agentInfo,
       'photoInfo'    => $photoInfo,
       'defPhotoName' => $defPhotoName,
       'remHeight'    => $remHeight,
       'photos'       => $photos,
       'accountInfo'  => $accountInfo
    ]);
  }

  public function moreInfo(){
  }

  public function faq(){
    return view('mdbxPublic.fullPages.faq');
  }

  public function propSlides(){

    $allSlides=propflyer::select(
      'id','xFullStreet','propagent_id','xListPrice','xCity','xState','xZip',
      'xxZip','xxBeds','xxBaths','xxSqft','xBeds','xBaths','xSqft')
    ->where('xListPrice','>','0')
    ->with(['thePhotos' => function($query) {
      $query->select('propflyer_id','photoName')
      ->where('def','=','1')
      ->where('resized','=','500');
    }])
    ->whereHas('thePhotos',function($query){
      $query->select('propflyer_id','photoName')
      ->where('def','=','1')
      ->where('resized','=','1');
    })
    ->with(['theAgent'=>function($query){
      $query->select('id','agtFullName');
    }])
    ->with(['theMeta'=>function($query){
      $query->select('propflyer_id','zipDir','mlsDir','sk1');
    }])
    ->with(['theStats'=>function($query){
      $query->select('propflyer_id','xAgtSent');
    }])
    ->with(['theRemarks'=>function($query){
      $query->select('propflyer_id','xPubRemarks');
    }])
    ->whereHas('theStats', function ($query) {
      $query->where('xAgtSent','>',0);});

    //clone for final queries
    $mostRecent = clone $allSlides;
    $mostViews  = clone $allSlides;
    $highPrice  = clone $allSlides;
    $lowPrice   = clone $allSlides;
    //final queries
    $mostRecent=$mostRecent->orderBy('creationDate','desc')->simplePaginate(5);
    $mostViews=$mostViews->orderBy('xListPrice','desc')->simplePaginate(5);
    $highPrice=$highPrice->orderBy('xListPrice','desc')->simplePaginate(5);
    $lowPrice=$lowPrice->orderBy('xListPrice','asc')->simplePaginate(5);

    //view
    return view('mdbxPublic.fullPages.slides',[
      'mostRecent'  => $mostRecent,
      'mostViews'   => $mostViews,
      'highPrice'   => $highPrice,
      'lowPrice'    => $lowPrice,
    ]);

  }

}
