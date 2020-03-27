<?php
use App\models\admin\adminTable;
//create new admin
adminTable::where('id','=',"$adminID")
->update([
   'adminFirst'   => $adminFirst,
   'adminLast'    => $adminLast,
   'adminHandle'  => $adminHandle,
   'adminEmail'   => $adminEmail,
   'authLevel'    => $authLevel,
]);

if($password){
   $password=bcrypt($password);
   adminTable::where('id','=',"$adminID")
   ->update([
      'password'=>$password
   ]);
}
