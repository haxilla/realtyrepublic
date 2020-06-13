<?php 

// Set the variables
//RESO\RESO::setClientId('YOUR_CLIENT_ID');
//RESO\RESO::setClientSecret('YOUR_CLIENT_SECRET');
RESO\RESO::setAPIAuthUrl('https://op.api.crmls.org/identity/connect/authorize');
RESO\RESO::setAPITokenUrl('https://op.api.crmls.org/identity/connect/token');
RESO\RESO::setAPIRequestUrl('https://h.api.crmls.org/RESO/OData/');
// Authorize user
$auth_code = RESO\OpenIDConnect::authorize('YOUR_USERNAME', 'YOUR_PASSWORD', 'https://openid.reso.org/', 'ODataApi');
// Get access token
RESO\RESO::setAccessToken(RESO\OpenIDConnect::requestAccessToken($auth_code, 'https://openid.reso.org/', 'ODataApi'));
// Set the Accept header (if needed)
RESO\Request::setAcceptType("json");
// Retrieve top 10 properties from the RESO API endpoint
$data = RESO\Request::request('Property?\$top=10', 'json', true);

// Display records
print_r($data);