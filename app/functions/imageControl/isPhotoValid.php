<?php
//requires indexQuery.php
//start array
$photoData=array();
//flyerIndex
$fi=0;
//newAdds
foreach($newAdds as $the){
	//set flyer variables
	$flyerAddress=$the->xFullStreet;
	$zipDir=$the->theMeta->zipDir;
	$mlsDir=$the->theMeta->mlsDir;
	$flyerID=$the->id;
	$agentID=$the->propagent_id;
	$section='newAdds';
	//increment flyerIndex
	$fi++;
	//photoIndex
	$pi=0;
	foreach($the->thePhotos->where('localFound','!=','1') as $t){
		//set variables
		$pi++;
		$photoName=$t['photoName'];
		$localFound=$t['localFound'];
		$remoteFound=$t['remoteFound'];
		$notFound=$t['notFound'];
		$photoID=$t['photoID'];
		$def=$t['def'];
		$ord=$t['ord'];
		$resized=$t['resized'];
		$width=$t['width'];
		$height=$t['height'];
		$localURL = 'hqphotos/'.$zipDir.'/'.$mlsDir.'/'.$photoName;
		//does it exist
		if (file_exists($localURL)) {
			//validate image
			include(app_path().'/functions/imageControl/localImageCheck.php');
		} else {
			//doesnt exist - mark as error
			include(app_path().'/functions/imageControl/remoteImageCheck.php');
		}
	}
}

foreach($mostViews as $the){
	//set flyer variables
	$flyerAddress=$the->xFullStreet;
	$zipDir=$the->theMeta->zipDir;
	$mlsDir=$the->theMeta->mlsDir;
	$flyerID=$the->id;
	$agentID=$the->propagent_id;
	$section='mostViews';
	//increment flyerIndex
	$fi++;
	//photoIndex
	$pi=0;
	foreach($the->thePhotos->where('localFound','!=','1') as $t){
		//set variables
		$pi++;
		$photoName=$t['photoName'];
		$localFound=$t['localFound'];
		$remoteFound=$t['remoteFound'];
		$notFound=$t['notFound'];
		$photoID=$t['photoID'];
		$def=$t['def'];
		$ord=$t['ord'];
		$resized=$t['resized'];
		$width=$t['width'];
		$height=$t['height'];
		$localURL = 'hqphotos/'.$zipDir.'/'.$mlsDir.'/'.$photoName;
		//does it exist
		if (file_exists($localURL)) {
			//validate image
			include(app_path().'/functions/imageControl/localImageCheck.php');
		} else {
			//doesnt exist doubleCheck
			include(app_path().'/functions/imageControl/remoteImageCheck.php');
		}
	}
}