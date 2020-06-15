<?php

namespace App;
use \Carbon\Carbon;

class propslide extends Model
{

   protected $table = 'propflyers';

   public static function mostRecent(){

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
        'xPubRemarks',
        'propflyers.id as id'
        )
        ->leftJoin('propagents' , 'propflyers.propagent_id', '=', 'propagents.id')
        ->leftJoin('propphotos' , 'propflyers.id','=','propphotos.propflyer_id')
        ->leftJoin('agtoffices' , 'propagents.id','=','agtoffices.propagent_id')
        ->leftJoin('propmetas' , 'propflyers.id','=','propmetas.propflyer_id')
        ->leftJoin('propflyerstats','propflyers.id','=','propflyerstats.propflyer_id')
        ->leftJoin('propremarks','propflyers.id','=','propremarks.propflyer_id')
        ->where('creationDate','>',Carbon::now()->subDays(30))
        ->where('xAgtSent','>','0')
        ->where('def','=','1')
        ->where('resized','=','500')
        ->where('xListPrice','>','0');
   }

    public static function featureSearch(){

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
        'xPubRemarks',
        'propflyers.id as id'
        )
        ->leftJoin('propagents' , 'propflyers.propagent_id', '=', 'propagents.id')
        ->leftJoin('propphotos' , 'propflyers.id','=','propphotos.propflyer_id')
        ->leftJoin('agtoffices' , 'propagents.id','=','agtoffices.propagent_id')
        ->leftJoin('propmetas' , 'propflyers.id','=','propmetas.propflyer_id')
        ->leftJoin('propflyerstats','propflyers.id','=','propflyerstats.propflyer_id')
        ->leftJoin('propremarks','propflyers.id','=','propremarks.propflyer_id')
        ->where( 'xLastDeliveryDate', '>', Carbon::now()->subDays(30))
        ->where('xAgtSent','>','0')
        ->where('def','=','1')
        ->where('resized','=','500')
        ->whereNotNull('xFullStreet');
    }

}
