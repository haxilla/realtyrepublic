<?php
//use facade
use Illuminate\Support\Facades\URL;
//set vars
$url=url::current();
if (strpos($url, 'realtyrepublic.com') !== false){
//must be url above or reject
}else{
  dd('USE LIVE SITE');}
