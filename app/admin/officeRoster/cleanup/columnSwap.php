<?php
// ***  USE WITH CAUTION - CAN RUIN OFFICEID Columns ***  //
// completely raw queries
// remove before live
DB::unprepared('update propoffices set xOfficeID=null');
DB::unprepared('update propoffices set xOfficeID=tempOfficeID');
DB::unprepared('update propoffices set tempOfficeID=null');
DB::unprepared('update propoffices set tempOfficeID=officeID');

//makes copy of current officeID
DB::unprepared('UPDATE agtoffices SET xOfficeID=officeID');
DB::unprepared('UPDATE agtoffices SET remailOfficeID=tempOfficeID');
