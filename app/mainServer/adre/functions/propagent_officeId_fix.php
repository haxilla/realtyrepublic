<?php
//models
Use App\models\propagent;
Use App\models\propagentmeta;
//query
$fixOffice=propagentmeta::whereNotNull('EmployerLicNumber')
->select('propagent_id','EmployerLicNumber',)
->get();

