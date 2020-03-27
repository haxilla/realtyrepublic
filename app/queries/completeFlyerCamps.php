<?php
use App\models\core\propdeliv;
$theDate=\Carbon\Carbon::today()->subDays(180);

//original query
$completeCampsQuery=propdeliv::select(
   'propflyer_id','propagent_id','emRequest','campLabel',
   'authorized','emStart','cid','emArea','emArea_display',
   'emSubject')
->whereNotNull('emComplete')
->where('propagent_id','=',"$umid")
->where('propflyer_id','=',"$idFly")
->where('emComplete','>',"$theDate")
->orderBy('emComplete','desc')
->get();
//mapped fields
$completeCampsMap = $completeCampsQuery->map(function ($item) {
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
$completeFlyerCamps=$completeCampsMap->groupBy('propflyer_id');
