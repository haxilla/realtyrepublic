<?php
//  *******************************
//  **  YOU ARE IN A LOOP
//  **  Current Record is $thisDup
//  *******************************

//old file
$oldAgtLogoFile="officeLogos/$thisOfficeID/$agtLogo";
//if found remove`
if(file_exists($oldAgtLogoFile)){
   unlink($oldAgtLogoFile);}
