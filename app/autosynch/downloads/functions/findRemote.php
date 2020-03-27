<?php

//set remotes
$remoteSite="http://www.realtyemails.com";
$remoteURL1=$remoteSite."/hqphotos/$oldZipDir/$oldMlsDir/$photoName";
$remoteURL2=$remoteSite."/photoDeletes/$oldZipDir/$oldMlsDir/$photoName";

//set header
$header_response = get_headers($remoteURL1, 1);

//read reply
if (strpos( $header_response[0],"404") !== false) {
  $notFound=1;
  $remoteFound=0;
} else {
  $remoteFound=1;
  $notFound=0;
  $remoteURL=$remoteURL1;
}

//if its STILL not found check photoDeletes folder
if($notFound==1){
	//set header
	$header_response = get_headers($remoteURL2, 1);
	//read reply
	if (strpos( $header_response[0],"404") !== false) {
	  $notFound=1;
	  $remoteFound=0;
	} else {
	  $deleteFound=1;
	  $notFound=0;
	  $remoteURL=$remoteURL2;
	}
}