<?php 
//models
use App\models\rets\glvarAgent;

if(strpos($searchTerm," ") !== false){
	include('glvarAgent_space.php');
}else{
	include('glvarAgent_nospace.php');
}