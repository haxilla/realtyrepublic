<?php
//model
use App\models\rets\glvarAgent;
//no spaces in searchTerm
$glvarAgents=glvarAgent::select('FirstName','LastName',
'LicenseNumber','AgentStatus')
->where('FirstName','like','%'.$searchTerm.'%')
->orWhere('LastName','like','%'.$searchTerm.'%')
->orWhere(\DB::raw('concat(FirstName," ",LastName)') , 'LIKE' , '%'.$searchTerm.'%')
->orderBy('LastName')
->take(10)
->get();