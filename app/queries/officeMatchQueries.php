<?php
//get models
Use App\models\core\agtoffice;

//Office Name
$officeNameQuery=agtoffice::where('tempOfficeID','like',$first5.'%')
->select('tempOfficeID', \DB::raw('count(*) as total,officeName'))
->groupBy('tempOfficeID')
->get();
//Office Address
$officeAddress1Query=agtoffice::where('tempOfficeID','like','%'.$last5)
->select('tempOfficeID', \DB::raw('count(*) as total,officeName'))
->groupBy('tempOfficeID')
->get();
