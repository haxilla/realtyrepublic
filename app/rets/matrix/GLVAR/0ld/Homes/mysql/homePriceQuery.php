<?php

$theQuery = DB::connection('rets')
->select( DB::raw("
	SELECT 
		o.Matrix_Unique_ID as idmatrixOld,
		n.Matrix_Unique_ID as idmatrixNew,
		o.ListPrice as priceOld,
		n.ListPrice as priceNew,
		o.MLSNumber as mlsNumOld,
		n.MLSNumber as mlsNumNew,
		o.status 	as statusOld,
		n.status   	as statusNew,
		o.MatrixModifiedDT as datemodMatrixOld,
		n.MatrixModifiedDT as datemodMatrixNew
	FROM
		$nowHomes n
	LEFT JOIN
		$oldHomes o 
	ON o.Matrix_Unique_ID = n.Matrix_Unique_ID
	WHERE o.ListPrice != n.ListPrice;
") );

$thisTotal=collect($theQuery)->count();