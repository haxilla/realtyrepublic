<?php
if(!$theMsgID){
	dd('error-line3-saveInlineFiles.php');}

//set dir
$inlineDir="/var/www/html/larasites/realtyrepublic".
"/public/inlineFiles/$theMsgID";
//create if doesnt exist
if(!is_dir($inlineDir)){
	mkdir($inlineDir, 0777, true);}

foreach($inlineFiles as $theFile){
	
	//downloads inline attachmentes
	$fileType=$theFile['fileType'];
	$originFileName=$theFile['fileName'];
	$originFileName = trim(str_replace(' ', '', $originFileName));
	$inlineFileName=uniqid().'.'.$fileType;
	$fullInlinePath=$inlineDir."/$inlineFileName";
	$fullOriginPath=$inlineDir."/$originFileName";
	$inlineContent=$theFile['inlineContent'];
	$encoding=$theFile['encoding'];

	//encoding 3
	if($encoding==3){
		$inlineContent=base64_decode($inlineContent);
		$im = imageCreateFromString($inlineContent);
		/* below works to get original but dangerous
		/* file_put_contents($fullInlinePath,$inlineContent);*/}

	//encoding 4
	if($encoding==4){
		$inlineContent=quoted_printable_decode($inlineContent);
		$im = imageCreateFromString($inlineContent);
		/* below works to get original but dangerous 
		/* file_put_contents($fullInlinePath,$inlineContent);*/}

	//error if $im not resolving as image
	if(!$im){
		dd('error-line40-bounces/functions/saveInlineFile.php');}
	
	if($fileType=='JPEG'){
		imagejpeg($im,$fullOriginPath);
	}else{
		dd('error-line45-bounces/functions/saveInlineFile.php');}

	//match urls with cid:
	preg_match_all('/src="cid:(.*)"/Uims', $htmlmsg, $matches);
	
	//start arrays
	$search=array();
	$replace=array();

	//search & replace htmlbody
	foreach($matches[1] as $match) {
		$search[] = "src=\"cid:$match\"";
		$replace[] = "src=\"https://www.realtyrepublic.com/inlineFiles/$theMsgID/$originFileName\"";}

	$htmlmsg=str_replace($search, $replace, $htmlmsg);

}