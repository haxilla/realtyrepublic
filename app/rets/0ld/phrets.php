<?php

date_default_timezone_set('America/Phoenix');

require_once("../vendor/autoload.php");

$config = new \PHRETS\Configuration;
$config->setLoginUrl('http://rets.las.mlsmatrix.com/rets/login.ashx')
        ->setUsername('reagentprod')
        ->setPassword('glv147')
        ->setRetsVersion('1.7.2');

$rets = new \PHRETS\Session($config);

// If you're using Monolog already for logging, you can pass that logging instance to PHRETS for some additional
// insight into what PHRETS is doing.
//
// $log = new \Monolog\Logger('PHRETS');
// $log->pushHandler(new \Monolog\Handler\StreamHandler('php://stdout', \Monolog\Logger::DEBUG));
// $rets->setLogger($log);

$connect = $rets->Login();

//$system = $rets->GetSystemMetadata();
//var_dump($system);

//$resources = $system->getResources();
//$classes = $resources->first()->getClasses();
//var_dump($classes);

//$classes = $rets->GetClassesMetadata('Property');
//var_dump($classes->first());

//$objects = $rets->GetObject('Property', 'Photo', '00-1669', '*', 1);
//var_dump($objects);

//$fields = $rets->GetTableMetadata('Property', 'Listing');
//var_dump($fields);

//$search = $rets->Search("Property","Listing","(ListingContractDate=2019-05-06+)");

$search = $rets->Search('Property', 'Listing', '(ListingContractDate=2019-05-15+)',[
	'Limit' => 30, 
	'Select' => 'Matrix_Unique_ID,StreetNumber,StreetName,ListAgentMLSID,MLSNumber',
]);

/*
foreach ($search as $record) {
    echo $record['StreetNumber'].' '.$record['StreetName'] .' '.$record['Matrix_Unique_ID']."<BR>";
}
*/
foreach ($search as $record) {	
	$uid=$record['Matrix_Unique_ID'];
	$agentID=$record['ListAgentMLSID'];
	$agentSearch=$rets->Search('Agent','Agent',"MLSID=$agentID",[
		'Select' => 'FirstName,LastName,FullName,Matrix_Unique_ID,Email',
	]);

	foreach($agentSearch as $agent){
		$agentFirst=$agent['FirstName'];
		$agentLast=$agent['LastName'];
		$agentFull=$agent['FullName'];
		$agentEmail=$agent['Email'];
		$agentMatrix=$agent['Matrix_Unique_ID'];}
	//using 1 as 4th argument is optional & retrieves location versus blob/file
	$photos = $rets->GetObject("Property", "Photo",$uid,'*','1');
	$agentPhoto = $rets->GetObject("Agent", "AgentPhoto",$agentMatrix,'*','1');
	$largePhotos=$rets->GetObject("Property", "LargePhoto",$uid,'*','1');
	?>
	<div style="padding:15px;background:#000;color:#fff;">
		<?php echo $record['StreetNumber'].' '.$record['StreetName']
		.' '.$record['ListAgentMLSID'].' '.$record['MLSNumber']
		.' '.$agentFirst.' '.$agentLast.' '.$agentFull.' '.$agentMatrix
		.' '.$agentEmail;
		?>
	</div>
	<?php 
	$isFirst=true;
	foreach($agentPhoto as $the){
		// skip first record since GLVAR rets returns 2 records with index[0];
		if ($isFirst) {
			$isFirst = false;
			continue;
		}  
		echo $the->getLocation().'<br>';
	}
	//reset isFirst
	$isFirst=true;
	foreach($largePhotos as $the){
		// skip first record since GLVAR rets returns 2 records with index[0];
		if ($isFirst) {
			$isFirst = false;
			continue;
		}
		echo $the->getLocation().'<br>';
	}
}
dd($agentPhoto);



//$objects = $rets->GetObject($rets_resource, $object_type, $object_keys);
/*
$photos = $rets->GetObject("Property", "LargePhoto","");
print_r($photos);
*/
// grab the first object of the set
//$objects->first();