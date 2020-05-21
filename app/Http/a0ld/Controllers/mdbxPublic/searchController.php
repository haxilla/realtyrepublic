<?php

namespace App\Http\Controllers\mdbxPublic;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\models\core\propmeta;
use App\models\core\propflyer;

class searchController extends Controller
{
   public static function flyerSearch(){
      //set variable to form value
      $formEntry=request('propIDsearch');
      if(!$formEntry){
         return redirect()->route('public.propSlides');}
      //search for ID by sysID
      $theID=propmeta::findBySysID($formEntry);
      //if collection is empty - must use ->first() to detect
      if($theID->first()){
         $id=$theID[0]->sk1;
         return redirect()->route('public.propInfo', ['id' => $id]);}
      //search for ID by mlsNum
      $theID=propflyer::where('xMlsNum','=',"$formEntry")->get();
      //if collection is empty - must use ->first() to detect
      if($theID->first()){
         //get ID
         $idFly=$theID[0]->id;
         //query meta
         $getMeta=propmeta::where('propflyer_id','=',"$idFly")
         ->first();
         //set sk1
         $id=$getMeta['sk1'];
         return redirect()->route('public.propInfo', ['id' => $id]);
      }

      //if you're here there are no results
      return redirect()->route('public.propSlides')->withErrors([
         'Sorry, no results for that search!'
      ]);
   }

   public static function featureSearch(){

      $location=request('location');
      $minPrice=request('minPrice');
      $maxPrice=request('maxPrice');
      $searchResults=propflyer::orderBy('xLastDeliveryDate','desc')
      ->leftJoin(
         'propflyerstats',
         'propflyerstats.propflyer_id','=','propflyers.id');

      if (!empty($location)){
         $searchResults->where('xState','=', $location);}

      if (!empty($minPrice)){
         $searchResults->where('xListPrice','>=', $minPrice);}

      if (!empty($maxPrice)){
         $searchResults->where('xListPrice','<=', $maxPrice);}

      if (!empty($xBeds)) {
         $searchResults->where('xxBeds','>=', $xBeds);}

      if (!empty($xBaths)) {
         $searchResults->where('xxBaths','>=', $xBaths);}

      $searchResults=$searchResults
      ->with(['theAgent'=>function($q){
         $q->select('id','agtFullName');
      }])
      ->with(['theRemarks'=>function($q){
         $q->select('propflyer_id','xPubRemarks');
      }])
      ->with(['theMeta'=>function($q){
         $q->select('propflyer_id','mlsDir','zipDir','sk1');
      }])
      ->with(['thePhotos'=>function($q){
         $q->select('propflyer_id','photoName')
         ->where('resized','=','500')
         ->where('def','=','1');
      }])
      ->simplePaginate(5);

      return view('mdbxPublic.fullPages.slideResults',['searchResults'=>$searchResults]);

   }
}
