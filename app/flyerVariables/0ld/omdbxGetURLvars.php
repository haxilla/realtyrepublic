<?php
//url variables
$showTemplate=request('showTemplate');
$showHL=request('showHL');
$showColors=request('showColors');

if(!$theTemplate && request('theTemplate')){
   $theTemplate=request('theTemplate');
}

if(!$showTemplate){
   $showTemplate=0;
}
if(!$showHL){
   $showHL=0;
}
if(!$showColors){
   $showColors=0;
}
