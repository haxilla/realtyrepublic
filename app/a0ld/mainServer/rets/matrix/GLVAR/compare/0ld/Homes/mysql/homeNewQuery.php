<?php

$theQuery=DB::connection('rets')
->select( DB::raw("
	SELECT 
		n.Matrix_Unique_ID as idmatrixNew,
		o.Matrix_Unique_ID as idmatrixOld,
		n.MLSNumber as mlsNumNew,
		o.MLSNumber as mlsNumOld,
		n.ListPrice as priceNew,
		o.ListPrice as priceOld,
		n.Status as statusNew,
		o.Status as statusOld,
		o.MatrixModifiedDT as datemodMatrixOld,
		n.MatrixModifiedDT as datemodMatrixNew
	FROM
		$nowHomes n
	LEFT JOIN
		$oldHomes o 
	ON o.Matrix_Unique_ID = n.Matrix_Unique_ID
	WHERE o.Matrix_Unique_ID is NULL;
") );

$thisTotal=collect($theQuery)->count();