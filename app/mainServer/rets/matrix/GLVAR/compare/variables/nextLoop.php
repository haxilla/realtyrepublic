<?php
// * determines next loop 
// * based on current loop

// ** Homes Start ** //
if($retsLoop=='Homes_compareStart'){
	$retsClass='Homes';
	$nextLoop='homePrice';
}elseif($retsLoop == 'homePrice'){
	$retsClass='Homes';
	$nextLoop='homeStatus';
}elseif($retsLoop == 'homeStatus'){
	$retsClass='Homes';
	$nextLoop='homeNew';
}elseif($retsLoop == 'homeNew'){
	$retsClass='Homes';
	$nextLoop='homeRemoved';
}elseif($retsLoop == 'homeRemoved'){
	$retsClass='Homes';
	$nextLoop='Homes_compareEnd';
// ** Homes End  Log ** //
}elseif($retsLoop == 'Homes_compareEnd'){
	$retsClass="Agents";
	$nextLoop='Agents_compareStart';

// ** Agents Start ** //
}elseif($retsLoop == 'Agents_compareStart'){
	$retsClass='Agents';
	$nextLoop='agentNew';
}elseif($retsLoop == 'agentNew'){
	$retsClass="Agents";
	$nextLoop='agentEmail';
}elseif($retsLoop == 'agentEmail'){
	$retsClass="Agents";
	$nextLoop='agentOffice';
}elseif($retsLoop == 'agentOffice'){
	$retsClass="Agents";
	$nextLoop='agentRemoved';
}elseif($retsLoop == 'agentRemoved'){
	$retsClass="Agents";
	$nextLoop='agentStatus';
}elseif($retsLoop == 'agentStatus'){
	$retsClass="Agents";
	$nextLoop='Agents_compareEnd';
// ** Agents End Log ** //
}elseif($retsLoop == 'Agents_compareEnd'){
	$retsClass="Offices";
	$nextLoop='Offices_compareStart';

// ** Offices Start ** //
}elseif($retsLoop == 'Offices_compareStart'){
	$retsClass="Offices";
	$nextLoop='officeAddress';
}elseif($retsLoop == 'officeAddress'){
	$retsClass="Offices";
	$nextLoop='officeBroker';
}elseif($retsLoop == 'officeBroker'){
	$retsClass="Offices";
	$nextLoop='officeNew';
}elseif($retsLoop == 'officeNew'){
	$retsClass="Offices";
	$nextLoop='officeRemoved';
}elseif($retsLoop == 'officeRemoved'){
	$retsClass="Offices";
	$nextLoop='officeStatus';
}elseif($retsLoop == 'officeStatus'){
	$retsClass="Offices";
	$nextLoop='Offices_compareEnd';
// ** Office End Log ** //
}elseif($retsLoop == 'Offices_compareEnd'){
	$retsClass="Complete";
	$nextLoop='Complete';
	$theStatus='Complete';
	$compareLoop=false;
}else{
	dd($retsLoop,"error-line76-rets/$retsSystem/$mlsName/log/nextLoop.php");}