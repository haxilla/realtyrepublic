<?php
//model
Use App\models\core\propagent;
//mainAccountID Update
propagent::where('id','=',"$mainAccountID")
->update([
   'remCreds'=>$newRemCreds,]);
//thisDup Update
propagent::where('id','=',"$thisDup")
->update([
   'remCreds'=>0,]);
