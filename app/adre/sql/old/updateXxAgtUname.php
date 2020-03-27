<?php
//Model
Use App\models\core\propagent;
//update
propagent::where('id','=',"$mainAccountID")
->update([
   'xxAgtUname'   => $recommendUsername,]);
