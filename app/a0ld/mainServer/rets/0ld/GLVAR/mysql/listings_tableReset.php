<?php

//Step 1.
//drop arch table
\Schema::dropIfExists('GLVAR_listings_arch');

//Step 2.
//recreate arch table
\DB::statement('
	CREATE TABLE GLVAR_listings_arch 
	LIKE GLVAR_listings');

//Step 3.
//insert current into arch
\DB::statement('
	INSERT INTO GLVAR_listings_arch
	SELECT * FROM GLVAR_listings');
//Step 4.
//drop rets_property_listing
\Schema::dropIfExists('GLVAR_listings');

//Step 5.
//create current table like arch
//recreate arch table
\DB::statement('
	CREATE TABLE GLVAR_listings
	LIKE GLVAR_listings_arch');