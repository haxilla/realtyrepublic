<?php

use App\propflyer;

$otherFlyers=propflyer::select(
  'agtFullName','mlsDir','zipDir','xFullStreet','photoName',
  'officeID','agtPhoto','agtLogo','startDate','xListPrice',
  'xxBeds','xxBaths','xxSqft','xCity','xState','xxZip')
->leftJoin('propflyerstats',
  'propflyerstats.propflyer_id','=','propflyers.id')
->leftJoin('propphotos',
  'propphotos.propflyer_id','=','propflyers.id')
->leftJoin('propmetas',
  'propmetas.propflyer_id','=','propflyers.id')
->leftJoin('propagents',
  'propagents.id','=','propflyers.propagent_id')
->whereNotNull('xAgtSentCount')
->where('resized','=','500')
->where('def','=','1')
->where('orient','=','wide')
->orderBy('creationDate','desc')
->get()
->take(10);
