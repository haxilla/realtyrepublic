<?php

use App\models\distro\emailareas;

$allAreas = array(
   array('emArea'=>'azphxmetro','emArea_display'=>'Phoenix Metro'),
   array('emArea'=>'azphxne','emArea_display'=>'Northeast Valley'),
   array('emArea'=>'azphxse','emArea_display'=>'Southeast Valley'),
   array('emArea'=>'azphxwv','emArea_display'=>'West Valley'),
   array('emArea'=>'aznaz','emArea_display'=>'Northern AZ Counties'),
   array('emArea'=>'azsaz','emArea_display'=>'Southern AZ Counties'),
   array('emArea'=>'glvar','emArea_display'=>'Greater Las Vegas'),
);

foreach($allAreas as $aa){
   emailareas::create([
      'emArea' => $aa['emArea'],
      'emArea_display' => $aa['emArea_display']
   ]);
}
