<?php
//model
Use App\models\core\propflyer;
//query
$newFlyerQuery=propflyer::select('id','xFullStreet',
   'creationDate','propagent_id')
->whereHas('thePhotos',function($q1){
  $q1->where('resized','=','0');})
->with(['theMeta'=>function($q2){
   $q2->select('zipDir','mlsDir','propflyer_id');}])
->with(['thePhotos'=>function($q3){
  $q3->select('propflyer_id','photoID','resized',
    'photoName','width','height','orient','ratio',
    'ord','def','photoName','oldFileSize')
  ->where('resized','=','0');}])
->where('creationDate','>','2018-01-01');
//totalRecord from original
$totalFlyerRecords=$newFlyerQuery->count();
//query
$newFlyerRecord=$newFlyerQuery
->take(1)
->get();
