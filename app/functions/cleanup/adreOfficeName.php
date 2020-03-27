<?php
//adreOfficeClean
$adreOfficeNameClean=$adreOfficeName;
$adreOfficeNameClean=str_replace(' ', '', $adreOfficeNameClean);
$adreOfficeNameClean=str_replace('.', '', $adreOfficeNameClean);
$adreOfficeNameClean=str_replace('-', '', $adreOfficeNameClean);
$adreOfficeNameClean=str_replace('#', '', $adreOfficeNameClean);
$adreOfficeNameClean=str_replace('/', '', $adreOfficeNameClean);
$adreOfficeNameClean=str_replace('\\', '', $adreOfficeNameClean);
$adreOfficeNameClean=str_replace('&', '', $adreOfficeNameClean);
$adreOfficeNameClean=str_replace('"', '', $adreOfficeNameClean);
$adreOfficeNameClean=str_replace('(', '', $adreOfficeNameClean);
$adreOfficeNameClean=str_replace(')', '', $adreOfficeNameClean);
$adreOfficeNameClean=str_replace(',', '', $adreOfficeNameClean);
$adreOfficeNameClean=str_replace('@', '', $adreOfficeNameClean);
$adreOfficeNameClean=str_replace('<', '', $adreOfficeNameClean);
$adreOfficeNameClean=str_replace('>', '', $adreOfficeNameClean);
$adreOfficeNameClean=str_replace('*', '', $adreOfficeNameClean);
$adreOfficeNameClean=str_replace('\'', '', $adreOfficeNameClean);
$adreOfficeNameClean=strtolower($adreOfficeNameClean);
