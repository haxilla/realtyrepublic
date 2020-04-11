<?php

$theQuery=DB::connection('rets')
->select( DB::raw("
	SELECT
		o.Matrix_Unique_ID as idMatrix,
		n.Matrix_Unique_ID as idMatrixNew,
		o.Status as statusOld,
		n.Status as statusNew,
		o.MLSNumber as mlsNum,
		o.ListPrice as priceOld,
		n.ListPrice as priceNew,
		o.MatrixModifiedDT as datemodMatrix
	FROM
		$oldHomes o
	LEFT JOIN
		$nowHomes n
	ON o.Matrix_Unique_ID = n.Matrix_Unique_ID
	WHERE o.Matrix_Unique_ID is NOT NULL
	AND n.Matrix_Unique_ID is NULL;
") );

$thisTotal=collect($theQuery)->count();
$changeType="Home Removed";
$removeTable=$mlsName.'_'.$retsClass.'_removed';

if($thisTotal > 0){

	if($thisTotal > 1600){
		dd($thisTotal,'error-line30-homeRemovedQuery.php');}

	foreach($theQuery as $the){
		$removed=DB::connection('rets')
		->select(DB::raw("

			INSERT IGNORE into $removeTable
			SELECT * from $oldHomes
			WHERE Matrix_Unique_ID=$the->idMatrix

		"));
	}}
