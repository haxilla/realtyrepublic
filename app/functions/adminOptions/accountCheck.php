<?php
//models
Use App\models\core\propagent;
//checkDups
$dup=propagent::select('id')
->where('agtUname','=',"$theEmail")
->orWhere('xxAgtUname','=',"$theEmail")
->orWhere('agtEmail','=',"$theEmail")
->first();
//if found send back with ID
if($dup){
   $accountID=$dup['id'];
   $agentID2=$dup['id'];
   $lastAdd='account';
   $hasAccount=1;
}else{
   $addAccount=1;
   $accountID=null;
   $hasAccount=0;
}



