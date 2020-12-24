<?php

$theQuery=DB::connection('rets')
->select( DB::raw("
	SELECT 
		n.Matrix_Unique_ID as idMatrix,
		o.ListPrice as priceOld,
		n.ListPrice as priceNew,
		o.Status as statusOld,
		n.Status as statusNew,
		n.MLSNumber as mlsNum,
		n.MatrixModifiedDT as datemodMatrix
	FROM
		$nowHomes n
	LEFT JOIN
		$oldHomes o 
	ON o.Matrix_Unique_ID = n.Matrix_Unique_ID
	WHERE o.Status != n.Status
	AND n.Status is not NULL
	AND o.Status is not NULL
") );

$thisTotal=collect($theQuery)->count();
$changeType="Home Status";