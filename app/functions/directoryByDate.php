<?php

//use dates to get archive names
$month=\Carbon\Carbon::now()->month;
$year=\Carbon\Carbon::now()->year;
$day=\Carbon\Carbon::now()->day;
$hour=\Carbon\Carbon::now()->hour;
$minute=\Carbon\Carbon::now()->minute;

//create 2 digit months/days/hours/minutes
if(strlen($month)==1){
	$month='0'.$month;}
if(strlen($day)==1){
	$day='0'.$day;}
if(strlen($hour)==1){
	$hour='0'.$hour;}
if(strlen($minute)==1){
	$minute='0'.$minute;}