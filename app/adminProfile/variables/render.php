<?php

use App\models\admin\adminTable;

$adminID=auth()->guard('admin')->user()->id;

$adminInfo=adminTable::where('id','=',"$adminID")
->first();

$hasPhoto=1;
$adminPhoto=$adminInfo['adminPhoto'];

if(!$adminPhoto){
	$adminPhoto="noProfilePhoto3.jpg";
	$hasPhoto=0;}

//return html
$html=\View::make('admin.overlays.content.adminProfileForm')
->with([
	'responseOverlayTitle'	  => 'Admin Profile',
	'responseOverlaySubtitle' => "Review & Edit if needed",
	'adminInfo'				  => $adminInfo,
	'adminPhoto'			  => $adminPhoto,
	'hasPhoto'				  => $hasPhoto,
])->render();

//echo
echo $html;
//exit
exit();