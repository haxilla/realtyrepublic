<?php
use App\models\core\propflyer;
//theDate=today-30

//base query
include('baseQuery.php');
//clone & continue
$newAdds    = clone $baseQuery;
$mostViews  = clone $baseQuery;
//new Adds = ordered by created_at desc
$newAdds=$newAdds
->whereHas('thePhotos',function($q){
  $q->where('def','=','1')
    ->where('resized','=','1000')
    ->where('orient','=','wide');
})
->with(['thePhotos'=>function($q){
  $q->select('propflyer_id','photoName','def','resized',
    'width','height','orient','ratio','ord')
    ->where('resized','=','1000')
    ->where('def','=','1');
}])
->orderBy('propflyers.creationDate','desc')
->take(5)
->get();
//error if none
if(!$newAdds){
  dd('error-line43-indexquery.php');}

//most Views = ordered by xWebViews desc
$mostViews=$mostViews
->with(['thePhotos'=>function($q){
  $q->select('propflyer_id','photoName','def','resized')
    ->where('resized','=','500')
    ->where('def','=','1');
}])
->take(6)
->orderBy('xWebViews','desc')
->get();
