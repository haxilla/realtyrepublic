<?php

Use App\models\core\propagent;

$passHashCount=propagent::select('id','agtPswd')
->whereNull('passHash')
->whereNotNull('agtPswd')
->count();

$html=\View::make('admin.overlays.content.passHashCount')
->with([
	'passHashCount'	 => $passHashCount,
])->render();

//echo
echo $html;
//exit
exit();
