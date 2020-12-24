IMPORT remaildeliveriesmaster into propdelivs
ONE TIME ONLY 

***************************************
* insert ignore current year archives *
* on top to keep current              *
***************************************

Step 1. 

	Reimport remaildeliveries2019 (or currentyear) to
	get all new archives.

Step 2.  
	
	LOCAL
	-----
	INSERT IGNORE into remuserdb.propdelivs
	select * from remarchives.remaildeliveries2019

	REMOTE
	------
	Insert IGNORE into remaildeliveriesmaster
	select * from remaildeliveries2019;