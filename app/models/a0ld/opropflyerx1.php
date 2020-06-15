<?php

namespace App\models\old;

class opropflyerx1 extends \App\Model
{

    //passing dates here will allow carbon functions in output
    protected $dates = ['creationDate','xLastDeliveryDate','created_at','startDate'];

    //function to show indexHomes
    /*
    public static function indexHomes(){

        return static::select('creationDate',
        'xFullStreet',
        'xCity',
        'xState',
        'xZip',
        'xxBeds',
        'xxBaths',
        'xxSqft',
        'xListPrice',
        'agtPhoto',
        'agtFullName',
        'propagents.officeID',
        'officeName',
        'agtMainPhone',
        'zipDir',
        'mlsDir',
        'photoName',
        'propflyers.id as id'
        )
        ->leftJoin('propagents' , 'propflyers.propagent_id', '=', 'propagents.id')
        ->leftJoin('propphotos' , 'propflyers.id','=','propphotos.propflyer_id')
        ->leftJoin('agtoffices' , 'propagents.id','=','agtoffices.propagent_id')
        ->leftJoin('propmetas' , 'propflyers.id','=','propmetas.propflyer_id')
        ->leftJoin('propflyerstats','propflyers.id','=','propflyerstats.propflyer_id')
        ->where( 'creationDate', '>', \Carbon\Carbon::now()->subDays(7))
        ->where('xAgtSent','>','0')
        ->where('def','=','1')
        ->where('resized','!=','500')
        ->whereNotNull('xFullStreet')
        ->get();

    }
    */
    /*
    public static function mostViews(){

        return static::select('creationDate',
        'xFullStreet',
        'xCity',
        'xState',
        'xZip',
        'xxBeds',
        'xxBaths',
        'xxSqft',
        'xListPrice',
        'agtPhoto',
        'agtFullName',
        'propagents.officeID',
        'officeName',
        'agtMainPhone',
        'xWebViews',
        'zipDir',
        'mlsDir',
        'photoName',
        'propflyers.id as id'
        )

        ->leftJoin('propagents' , 'propflyers.propagent_id', '=', 'propagents.id')
        ->leftJoin('propphotos' , 'propflyers.id','=','propphotos.propflyer_id')
        ->leftJoin('agtoffices' , 'propagents.id','=','agtoffices.propagent_id')
        ->leftJoin('propmetas' , 'propflyers.id','=','propmetas.propflyer_id')
        ->leftJoin('propflyerstats','propflyers.id','=','propflyerstats.propflyer_id')
        ->where( 'xLastDeliveryDate', '>', \Carbon\Carbon::now()->subDays(7))
        ->where('xAgtSent','>','0')
        ->where('def','=','1')
        ->where('resized','=','500')
        ->whereNotNull('xFullStreet')
        ->orderBy('xWebViews','desc')
        ->take(4)
        ->get();
    }
    */

    public static function memberRecent(){
        $umid=\Auth::guard('web')->user()->id;

        $memberRecent=static::select('id','xFullStreet')
        ->with(['thePhotos'=>function($q){
            $q->select(
                'photoName','propflyer_id',
                'def','resized')
                ->where('resized','=','500');
        }])
        ->with(['theMeta'=>function($q){
            $q->select('zipDir','mlsDir','propflyer_id','sk1');
        }])
        ->where('propagent_id','=',"$umid")
        ->orderBy('creationDate','desc')
        ->simplePaginate(5);

        return $memberRecent;

    }

    public static function listingCount(){
        $umid=\Auth::guard('web')->user()->id;
        $listingCount=static::where('propagent_id','=',"$umid")
        ->count();
        return $listingCount;
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
        return $this->belongsTo('App\models\core\agtoffice','officeID','officeID');
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

}
