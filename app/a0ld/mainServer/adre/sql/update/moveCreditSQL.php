<?php
//   ***
//   ***  YOU ARE IN A LOOP
//   ***  Current recored is $the
//model
Use App\models\core\propagent;
//mainCreds Query
$mainCreds=propagent::where('id','=',"$mainAccountID")
->select('remCreds','pCreds')
->first();
//set variables
$mainRemCreds=$mainCreds['remCreds'];
$mainPcreds=$mainCreds['pCreds'];
//merge
$newRemCreds=$theRemCredCount+$mainRemCreds;
$newPcreds=$thePcredCount+$mainPcreds;
//mainAccountID Update
propagent::where('id','=',"$mainAccountID")
->update([
   'remCreds'  => $newRemCreds,
   'pCreds'    => $newPcreds,
]);
//thisDup Update
propagent::where('id','=',"$moveThis")
->update([
   'remCreds'=>0,
]);
