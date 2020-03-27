<?php
//model
use App\models\adre\adreAgent;
//no spaces in searchTerm
$adreAgents=adreAgent::select('FirstName','MiddleName','LastName',
'LicNumber','LicStatus','EmployerDBAName')
->where('FirstName','like','%'.$searchTerm.'%')
->orWhere('LastName','like','%'.$searchTerm.'%')
->orWhere(\DB::raw('concat(FirstName," ",LastName)') , 'LIKE' , '%'.$searchTerm.'%')
->orderBy('LastName')
->take(10)
->get();

