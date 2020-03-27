<?php
//models
use App\models\core\propagentcleanup;
//update sql
propagentcleanup::where('propagent_id','=',"$thisID")
->update([
   'agtLogoCheck' => \Carbon\Carbon::now(),
   'agtLogoError' => $agtLogoError,]);
