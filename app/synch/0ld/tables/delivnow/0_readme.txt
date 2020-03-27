**		Main server does not remove 					**
**  	completed campaigns! 							**
**  	All Cleanup to find unfinished campaigns		**
**  	occurs on new server  							**
**********************************************************
**********************************************************

STEP 1. drop & reimport remaildeliveriesnow


STEP 2. Double check the records to be removed 
		are in propdeliv before deleting

		----------------------------------------*
		* records with emailfinished date		*
		* do not belong in propdelivnow table	*
		* Insert into archive before deleting	*
		----------------------------------------*
		INSERT IGNORE into propdeliv
		select * from propdelivnow
		where emailfinished is not null


STEP 3. DELETE from propdelivnow
		WHERE emailrequested is not null
		AND emailfinished is null

* Could try only importing records with above criteria
* instead of downloading all & deleting