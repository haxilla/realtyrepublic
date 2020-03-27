<?php

Use App/oldFlyers;
Use App/newFlyers;

$notMoved=remoteFlyers::where('notMoved','=','1')
->get();

foreach($notMoved as $nm){

   localFlyers::create([
      'idFly'=>$nm['ufid'],
      'idMem'=>$nm['umid'],
   ]);

}

