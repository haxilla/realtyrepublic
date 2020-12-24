<?php

//default variables
$loopCount=0;
//maxrows2 set to false when finished
$maxrows2 = true;
//loop through & get all records
while($maxrows2){
	//increment loop
	$loopCount++;
	//the rets search
	include(app_path().'/rets/$retsSystem/$retsSearch');
	//local save
	$pdo = \DB::connection()->getPdo();
	//load data 
	//for linux created file only use \n for line endings
	//for windows created files \r\n
	$pdo->exec("
		LOAD DATA LOCAL INFILE '/var/www/html/larasites/realtyrepublic/app/rets/files/$mlsName/$synchType/$synchType_$loopCount.csv'
		INTO TABLE $mainTable
		FIELDS TERMINATED BY ',' 
		ENCLOSED BY '\"' 
		LINES TERMINATED BY '\\n'
		IGNORE 1 LINES;
	");
}


dd('all done!');