<?php

$theQuery = DB::connection('rets')
->select( DB::raw("
	SELECT 
		n.Matrix_Unique_ID as idMatrix,
		o.ListPrice as priceOld,
		n.ListPrice as priceNew,
		n.MLSNumber as mlsNum,
		o.status 	as statusOld,
		n.status   	as statusNew,
		n.MatrixModifiedDT as datemodMatrix
	FROM
		$nowHomes n
	LEFT JOIN
		$oldHomes o 
	ON o.Matrix_Unique_ID = n.Matrix_Unique_ID
	WHERE o.ListPrice != n.ListPrice;
") );

$thisTotal=collect($theQuery)->count();
$changeType="Price Change";