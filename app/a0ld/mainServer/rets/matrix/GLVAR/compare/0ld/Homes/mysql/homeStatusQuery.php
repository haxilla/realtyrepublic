<?php

$theQuery=DB::connection('rets')
->select( DB::raw("
	SELECT 
		o.Matrix_Unique_ID as idmatrixOld,
		n.Matrix_Unique_ID as idmatrixNew,
		o.ListPrice as priceOld,
		n.ListPrice as priceNew,
		o.Status as statusOld,
		n.Status as statusNew,
		o.MLSNumber as mlsNumOld,
		n.MLSNumber as mlsNumNew,
		o.MatrixModifiedDT as datemodMatrixOld,
		n.MatrixModifiedDT as datemodMatrixNew
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