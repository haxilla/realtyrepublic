<?php
//adreAgentFirst
$remAgtLastClean=$remAgtLast;
$remAgtLastClean=str_replace(' ', '', $remAgtLastClean);
$remAgtLastClean=str_replace('.', '', $remAgtLastClean);
$remAgtLastClean=str_replace('-', '', $remAgtLastClean);
$remAgtLastClean=str_replace('#', '', $remAgtLastClean);
$remAgtLastClean=str_replace('/', '', $remAgtLastClean);
$remAgtLastClean=str_replace('\\', '', $remAgtLastClean);
$remAgtLastClean=str_replace('&', '', $remAgtLastClean);
$remAgtLastClean=str_replace('"', '', $remAgtLastClean);
$remAgtLastClean=str_replace('(', '', $remAgtLastClean);
$remAgtLastClean=str_replace(')', '', $remAgtLastClean);
$remAgtLastClean=str_replace(',', '', $remAgtLastClean);
$remAgtLastClean=str_replace('@', '', $remAgtLastClean);
$remAgtLastClean=str_replace('<', '', $remAgtLastClean);
$remAgtLastClean=str_replace('>', '', $remAgtLastClean);
$remAgtLastClean=str_replace('*', '', $remAgtLastClean);
$remAgtLastClean=str_replace('\'', '', $remAgtLastClean);
$remAgtLastClean=strtolower($remAgtLastClean);
