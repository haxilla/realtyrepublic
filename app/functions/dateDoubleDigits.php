<?php

//use dates to get archive names
$year=\Carbon\Carbon::now()->year;
$month=\Carbon\Carbon::now()->month;
$day=\Carbon\Carbon::now()->day;
$hour=\Carbon\Carbon::now()->hour;
$minute=\Carbon\Carbon::now()->minute;
$second=\Carbon\Carbon::now()->second;
//create 2 digit months/days/hours/minutes
if(strlen($month)==1){
	$month='0'.$month;}
if(strlen($day)==1){
	$day='0'.$day;}
if(strlen($hour)==1){
	$hour='0'.$hour;}
if(strlen($minute)==1){
	$minute='0'.$minute;}
if(strlen($second)==1){
	$second='0'.$second;}

$fullDigitDate=$year.$month.$day.$hour.$minute.$second;