<?php
//get current
$currURL=Request::url();
//set fromURL
if( strpos($currURL, 'rosemary.test') !== false){
   $fromURL="www.rosemary.test";
}elseif(strpos($currURL, 'realtyrepublic') !== false){
   $fromURL="www.realtyrepublic.com";
}elseif(strpos($currURL, 'realtyemails')){
   $fromURL="www.realtyemails.com";}
