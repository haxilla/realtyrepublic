<?php
Use App\models\admin\adminTable;

//create new admin
adminTable::create([
   'adminFirst'   => $adminFirst,
   'adminLast'    => $adminLast,
   'adminHandle'  => $adminHandle,
   'adminEmail'   => $adminEmail,
   'password'     => $password,
   'authLevel'    => $authLevel,
]);
