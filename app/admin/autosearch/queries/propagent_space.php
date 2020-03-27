<?php 
//models
use App\models\core\propagent;

$pieces = explode(" ", $searchTerm);
//label first & last names
$FirstName  = $pieces[0]; // piece1
$LastName   = $pieces[1]; // piece2
//6 char version
$first6=substr($FirstName, 0,6); //address
$last6=substr($LastName, 0,6); //address
//query
$propagents=propagent::select()
->where(function($q){
	$q->where('agtFirst','like','%'.$first6.'%')
	  ->where('agtLast','like','%'.$last6.'%');
)->orWhere('agtFullName','like','%'.$searchTerm.'%');
->take(10)
->get();