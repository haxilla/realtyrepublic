<?php

use App\models\keygen\sysid;

//GET TABLE
$currID = sysid::first();

//GET VALUES
$letter1=$currID->letter1;
$letter2=$currID->letter2;
$letter3=$currID->letter3;
$asc1=ord($letter1);
$asc2=ord($letter2);
$asc3=ord($letter3);
$number=$currID->number;

//INCREMENT VALUES
$newNumber=$number+1;
$nextASC1=$asc1;
$nextASC2=$asc2;
$nextASC3=$asc3;
$nextLetter1=chr($nextASC1);

//IF NULL, STAY NULL
if(empty(trim($letter2))){
	$nextLetter2=null;
}else{
	$nextLetter2=chr($asc2);
}

//IF NULL, STAY NULL
if(empty(trim($letter3))){
	$nextLetter3=null;
}else{
	$nextLetter3=chr($asc3);
}

//if number is higher than rotate the letter
if($newNumber>999){

	$newNumber=1;
	$nextASC1=$asc1+1;
	$nextLetter1=chr($nextASC1);

	if($nextASC1>90){

		$nextASC1=65; //Reset
		$nextLetter1=chr($nextASC1);
		$nextASC2=$asc2+1;

		if($nextASC2<65){
			$nextASC2=65;
		}

		$nextLetter2=chr($nextASC2);

		if($nextASC2>90){
			$nextASC2=65;
			$nextLetter2=chr($nextASC2);
			$nextASC3=$asc3+1;

			if($nextASC3<65){
				$nextASC3=65;
			}

			$nextLetter3=chr($nextASC3);
		}

		if($nextASC3>90){
			echo "now what?";
			exit();
		}
	}
}

if($nextASC1===73 or $nextASC1===79 or $nextASC1===83 or $nextASC1===85){
	$nextASC1=$nextASC1+1;
	$nextLetter1=chr($nextASC1);
}

if($nextASC1===86){
	$nextASC1=$nextASC1+2;
	$nextLetter1=chr($nextASC1);
}

if($nextASC2===73 or $nextASC2===79 or $nextASC2===83 or $nextASC2===85){
	$nextASC2=$nextASC2+1;
	$nextLetter2=chr($nextASC2);
}

if($nextASC2===86){
	$nextASC2=$nextASC2+2;
	$nextLetter2=chr($nextASC2);
}

if($nextASC3===73 or $nextASC3===79 or $nextASC3===83 or $nextASC3===85){
	$nextASC3=$nextASC3+1;
	$nextLetter3=chr($nextASC3);
}

if($nextASC3===86){
	$nextASC3=$nextASC3+2;
	$nextLetter3=chr($nextASC3);
}

sysid::where('idSysGen',1)
	->update([
		'letter1' 	=> $nextLetter1,
		'letter2'	=> $nextLetter2,
		'letter3'	=> $nextLetter3,
		'asc1'		=>	$nextASC1,
		'asc2'		=>	$nextASC2,
		'asc3'		=> $nextASC3,
		'number'		=> $newNumber
	]);

$sysID="$letter1$letter2$letter3$number";
$xSysID='x'.$sysID.'x';
