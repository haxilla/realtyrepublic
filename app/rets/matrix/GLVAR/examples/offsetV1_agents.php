<?php

Use App\models\admin\retsLog;

include(app_path().'/rets/includes/login.php');

$maxrows2 = true;
$offset = 0;
$cumulativeResult=0;
//converting to UTC for datefield searches
$theTimeStamp=\Carbon\Carbon::now('UTC')->format("c");
$theDate=\Carbon\Carbon::now('UTC')->subdays('7')->format("c");
$theEmail='lvross10@gmail.com';

//drop arch table
\Schema::dropIfExists('rets_agent_arch');
//Step 2.
//recreate arch table
\DB::statement('
	CREATE TABLE rets_agent_arch 
	LIKE rets_agent_agent');
//Step 3.
//insert current rets_property_listing into arch
\DB::statement('
	INSERT INTO rets_agent_arch
	SELECT * FROM rets_agent_agent');
//Step 4.
//drop rets_property_listing
\Schema::dropIfExists('rets_agent_agent');
//Step 5.
//create table rets_property_listing like arch
//recreate arch table
\DB::statement('
	CREATE TABLE rets_agent_agent 
	LIKE rets_agent_arch');

//does filename exist
if (file_exists(app_path()."/rets/files/agentSearch.csv")) {

	if(!is_dir(app_path()."/rets/files/agents/$theDateFolder")){
		mkdir(app_path()."/rets/files/agents/$theDateFolder", 0777, true);}
	//if so get date & append old filename with date
	rename(app_path()."/rets/files/agentSearch.csv",
	app_path()."/rets/files/agents/$theDateFolder/agentSearch-$theDateString.csv");}

while($maxrows2){
	//the rets search
	$agentSearch = $rets->Search('Agent', 'Agent',
		"(Matrix_Unique_ID=0+)", [
		'Format' 	=> 'COMPACT-DECODED',
		'Limit'		=> 'None',
		'Offset'		=> $offset
	]);
	//
	$offset = $offset + count($agentSearch);
	// return the total number of results found (reported by the RETS server)
	$totalResults=$agentSearch->getTotalResultsCount();
	// return the count of results actually retrieved by PHRETS
	$returnedResults=$agentSearch->getReturnedResultsCount(); // same as: count($results)
	// add to last record count
	$cumulativeResult=$cumulativeResult+$returnedResults;
	// stop when records match
	if($cumulativeResult>=$totalResults){
		$maxrows2=false;
	}

	// export the results in CSV format
	$theFile=$agentSearch->toCSV();
	//save new file
	file_put_contents(app_path()."/rets/files/agentSearch.csv", $theFile, FILE_APPEND);

}

$pdo = \DB::connection()->getPdo();
//load data 
//for linux created file only use \n for line endings
//for windows created files \r\n
$pdo->exec("
	LOAD DATA LOCAL INFILE '/var/www/html/larasites/realtyrepublic/app/rets/files/agentSearch.csv'
	INTO TABLE rets_agent_agent
	FIELDS TERMINATED BY ',' 
	ENCLOSED BY '\"' 
	LINES TERMINATED BY '\\n'
	IGNORE 1 LINES
");

retsLog::create([
	'resource'			=> 'agent',
	'class'				=> 'agent',
	'recordCount'		=> $cumulativeResult,
	'theField'			=>	'MatrixModified',
	'theTimeStamp'		=> $theTimeStamp,
]);

dd('All Done!');