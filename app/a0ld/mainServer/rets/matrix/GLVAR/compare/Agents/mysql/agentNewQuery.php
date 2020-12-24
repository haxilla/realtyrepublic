<?php

//agentNewQuery
$theQuery=DB::connection('rets')
->select( DB::raw("
	SELECT 
		n.Matrix_Unique_ID 	as idMatrix,
		n.MatrixModifiedDT 	as datemodMatrix,
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
		o.OfficeMLSID		as officeMLSIDOld,
		n.AgentStatus		as statusNew,
		o.AgentStatus		as statusOld,
		n.AgentType			as agentType
	FROM
		$nowAgents n
	LEFT JOIN
		$oldAgents o 
	ON o.Matrix_Unique_ID = n.Matrix_Unique_ID
	WHERE o.Matrix_Unique_ID is NULL;
") );

$thisTotal=collect($theQuery)->count();
$changeType="New Agent";