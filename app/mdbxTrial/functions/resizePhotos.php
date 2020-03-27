<?php
//model
Use App\models\core\propphoto;
//query
$resizePhotos=propphoto::where('propflyer_id','=',$newID)
->where('resized','=','0')
->get();
//function for resize
require_once(app_path().'/functions/imageControl/mdbxImageOptimize.php');
//loop
foreach($resizePhotos as $t){
	include(app_path().'/functions/imageControl/newFlyerPhotos500w300h.php');
	include(app_path().'/functions/imageControl/newFlyerPhotos1000w600h.php');
	//update as resized
	propphoto::where('photoID','=',"$t->photoID")
	->update([
	   'resized'=>1
	]);
}


