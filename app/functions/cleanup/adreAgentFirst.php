<?php
//adreAgentFirst
$adreAgentFirstClean=$adreAgentFirst;
$adreAgentFirstClean=str_replace(' ', '', $adreAgentFirstClean);
$adreAgentFirstClean=str_replace('.', '', $adreAgentFirstClean);
$adreAgentFirstClean=str_replace('-', '', $adreAgentFirstClean);
$adreAgentFirstClean=str_replace('#', '', $adreAgentFirstClean);
$adreAgentFirstClean=str_replace('/', '', $adreAgentFirstClean);
$adreAgentFirstClean=str_replace('\\', '', $adreAgentFirstClean);
$adreAgentFirstClean=str_replace('&', '', $adreAgentFirstClean);
$adreAgentFirstClean=str_replace('"', '', $adreAgentFirstClean);
$adreAgentFirstClean=str_replace('(', '', $adreAgentFirstClean);
$adreAgentFirstClean=str_replace(')', '', $adreAgentFirstClean);
$adreAgentFirstClean=str_replace(',', '', $adreAgentFirstClean);
$adreAgentFirstClean=str_replace('@', '', $adreAgentFirstClean);
$adreAgentFirstClean=str_replace('<', '', $adreAgentFirstClean);
$adreAgentFirstClean=str_replace('>', '', $adreAgentFirstClean);
$adreAgentFirstClean=str_replace('*', '', $adreAgentFirstClean);
$adreAgentFirstClean=str_replace('\'', '', $adreAgentFirstClean);
$adreAgentFirstClean=strtolower($adreAgentFirstClean);
