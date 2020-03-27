<?php
//adreOfficeClean
$adreOfficeAddress1Clean=$adreOfficeAddress1;
$adreOfficeAddress1Clean=str_replace(' ', '', $adreOfficeAddress1Clean);
$adreOfficeAddress1Clean=str_replace('.', '', $adreOfficeAddress1Clean);
$adreOfficeAddress1Clean=str_replace('-', '', $adreOfficeAddress1Clean);
$adreOfficeAddress1Clean=str_replace('#', '', $adreOfficeAddress1Clean);
$adreOfficeAddress1Clean=str_replace('/', '', $adreOfficeAddress1Clean);
$adreOfficeAddress1Clean=str_replace('\\', '', $adreOfficeAddress1Clean);
$adreOfficeAddress1Clean=str_replace('&', '', $adreOfficeAddress1Clean);
$adreOfficeAddress1Clean=str_replace('"', '', $adreOfficeAddress1Clean);
$adreOfficeAddress1Clean=str_replace('(', '', $adreOfficeAddress1Clean);
$adreOfficeAddress1Clean=str_replace(')', '', $adreOfficeAddress1Clean);
$adreOfficeAddress1Clean=str_replace(',', '', $adreOfficeAddress1Clean);
$adreOfficeAddress1Clean=str_replace('@', '', $adreOfficeAddress1Clean);
$adreOfficeAddress1Clean=str_replace('<', '', $adreOfficeAddress1Clean);
$adreOfficeAddress1Clean=str_replace('>', '', $adreOfficeAddress1Clean);
$adreOfficeAddress1Clean=str_replace('*', '', $adreOfficeAddress1Clean);
$adreOfficeAddress1Clean=str_replace('\'', '', $adreOfficeAddress1Clean);
$adreOfficeAddress1Clean=strtolower($adreOfficeAddress1Clean);
