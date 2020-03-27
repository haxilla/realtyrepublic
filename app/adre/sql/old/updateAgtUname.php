<?php
//Model
Use App\models\core\propagent;
//update
$xxAgtUname=propagent::where('id','=',"$mainAccountID")
->pluck('xxAgtUname')
->first();
//update xxAgtUname
propagent::where('id','=',"$mainAccountID")
->update([
   'agtUname'     => $xxAgtUname]);
//log
$mergerNotes[0]['usernameNote2'] = "Migrated agtUname as "
.$xxAgtUname;
