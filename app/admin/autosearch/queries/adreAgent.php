<?php 

if(strpos($searchTerm," ") !== false){
	include('adreAgent_space.php');
}else{
	include('adreAgent_nospace.php');
}

