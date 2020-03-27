<?php
//adreAgentLast
$adreAgentLastClean=$adreAgentLast;
$adreAgentLastClean=str_replace(' ', '', $adreAgentLastClean);
$adreAgentLastClean=str_replace('.', '', $adreAgentLastClean);
$adreAgentLastClean=str_replace('-', '', $adreAgentLastClean);
$adreAgentLastClean=str_replace('#', '', $adreAgentLastClean);
$adreAgentLastClean=str_replace('/', '', $adreAgentLastClean);
$adreAgentLastClean=str_replace('\\', '', $adreAgentLastClean);
$adreAgentLastClean=str_replace('&', '', $adreAgentLastClean);
$adreAgentLastClean=str_replace('"', '', $adreAgentLastClean);
$adreAgentLastClean=str_replace('(', '', $adreAgentLastClean);
$adreAgentLastClean=str_replace(')', '', $adreAgentLastClean);
$adreAgentLastClean=str_replace(',', '', $adreAgentLastClean);
$adreAgentLastClean=str_replace('@', '', $adreAgentLastClean);
$adreAgentLastClean=str_replace('<', '', $adreAgentLastClean);
$adreAgentLastClean=str_replace('>', '', $adreAgentLastClean);
$adreAgentLastClean=str_replace('*', '', $adreAgentLastClean);
$adreAgentLastClean=str_replace('\'', '', $adreAgentLastClean);
$adreAgentLastClean=strtolower($adreAgentLastClean);
