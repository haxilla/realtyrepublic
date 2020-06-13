<?php

//this file needs more memory
ini_set('memory_limit', '256M');

//set loadPath
//original
$loadPath="/var/www/html/larasites/realtyrepublic/public/"
.$extractPath.'/'.$extName;
//rename after regex
$loadPath2="/var/www/html/larasites/realtyrepublic/public/"
.$extractPath.'/2'.$extName;

//regex 
$string = file_get_contents($loadPath, TRUE);
$pattern = '/(?<=\w)""/';
$replacement = '\\""';
$result1=preg_replace($pattern, $replacement, $string);
$pattern2='( ")';
$replacement2=' \\"';
$result2=preg_replace($pattern2,$replacement2,$result1);
file_put_contents($loadPath2,$result2);

//mysql connection
$pdo = \DB::connection()->getPdo();

//load data infile
if($newName=='Individuals.zip'){
	//Individuals
	$pdo->exec("
	LOAD DATA INFILE '$loadPath2'
	IGNORE INTO TABLE adre.adreagents_copy
	FIELDS TERMINATED BY ','
	ENCLOSED BY '\"'
	LINES TERMINATED BY '\\r\\n'
	IGNORE 1 LINES");

}elseif($newName=='Entities.zip'){
	//
	dd('finish-line17-loadDataInfile.php');
}else{
	dd('error-line12-adre/uploads/loadDataInfile.php');}

