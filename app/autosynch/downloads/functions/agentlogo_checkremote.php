<?php

//set remotes
$remoteSite="http://www.realtyemails.com";
$remoteURL=$remoteSite."/HQoffice/$officeID/logos/$thisLogo";

//set header
$header_response = get_headers($remoteURL, 1);

//read reply
if (strpos( $header_response[0],"404") !== false) {
  $notFound=1;
  $remoteFound=0;
} else {
  $remoteFound=1;
  $notFound=0;}

//error if not found
if($notFound){
	dd('remoteSite:',$remoteSite,'remoteURL:',$remoteURL,'error-line20-agentlogo_checkremote');}
