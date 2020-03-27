<?php
//get models
use App\models\core\propflyer;
use App\models\core\propphoto;
use App\models\core\propstyle;
use App\models\core\propmeta;
use App\models\core\propmapping;
use App\models\core\propflyerstat;
use App\models\core\propdeliv;
use App\models\core\propdelivnow;
use App\models\core\agtoffice;
//propflyer
propflyer::where('propagent_id','=',"$thisDup")
->update([
   'propagent_id'=>$mainAccountID]);
//propphotos
propphoto::where('propagent_id','=',"$thisDup")
->update([
   'propagent_id'=>$mainAccountID]);
//propstyle
propstyle::where('propagent_id','=',"$thisDup")
->update([
   'propagent_id'=>$mainAccountID]);
//propmeta
propmeta::where('propagent_id','=',"$thisDup")
->update([
   'propagent_id'=>$mainAccountID]);
//propmappin
propmapping::where('propagent_id','=',"$thisDup")
->update([
   'propagent_id'=>$mainAccountID]);
//propflyerstat
propflyerstat::where('propagent_id','=',"$thisDup")
->update([
   'propagent_id'=>$mainAccountID]);
//propdeliv
propdeliv::where('propagent_id','=',"$thisDup")
->update([
   'propagent_id'=>$mainAccountID]);
//propdelivnow
propdelivnow::where('propagent_id','=',"$thisDup")
->update([
   'propagent_id'=>$mainAccountID]);

//Logging
//flyerCountNote
$mergerNotes[0]['flyerCountNote'] =
   "Account# ".$thisDup." had "
   .$theFlyerCount." Flyers Moved into Account# "
   .$mainAccountID;
//flyerIdsMoved
$mergerNotes[0]['flyerIdsMoved'] =
   "Flyer IDs Moved: "
   .$flyerIdsMoved." From Account "
   .$thisDup;



