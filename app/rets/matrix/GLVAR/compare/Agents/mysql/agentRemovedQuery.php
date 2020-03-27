<?php

//agentNewQuery
$theQuery=DB::connection('rets')
->select( DB::raw("
	SELECT 
		o.Matrix_Unique_ID 	as idMatrix,
		o.MatrixModifiedDT	as datemodMatrix,
		n.FirstName 		as firstName,
		n.LastName			as lastName,
		n.FullName			as fullName,
		n.LicenseNumber		as licenseNumber,
		n.Email 			as agentEmailNew,
		o.Email 			as agentEmailOld,
		n.MLSID 			as mlsID,
		n.Office_MUI		as officeMatrixNew,
		o.Office_MUI		as officeMatrixOld,
		n.OfficeMLSID		as officeMLSIDNew,
		o.OfficeMLSID 		as officeMLSIDOld,
		n.AgentStatus		as statusNew,
		o.AgentStatus		as statusOld,
		n.AgentType			as agentType
	FROM
		$nowAgents n
	LEFT JOIN
		$oldAgents o 
	ON o.Matrix_Unique_ID = n.Matrix_Unique_ID
	WHERE o.Matrix_Unique_ID IS NOT null
	AND n.Matrix_Unique_ID IS NULL

") );

$thisTotal=collect($theQuery)->count();
$changeType="Agent Removed";
$removeTable=$mlsName.'_'.$retsClass.'_removed';

if($thisTotal > 0){
	$removed=DB::connection('rets')
		->select(DB::raw("
		INSERT IGNORE into $removeTable
		SELECT * from $oldTable
	"));}