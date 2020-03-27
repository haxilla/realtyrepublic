<?php
use App\models\core\propdelivnow;

//original query
$currentCampsQuery=propdelivnow::select(
   'propflyer_id','propagent_id','emRequest','campLabel',
   'authorized','emStart','cid','emArea','emArea_display',
   'emSubject')
->whereNotNull('emRequest')
->whereNull('emComplete')
->where('propagent_id','=',"$umid")
->where('propflyer_id','=',"$idFly")
->orderBy('emRequest')
->get();
//mapped fields
$currentCampsMap = $currentCampsQuery->map(function ($item) {
    return [
      'campLabel'    => $item->campLabel,
      'propflyer_id' => $item->propflyer_id,
      'emSubject'    => $item->emSubject,
      'emArea'       => $item->emArea,
      'emStart'      => $item->emStart,
      'emRequest'    => $item->emRequest,
      'cid'          => $item->cid,
    ];
});
//groupBy propflyer_id
$currentFlyerCamps=$currentCampsMap->groupBy('propflyer_id');
