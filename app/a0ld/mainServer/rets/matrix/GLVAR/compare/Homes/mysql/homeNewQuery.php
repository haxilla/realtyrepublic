<?php

$theQuery=DB::connection('rets')
->select( DB::raw("
	SELECT 
		n.Matrix_Unique_ID as idMatrix,
		n.MLSNumber as mlsNum,
		n.ListPrice as priceNew,
		o.ListPrice as priceOld,
		n.Status as statusNew,
		o.Status as statusOld,
		n.MatrixModifiedDT as datemodMatrix
	FROM
		$nowHomes n
	LEFT JOIN
		$oldHomes o 
	ON o.Matrix_Unique_ID = n.Matrix_Unique_ID
	WHERE o.Matrix_Unique_ID is NULL;
") );

$thisTotal=collect($theQuery)->count();
$changeType="New Listing";