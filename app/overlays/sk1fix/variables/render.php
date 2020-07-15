<?php

//get models
use App\models\core\propmeta;
use App\models\oldsite\oldFlyer;
use App\models\remarchives\remailflyersmaster;

//query
$fixSK1=propmeta::select('propflyer_id')
->whereNull('sk1')
->orWhere('sk1','like','%'.'='.'%');

//get count
$sk1_fixCount=$fixSK1->count();

//notice if not needed
if(!$sk1_fixCount > 0){
  dd('no fix needed');}

$html=\View::make('admin.overlays.content.sk1Fix')
->with([
	'sk1_fixCount'	 => $sk1_fixCount,
])->render();

//echo
echo $html;
//exit
exit();
