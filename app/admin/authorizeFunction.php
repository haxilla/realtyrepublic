<?php

$unAuth=request('unAuth');
$auth=request('auth');

if($unAuth=='1'){
   propdelivnow::whereNull('emComplete')
   ->where('propflyer_id','=',"$idFly")
   ->update([
      'authorized'=>null,
   ]);
   return back();
}

if($auth=='1'){
   propdelivnow::whereNull('emComplete')
   ->where('propflyer_id','=',"$idFly")
   ->update([
      'authorized'=>1,
   ]);
   return back();
}
