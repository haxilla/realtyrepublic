<?php
//agtFullNameClean
$agtFullNameClean=$agtFullName;
$agtFullNameClean=str_replace(' ', '', $agtFullNameClean);
$agtFullNameClean=str_replace('.', '', $agtFullNameClean);
$agtFullNameClean=str_replace('-', '', $agtFullNameClean);
$agtFullNameClean=str_replace('#', '', $agtFullNameClean);
$agtFullNameClean=str_replace('/', '', $agtFullNameClean);
$agtFullNameClean=str_replace('\\', '', $agtFullNameClean);
$agtFullNameClean=str_replace('&', '', $agtFullNameClean);
$agtFullNameClean=str_replace('"', '', $agtFullNameClean);
$agtFullNameClean=str_replace('(', '', $agtFullNameClean);
$agtFullNameClean=str_replace(')', '', $agtFullNameClean);
$agtFullNameClean=str_replace(',', '', $agtFullNameClean);
$agtFullNameClean=str_replace('@', '', $agtFullNameClean);
$agtFullNameClean=str_replace('<', '', $agtFullNameClean);
$agtFullNameClean=str_replace('>', '', $agtFullNameClean);
$agtFullNameClean=str_replace('*', '', $agtFullNameClean);
$agtFullNameClean=str_replace('\'', '', $agtFullNameClean);
$agtFullNameClean=strtolower($agtFullNameClean);
