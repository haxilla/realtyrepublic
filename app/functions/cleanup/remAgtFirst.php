<?php
//adreAgentFirst
$remAgtFirstClean=$remAgtFirst;
$remAgtFirstClean=str_replace(' ', '', $remAgtFirstClean);
$remAgtFirstClean=str_replace('.', '', $remAgtFirstClean);
$remAgtFirstClean=str_replace('-', '', $remAgtFirstClean);
$remAgtFirstClean=str_replace('#', '', $remAgtFirstClean);
$remAgtFirstClean=str_replace('/', '', $remAgtFirstClean);
$remAgtFirstClean=str_replace('\\', '', $remAgtFirstClean);
$remAgtFirstClean=str_replace('&', '', $remAgtFirstClean);
$remAgtFirstClean=str_replace('"', '', $remAgtFirstClean);
$remAgtFirstClean=str_replace('(', '', $remAgtFirstClean);
$remAgtFirstClean=str_replace(')', '', $remAgtFirstClean);
$remAgtFirstClean=str_replace(',', '', $remAgtFirstClean);
$remAgtFirstClean=str_replace('@', '', $remAgtFirstClean);
$remAgtFirstClean=str_replace('<', '', $remAgtFirstClean);
$remAgtFirstClean=str_replace('>', '', $remAgtFirstClean);
$remAgtFirstClean=str_replace('*', '', $remAgtFirstClean);
$remAgtFirstClean=str_replace('\'', '', $remAgtFirstClean);
$remAgtFirstClean=strtolower($remAgtFirstClean);
