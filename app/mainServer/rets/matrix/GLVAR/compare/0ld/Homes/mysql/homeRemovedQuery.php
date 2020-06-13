<?php

$theQuery=DB::connection('rets')
->select( DB::raw("
	SELECT 
		o.Matrix_Unique_ID as idmatrixOld,
		n.Matrix_Unique_ID as idmatrixNew,
		o.Status as statusOld,
		n.Status as statusNew,
		o.MLSNumber as mlsNumOld,
		n.MLSNumber as mlsNumNew,
		o.ListPrice as priceOld,
		n.ListPrice as priceNew,
		o.MatrixModifiedDT as datemodMatrixOld,
		n.MatrixModifiedDT as datemodMatrixNew
	FROM
		$oldHomes o
	LEFT JOIN
		$nowHomes n 
	ON o.Matrix_Unique_ID = n.Matrix_Unique_ID
	WHERE n.Matrix_Unique_ID is NULL;
") );

$thisTotal=collect($theQuery)->count();