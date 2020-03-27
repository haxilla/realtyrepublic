<?php
use App\models\core\propagent;
use App\models\oldsite\oldAgent;

//update database to date checked
propagent::where('id','=',"$mainAccountID")
->update([
   'agtPhotoCheck' => $now,
   'agtLogoCheck'  => $now,
]);

/* //REALTYEMAILS SERVER
oldAgent::where('umid','=',"$mainAccountID")
->update([
   'agtPhotoCheck'=>1,
   'agtLogoCheck'=>1,
]);
*/
