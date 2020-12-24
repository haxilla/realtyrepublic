<?php

// query to fix null officeID
// stored in separate file to
// to make it obvious

// new officeID is stored as xOfficeID
// on main remote server.  When pulled over,
// xOfficeID is put into officeID slot

// this leaves null values for officeIDs 
// that were not changed.  In this cas
// the following will update the nulls
// to original officeID

$results = DB::select(DB::raw("
	update remuserdb.agtoffices
	set officeID=xOfficeID
	where officeID is null
"));

