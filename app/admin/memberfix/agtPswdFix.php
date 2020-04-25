<?php

//model
Use App\models\core\propagent;

$fixCount=request('fixCount');
//query for records
$passHashFix=propagent::select('id','agtPswd')
->whereNull('passHash')
->whereNotNull('agtPswd');

$thisCount=$passHashFix->count();
$passHashLoop=$passHashFix->take(10)
->get();

//loop and fix
foreach($passHashLoop as $the){
  //set values
  $agtPswd=$the->agtPswd;
  $theID=$the->id;
  $theHash=bcrypt($agtPswd);
  //update query
  propagent::where('id','=',$theID)
  ->update([
    'passHash'=>$theHash,
  ]);
}

//output json & exit
$idArray = array(
  'status'        => 'success',
  'fixCount'      => $fixCount,
  'thisCount'     => $thisCount-10,
  'thisPercent'   => $thisCount/$fixCount * 100,gt
);


echo json_encode($idArray);
exit();
