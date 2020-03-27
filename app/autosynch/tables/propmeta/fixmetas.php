<?php

Use App\autosynch\models\propmeta\propmetas;

//find spaces in zipDir
$trimMeta=propmetas::where('zipDir','like',' '.'%')
->select('propflyer_id','zipDir')
->get();

//loop & fix
foreach($trimMeta as $the){
  $fixedZip=trim($the->zipDir);
  propmetas::where('propflyer_id','=',"$the->propflyer_id")
  ->update([
    'zipDir'=>$fixedZip,
  ]);}