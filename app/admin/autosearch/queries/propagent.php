<?php 
//models
use App\models\core\propagent;

if(strpos($searchTerm," ") !== false){
	$pieces = explode(" ", $searchTerm);
	//label first & last names
	$FirstName  = $pieces[0]; // piece1
	$LastName   = $pieces[1]; // piece2
	//6 char version
	$first6=substr($FirstName, 0,6); //address
	$last6=substr($LastName, 0,6); //address
}else{
	$first6='xxx000';
	$last6='xxx000';
}

//query
$propagents=propagent::select('id','accountType','agtCity',
	'agtState','agtFullName')
->with(['theAgtOffice'=>function($q){
	$q->select('propagent_id','officeName');
}])
->with(['theAgentCleanup'=>function($q){
	$q->select('propagent_id','accountType');
}])
->where(function($q)use($first6,$last6){
	$q->where('agtFirst','like','%'.$first6.'%')
	  ->where('agtLast','like','%'.$last6.'%');
})->orWhere('agtFullName','like','%'.$searchTerm.'%')
->take(10)
->get();