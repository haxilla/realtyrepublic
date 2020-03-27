<?php
use App\models\core\propflyer;
use App\models\core\propphoto;
//resize 0
$photo0Check=propflyer::select('id')
->whereHas('thePhotos',function($q){
   $q->where('def','=','0')
   ->where('resized','=','0');
})
->whereDoesntHave('thePhotos',function($q){
   $q->where('def','=','1')
      ->where('resized','=','0');
})
->with(['thePhotos'=>function($q){
   $q->select('propflyer_id','def','resized',
      'photoName','oldfilename','ord','photoID');
}])
->with(['theMeta'=>function($q){
   $q->select('propflyer_id','zipDir','mlsDir');
}])
->get();
//resize 500
$photo500Check=propflyer::select('id')
->whereHas('thePhotos',function($q){
   $q->where('def','=','0')
   ->where('resized','=','500');
})
->whereDoesntHave('thePhotos',function($q){
   $q->where('def','=','1')
   ->where('resized','=','500');
})
->with(['thePhotos'=>function($q){
   $q->select('propflyer_id','def','resized',
      'photoName','oldfilename','ord','photoID');
}])
->with(['theMeta'=>function($q){
   $q->select('propflyer_id','zipDir','mlsDir');
}])
->get();
//update def
foreach($photo0Check as $the){

   $photoID=$the->thePhotos->sortBy('ord')
   ->first()
   ->photoID;

   propphoto::where('photoID','=',"$photoID")
   ->update([
      'def'=>1,
   ]);
}
//update def
foreach($photo500Check as $the){

   $photoID=$the->thePhotos->sortBy('ord')
   ->first()
   ->photoID;

   propphoto::where('photoID','=',"$photoID")
   ->update([
      'def'=>1,
   ]);
}
