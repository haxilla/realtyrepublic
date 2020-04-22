<?php

//model
Use App\models\core\propagent;

//query for records
$passHashFix=propagent::select('id','agtPswd')
->whereNull('passHash')
->whereNotNull('agtPswd')
->get();

//loop and fix
foreach($passHashFix as $the){
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
  'status'  => 'success',
);
echo json_encode($idArray);
exit();
