<?php

use App\qcreate;
use App\propstyle;

$id=qcreate::where('xMlsNum','=',"$xMlsNum")
->pluck('id')
->first();

$getStyle=propstyle::where('propflyer_id','=',"$id")->first();

$graphic_textcolor   = $getStyle['graphic_textcolor'];
$graphic_style       = $getStyle['graphic_style'];

//json output
$idArray = array(
   'id'                => $id,
   'xMlsNum'           => $xMlsNum,
   'graphic_textcolor' => $graphic_textcolor,
   'graphic_style'     => $graphic_style
);

echo json_encode($idArray);

