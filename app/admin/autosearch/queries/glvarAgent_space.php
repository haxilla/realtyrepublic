<?php 
//models
use App\models\rets\glvarAgent;

$pieces = explode(" ", $searchTerm);
//label first & last names
$FirstName  = $pieces[0]; // piece1
$LastName   = $pieces[1]; // piece2
//6 char version
$first6=substr($FirstName, 0,6); //address
$last6=substr($LastName, 0,6); //address

$glvarAgents=glvarAgent::select('FirstName','LastName',
'LicenseNumber','AgentStatus')
->where('FirstName','like','%'.$first6.'%')
->where('LastName','like','%'.$last6.'%')
->take(10)
->get();