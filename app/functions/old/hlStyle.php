<?php

use App\propstyle;

propstyle::where('propflyer_id','=',"$id")
->update([
   'graphic_style'=>$style
]);
