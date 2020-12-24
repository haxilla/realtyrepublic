<?php

Use App\models\core\propagent;
$umid=null;
$search=null;

// abbreviated for broader results
$first5 = substr($firstName,0,5);
$last5 = substr($lastName,0,5);

if($thisEmail && $fullName && $firstName && $lastName){
	$search='full';
	$needsUmid=propagent::whereNotNull('agtFullName')
	->where('agtFullName','!=',"")
	->where(function($q) Use($thisEmail,$fullName){
		$q->where('xxAgtUname','=',$thisEmail)
		  ->orWhere('agtEmail','=',$thisEmail)
		  ->orWhere('agtFullName','=',$fullName);
	})
	->orWhere(function($q) Use($first5,$last5){
		$q->where('agtFirst','like','%'.$first5.'%')
		  ->where('agtLast','like','%'.$last5.'%');
	})
	->get();

}elseif($fullName && $thisEmail){
	$search='fullName / thisEmail';
	$needsUmid=propagent::whereNotNull('agtFullName')
	->where('agtFullName','!=',"")
	->where(function($q) Use($thisEmail,$fullName){
		$q->where('xxAgtUname','=',$thisEmail)
		  ->orWhere('agtEmail','=',$thisEmail)
		  ->orWhere('agtFullName','=',$fullName);
	})->get();

}elseif($thisEmail){
	$search='thisEmail';
	$needsUmid=propagent::whereNotNull('agtFullName')
	->where('agtFullName','!=',"")
	->where(function($q) Use($thisEmail){
		$q->where('xxAgtUname','=',$thisEmail)
		  ->orWhere('agtEmail','=',$thisEmail);
	})->get();

}elseif($fullname){
	$search='fullName';
	$needsUmid=propagent::whereNotNull('agtFullName')
	->where('agtFullName','!=',"")
	->where('agtFullName','=',$fullName)
	->get();

}else{
	dd('error-line31-umid_review.php');}

$umidCount=$needsUmid->count();

if($umidCount==1){
	//sets variables
	foreach($needsUmid as $thisUmid){
		include(app_path().'/bounces/variables/umid_variables.php');}}