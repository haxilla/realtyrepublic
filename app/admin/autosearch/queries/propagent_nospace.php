<?php
//model
use App\models\core\propagent;
//no spaces in searchTerm
$propagents=propagent::select('id','accountType','agtCity','agtState','agtFullName')
->with(['theAgtOffice'=>function($q){
	$q->select('propagent_id','officeName');
}])
->where('agtFirst','like','%'.$searchTerm.'%')
->orWhere('agtLast','like','%'.$searchTerm.'%')
->orWhere('agtFullName','like','%'.$searchTerm.'%')
->orWhere(\DB::raw('concat(agtFirst," ",agtLast)') , 'LIKE' , '%'.$searchTerm.'%')
->orderBy('agtFullName')
->take(10)
->get();

