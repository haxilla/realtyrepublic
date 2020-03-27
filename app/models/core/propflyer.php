<?php

namespace App\models\core;

class propflyer extends \App\Model
{

    //passing dates here will allow carbon functions in output
    protected $dates = ['creationDate','xLastDeliveryDate',
    'created_at','startDate'];

    public static function frontPageIDdesc(){
        $frontPageIDdesc=static::select('xFullStreet','id','propflyer_id',
            'propflyers.propagent_id')
        ->with(['theMeta'=>function($q){
            $q->select('sk1','propflyer_id');
        }])
        ->leftJoin('propflyerstats',
            'propflyers.id', '=', 'propflyerstats.propflyer_id')
        ->where('xAgtSent','=','1')
        ->orderBy('propflyers.id','desc')
        ->take(5)
        ->get();
        return $frontPageIDdesc;
    }

    public static function resizePhoto_w1000(){
        $newFlyerQuery=static::select('id','xFullStreet','creationDate')
        ->whereHas('thePhotos',function($q){
          $q->where('resized','=','0');})
        ->with(['thePhotos'=>function($q){
          $q->select('propflyer_id','photoID','resized',
            'photoName','width')
            ->where('resized','=','0');}])
        ->where('creationDate','>','2018-01-01');
        return $newFlyerQuery;
    }

    public static function getNewPhotoCount(){
        return
        $checkPhotoQuery=propphoto::select('photoID')
        ->where('photoDate','>','2018-08-01')
        ->whereNull('existCheck')
        ->count();
    }

    public static function listingCount(){
        $umid=\Auth::guard('member')->user()->id;
        $listingCount=static::where('propagent_id','=',"$umid")
        ->count();
        return $listingCount;
    }

    public static function propflyer_officeID(){
        $setOfficeID=static::select('id')
        ->whereNull('officeID')
        ->get();
        return $setOfficeID;
    }

    public static function synchFlyerOfficeIDCount(){
        $synchFlyerOfficeIDCount=static::whereNull('officeID')
        ->count();
        return $synchFlyerOfficeIDCount;
    }

    public static function xFieldsFix(){
        $xxFix=static::whereNull('xBaths')
        ->whereNotNull('xxBaths')
        ->get();
        return $xxFix;
    }

    public function currentCamps(){
        return $this->hasMany('App\models\core\propdelivnow','propflyer_id','id');
    }

    public function completeCamps(){
        return $this->hasMany('App\models\core\propdeliv','propflyer_id','id');
    }

    public function thePhotos(){
        return $this->hasMany('App\models\core\propphoto','propflyer_id','id');
    }

    public function theAgent(){
        return $this->belongsTo('App\models\core\propagent','propagent_id','id');
    }

    public function theOffice(){
        return $this->belongsTo('App\models\core\agtoffice','propagent_id','propagent_id');
    }

    public function theMeta(){
        return $this->hasOne('App\models\core\propmeta','propflyer_id','id');
    }

    public function theRemarks(){
        return $this->hasOne('App\models\core\propremark','propflyer_id','id');
    }

    public function theStyle(){
        return $this->hasOne('App\models\core\propstyle','propflyer_id','id');
    }

    public function theMap(){
        return $this->hasOne('App\models\core\propmapping','propflyer_id','id');
    }

    public function theStats(){
        return $this->hasOne('App\models\core\propflyerstat','propflyer_id','id');
    }

    public static function thisFlyerCount(){
      return static::count();
   }

}
