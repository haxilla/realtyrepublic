<?php

use App\propphoto;

$propflyer_id=propphoto::where('photoID','=',"$id")
->pluck('propflyer_id')
->first();

//set all records to zero for this flyer id
propphoto::where('propflyer_id','=',"$propflyer_id")
->update([
   'def'=>'0'
]);

//set only the current ID as default photo
propphoto::where('photoID','=',"$id")
->where('resized','=','500')
->update([
   'def'=>'1',
   'ord'=>'1'
]);

//get all non defaults and reorder
$newOrder=propphoto::where('propflyer_id','=',"$propflyer_id")
->where('def','=','0')
->where('resized','=','500')
->orderBy('ord')
->get();

//reorder
$newCount=1;
foreach($newOrder as $no){

   //increment loop
   $newCount++;

   //update with consecutive ord
   propphoto::where('photoID','=',"$no->photoID")
   ->where('resized','=','500')
   ->update([
      'ord' =>$newCount
   ]);

};
