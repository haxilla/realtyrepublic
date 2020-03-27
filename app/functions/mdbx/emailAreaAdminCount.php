<?php

use App\models\core\propdelivnow;

$adminCount=propdelivnow::where('campLabel','like','%'.'admin'.'%')
->where('propflyer_id','=',"$idFly")
->count();

$adminCount=$adminCount+1;
$campLabel='admin'.$adminCount;
