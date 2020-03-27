<?php
//current plain text password needs to be made into a passHash
//and stored if passHash is null get agtPswd bcrypt & save into passHash
use App\models\core\propagent;

if(strpos(Request::url(),'.test')){
  $local=1;
  $live=0;
}else{
  $local=0;
  $live=1;}
//determin local or live
if($local==1){
   $createPassHash=propagent::passHash()->take(1);
}else{
   $createPassHash=propagent::passHash();}

foreach($createPassHash as $the){

   $umid=$the->id;
   $agtFullName=$the->agtFullName;
   $plainPassword=$the->agtPswd;
   $passHash=bcrypt($plainPassword);

   propagent::where('id','=',"$umid")
   ->whereNull('passHash')
   ->update([
      'passHash'=>$passHash
   ]);

}

