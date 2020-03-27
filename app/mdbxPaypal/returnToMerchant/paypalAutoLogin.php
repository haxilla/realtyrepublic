<?php
use App\models\core\User;
use App\models\core\propagent;

//prepare for login
$user = User::find($umid);
//log user in
Auth::login($user);
//update agent record
propagent::where('id','=',"$umid")
->update([
   'lastLogin'    => \Carbon\Carbon::now(),
   'reviewOrder'  => 1,
   'last_txn'     => $txn_id,
]);
