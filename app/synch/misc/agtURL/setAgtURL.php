<?php

use App\models\core\propagent;
use App\models\oldsite\oldAgent;

$getAgtURL=propagent::whereNull('agtURL')
->select('agtFirst','agtLast','id')
->whereNotNull('agtFirst')
->whereNotNull('agtLast')
->get();

foreach($getAgtURL as $the){
	$agtFirst=trim($the->agtFirst);
	$agtLast=trim($the->agtLast);
	$agtClean=$agtFirst.$agtLast;
	$agtClean=substr($agtClean,0,25);
	$agtID=$the->id;
	//check dup
	$urlDup=propagent::select('id','agtFullName')
	->where('agtURL','=',$agtClean)
	->first();
	//
	if($agtClean && !$urlDup && !strpos($agtClean," ")!==false){
		//ok to update
		//local
		propagent::where('id','=',$agtID)
		->update([
			'agtURL'=>$agtClean
		]);
		//oldsite
		oldAgent::where('umid','=',$agtID)
		->update([
			'agtURL'=>$agtClean
		]);
	}else{
		//local
		propagent::where('id','=',$agtID)
		->update([
			'agtURL'=>$agtID
		]);
		//oldsite
		oldAgent::where('umid','=',$agtID)
		->update([
			'agtURL'=>$agtID
		]);

	}
}