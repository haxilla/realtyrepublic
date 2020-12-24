<?php

Use App\autosynch\models\downloads\propphotoResize;

$resizeQuery=propphotoResize::select(
	'photoID','photoName','propflyer_id','propagent_id',
	'width','height','orient','def','ord','oldFileSize'
)->where('photoDate','>','2017-01-01')
->where('resized','=',0)
->with(['theMeta'=>function($q){
   $q->select('zipDir','mlsDir','propflyer_id');
}]);